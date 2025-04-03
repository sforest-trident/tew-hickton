<?php

/**
 * This file is part of the Tracy (https://tracy.nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

namespace Tracy;


/**
 * Debug Bar.
 */
class Bar
{
	/** @var IBarPanel[] */
	private $panels = [];

	/** @var bool  initialized by dispatchAssets() */
	private $useSession = false;

	/** @var string|NULL  generated by renderLoader() */
	private $contentId;


	/**
	 * Add custom panel.
	 * @param  IBarPanel  $panel
	 * @param  string  $id
	 * @return static
	 */
	public function addPanel(IBarPanel $panel, $id = null)
	{
		if ($id === null) {
			$c = 0;
			do {
				$id = get_class($panel) . ($c++ ? "-$c" : '');
			} while (isset($this->panels[$id]));
		}
		$this->panels[$id] = $panel;
		return $this;
	}


	/**
	 * Returns panel with given id
	 * @param  string  $id
	 * @return IBarPanel|null
	 */
	public function getPanel($id)
	{
		return isset($this->panels[$id]) ? $this->panels[$id] : null;
	}


	/**
	 * Renders loading <script>
	 * @return void
	 */
	public function renderLoader()
	{
		if (!$this->useSession) {
			throw new \LogicException('Start session before Tracy is enabled.');
		}
		$contentId = $this->contentId = $this->contentId ?: substr(md5(uniqid('', true)), 0, 10);
		$nonce = Helpers::getNonce();
		$async = true;
		require __DIR__ . '/assets/Bar/loader.phtml';
	}


	/**
	 * Renders debug bar.
	 * @return void
	 */
	public function render()
	{
		$useSession = $this->useSession && session_status() === PHP_SESSION_ACTIVE;
		$redirectQueue = &$_SESSION['_tracy']['redirect'];

		foreach (['bar', 'redirect', 'bluescreen'] as $key) {
			$queue = &$_SESSION['_tracy'][$key];
			$queue = array_slice((array) $queue, -10, null, true);
			$queue = array_filter($queue, function ($item) {
				return isset($item['time']) && $item['time'] > time() - 60;
			});
		}

		$rows = [];

		if (Helpers::isAjax()) {
			if ($useSession) {
				$rows[] = (object) ['type' => 'ajax', 'panels' => $this->renderPanels('-ajax')];
				$contentId = $_SERVER['HTTP_X_TRACY_AJAX'] . '-ajax';
				$_SESSION['_tracy']['bar'][$contentId] = ['content' => self::renderHtmlRows($rows), 'dumps' => Dumper::fetchLiveData(), 'time' => time()];
			}

		} elseif (preg_match('#^Location:#im', implode("\n", headers_list()))) { // redirect
			if ($useSession) {
				Dumper::fetchLiveData();
				Dumper::$livePrefix = count($redirectQueue) . 'p';
				$redirectQueue[] = [
					'panels' => $this->renderPanels('-r' . count($redirectQueue)),
					'dumps' => Dumper::fetchLiveData(),
					'time' => time(),
				];
			}

		} elseif (Helpers::isHtmlMode()) {
			$rows[] = (object) ['type' => 'main', 'panels' => $this->renderPanels()];
			$dumps = Dumper::fetchLiveData();
			foreach (array_reverse((array) $redirectQueue) as $info) {
				$rows[] = (object) ['type' => 'redirect', 'panels' => $info['panels']];
				$dumps += $info['dumps'];
			}
			$redirectQueue = null;
			$content = self::renderHtmlRows($rows);

			if ($this->contentId) {
				$_SESSION['_tracy']['bar'][$this->contentId] = ['content' => $content, 'dumps' => $dumps, 'time' => time()];
			} else {
				$contentId = substr(md5(uniqid('', true)), 0, 10);
				$nonce = Helpers::getNonce();
				$async = false;
				require __DIR__ . '/assets/Bar/loader.phtml';
			}
		}
	}


	/**
	 * @return string
	 */
	private static function renderHtmlRows(array $rows)
	{
		ob_start(function () {});
		require __DIR__ . '/assets/Bar/panels.phtml';
		require __DIR__ . '/assets/Bar/bar.phtml';
		return Helpers::fixEncoding(ob_get_clean());
	}


	/**
	 * @return array
	 */
	private function renderPanels($suffix = null)
	{
		set_error_handler(function ($severity, $message, $file, $line) {
			if (error_reporting() & $severity) {
				throw new \ErrorException($message, 0, $severity, $file, $line);
			}
		});

		$obLevel = ob_get_level();
		$panels = [];

		foreach ($this->panels as $id => $panel) {
			$idHtml = preg_replace('#[^a-z0-9]+#i', '-', $id) . $suffix;
			try {
				$tab = (string) $panel->getTab();
				$panelHtml = $tab ? (string) $panel->getPanel() : null;
				if ($tab && $panel instanceof \Nette\Diagnostics\IBarPanel) {
					$e = new \Exception('Support for Nette\Diagnostics\IBarPanel is deprecated');
				}

			} catch (\Exception $e) {
			} catch (\Throwable $e) {
			}
			if (isset($e)) {
				while (ob_get_level() > $obLevel) { // restore ob-level if broken
					ob_end_clean();
				}
				$idHtml = "error-$idHtml";
				$tab = "Error in $id";
				$panelHtml = "<h1>Error: $id</h1><div class='tracy-inner'>" . nl2br(Helpers::escapeHtml($e)) . '</div>';
				unset($e);
			}
			$panels[] = (object) ['id' => $idHtml, 'tab' => $tab, 'panel' => $panelHtml];
		}

		restore_error_handler();
		return $panels;
	}


	/**
	 * Renders debug bar assets.
	 * @return bool
	 */
	public function dispatchAssets()
	{
		$asset = isset($_GET['_tracy_bar']) ? $_GET['_tracy_bar'] : null;
		if ($asset === 'js') {
			header('Content-Type: application/javascript');
			header('Cache-Control: max-age=864000');
			header_remove('Pragma');
			header_remove('Set-Cookie');
			$this->renderAssets();
			return true;
		}

		$this->useSession = session_status() === PHP_SESSION_ACTIVE;

		if ($this->useSession && Helpers::isAjax()) {
			header('X-Tracy-Ajax: 1'); // session must be already locked
		}

		if ($this->useSession && $asset && preg_match('#^content(-ajax)?\.(\w+)$#', $asset, $m)) {
			$session = &$_SESSION['_tracy']['bar'][$m[2] . $m[1]];
			header('Content-Type: application/javascript');
			header('Cache-Control: max-age=60');
			header_remove('Set-Cookie');
			if (!$m[1]) {
				$this->renderAssets();
			}
			if ($session) {
				$method = $m[1] ? 'loadAjax' : 'init';
				echo "Tracy.Debug.$method(", json_encode($session['content']), ', ', json_encode($session['dumps']), ');';
				$session = null;
			}
			$session = &$_SESSION['_tracy']['bluescreen'][$m[2]];
			if ($session) {
				echo 'Tracy.BlueScreen.loadAjax(', json_encode($session['content']), ', ', json_encode($session['dumps']), ');';
				$session = null;
			}
			return true;
		}

		return false;
	}


	private function renderAssets()
	{
		$css = array_map('file_get_contents', array_merge([
			__DIR__ . '/assets/Bar/bar.css',
			__DIR__ . '/assets/Toggle/toggle.css',
			__DIR__ . '/assets/Dumper/dumper.css',
			__DIR__ . '/assets/BlueScreen/bluescreen.css',
		], Debugger::$customCssFiles));

		echo
"(function(){
	var el = document.createElement('style');
	el.setAttribute('nonce', document.currentScript.getAttribute('nonce') || document.currentScript.nonce);
	el.className='tracy-debug';
	el.textContent=" . json_encode(preg_replace('#\s+#u', ' ', implode($css))) . ";
	document.head.appendChild(el);})
();\n";

		if(Debugger::$customCssStr) echo "(function(){var el = document.createElement('div'); el.className='tracy-debug'; el.innerHTML='".preg_replace('#\s+#u', ' ', Debugger::$customCssStr)."'; document.head.appendChild(el);})();\n";

		array_map('readfile', array_merge([
			__DIR__ . '/assets/Bar/bar.js',
			__DIR__ . '/assets/Toggle/toggle.js',
			__DIR__ . '/assets/Dumper/dumper.js',
			__DIR__ . '/assets/BlueScreen/bluescreen.js',
		], Debugger::$customJsFiles));

		if(Debugger::$customJsStr) echo Debugger::$customJsStr;

		if(Debugger::$customBodyStr) echo "(function(){var el = document.createElement('div'); el.className='tracy-debug'; el.innerHTML='".preg_replace('#\s+#u', ' ', Debugger::$customBodyStr)."'; document.addEventListener('DOMContentLoaded', function() { document.body.appendChild(el);});})();\n";
	}
}
