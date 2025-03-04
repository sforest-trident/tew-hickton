<?php

/**
 * This file is part of the Tracy (https://tracy.nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Tracy\Dumper;

use Tracy\Helpers;


/**
 * Visualisation of internal representation.
 * @internal
 */
final class Renderer
{
	private const TypeArrayKey = 'array';

	public int|bool $collapseTop = 14;
	public int $collapseSub = 7;
	public bool $classLocation = false;
	public bool $sourceLocation = false;

	/** lazy-loading via JavaScript? true=full, false=none, null=collapsed parts */
	public ?bool $lazy = null;
	public bool $hash = true;
	public ?string $theme = 'light';
	public bool $collectingMode = false;

	/** @var Value[] */
	private array $snapshot = [];

	/** @var Value[]|null */
	private ?array $snapshotSelection = null;
	private array $parents = [];
	private array $above = [];


	public function renderAsHtml(\stdClass $model): string
	{
		try {
			$value = $model->value;
			$this->snapshot = $model->snapshot;

			if ($this->lazy === false) { // no lazy-loading
				$html = $this->renderVar($value);
				$json = $snapshot = null;

			} elseif ($this->lazy && (is_array($value) && $value || is_object($value))) { // full lazy-loading
				$html = '';
				$snapshot = $this->collectingMode ? null : $this->snapshot;
				$json = $value;

			} else { // lazy-loading of collapsed parts
				$html = $this->renderVar($value);
				$snapshot = $this->snapshotSelection;
				$json = null;
			}
		} finally {
			$this->parents = $this->snapshot = $this->above = [];
			$this->snapshotSelection = null;
		}

		$location = null;
		if ($model->location && $this->sourceLocation) {
			[$file, $line, $code] = $model->location;
			$uri = Helpers::editorUri($file, $line);
			$location = '<div class="tracy-dump-location-container">';
			$location .= Helpers::formatHtml(
				'<a href="%" class="tracy-dump-location" title="in file % on line %%">',
				$uri ?? '#',
				$file,
				$line,
				$uri ? "\nClick to open in editor" : ''
			) . Helpers::encodeString($code, 50) . "</a\n>";
			$location .= "  " . '<span class="tracy-dump-location tracy-dump-location-path">' . Helpers::editorLink($file, $line) . '</span></div>';
		}

		return '<pre class="tracy-dump' . ($this->theme ? ' tracy-' . htmlspecialchars($this->theme) : '')
				. ($json && $this->collapseTop === true ? ' tracy-collapsed' : '') . '"'
				. ($snapshot !== null ? " data-tracy-snapshot='" . self::jsonEncode($snapshot) . "'" : '')
				. ($json ? " data-tracy-dump='" . self::jsonEncode($json) . "'" : '')
				. ($location || strlen($html) > 100 ? "\n" : '')
			. '>'
			. $html
			. "</pre>\n" . $location;
	}


	public function renderAsText(\stdClass $model, array $colors = []): string
	{
		try {
			$this->snapshot = $model->snapshot;
			$this->lazy = false;
			$s = $this->renderVar($model->value);
		} finally {
			$this->parents = $this->snapshot = $this->above = [];
		}

		$s = $colors ? Helpers::htmlToAnsi($s, $colors) : Helpers::htmlToText($s);
		$s = str_replace('…', '...', $s);
		$s .= substr($s, -1) === "\n" ? '' : "\n";

		if ($this->sourceLocation && ([$file, $line] = $model->location)) {
			$s .= "in $file:$line\n";
		}

		return $s;
	}


	private function renderVar(mixed $value, int $depth = 0, string|int|null $keyType = null): string
	{
		return match (true) {
			$value === null => '<span class="tracy-dump-null">null</span>',
			is_bool($value) => '<span class="tracy-dump-bool">' . ($value ? 'true' : 'false') . '</span>',
			is_int($value) => '<span class="tracy-dump-number">' . $value . '</span>',
			is_float($value) => '<span class="tracy-dump-number">' . self::jsonEncode($value) . '</span>',
			is_string($value) => $this->renderString($value, $depth, $keyType),
			is_array($value), $value->type === Value::TypeArray => $this->renderArray($value, $depth),
			$value->type === Value::TypeRef => $this->renderVar($this->snapshot[$value->value], $depth, $keyType),
			$value->type === Value::TypeObject => $this->renderObject($value, $depth),
			$value->type === Value::TypeNumber => '<span class="tracy-dump-number">' . Helpers::escapeHtml($value->value) . '</span>',
			$value->type === Value::TypeText => '<span class="tracy-dump-virtual">' . Helpers::escapeHtml($value->value) . '</span>',
			$value->type === Value::TypeStringHtml, $value->type === Value::TypeBinaryHtml => $this->renderString($value, $depth, $keyType),
			$value->type === Value::TypeResource => $this->renderResource($value, $depth),
			default => throw new \Exception('Unknown type'),
		};
	}


	private function renderString(string|Value $str, int $depth, string|int|null $keyType): string
	{
		if ($keyType === self::TypeArrayKey) {
			$indent = '<span class="tracy-dump-indent">   ' . str_repeat('|  ', $depth - 1) . ' </span>';
			return '<span class="tracy-dump-string">'
				. "<span class='tracy-dump-lq'>'</span>"
				. (is_string($str) ? Helpers::escapeHtml($str) : str_replace("\n", "\n" . $indent, $str->value))
				. "<span>'</span>"
				. '</span>';

		} elseif ($keyType !== null) {
			$classes = [
				Value::PropertyPublic => 'tracy-dump-public',
				Value::PropertyProtected => 'tracy-dump-protected',
				Value::PropertyDynamic => 'tracy-dump-dynamic',
				Value::PropertyVirtual => 'tracy-dump-virtual',
			];
			$indent = '<span class="tracy-dump-indent">   ' . str_repeat('|  ', $depth - 1) . ' </span>';
			$title = is_string($keyType)
				? ' title="declared in ' . Helpers::escapeHtml($keyType) . '"'
				: null;
			return '<span class="'
				. ($title ? 'tracy-dump-private' : $classes[$keyType]) . '"' . $title . '>'
				. (is_string($str)
					? Helpers::escapeHtml($str)
					: "<span class='tracy-dump-lq'>'</span>" . str_replace("\n", "\n" . $indent, $str->value) . "<span>'</span>")
				. '</span>';

		} elseif (is_string($str)) {
			$len = Helpers::utf8Length($str);
			return '<span class="tracy-dump-string"'
				. ($len > 1 ? ' title="' . $len . ' characters"' : '')
				. '>'
				. "<span>'</span>"
				. Helpers::escapeHtml($str)
				. "<span>'</span>"
				. '</span>';

		} else {
			$unit = $str->type === Value::TypeStringHtml ? 'characters' : 'bytes';
			$count = substr_count($str->value, "\n");
			if ($count) {
				$collapsed = $indent1 = $toggle = null;
				$indent = '<span class="tracy-dump-indent"> </span>';
				if ($depth) {
					$collapsed = $count >= $this->collapseSub;
					$indent1 = '<span class="tracy-dump-indent">   ' . str_repeat('|  ', $depth) . '</span>';
					$indent = '<span class="tracy-dump-indent">   ' . str_repeat('|  ', $depth) . ' </span>';
					$toggle = '<span class="tracy-toggle' . ($collapsed ? ' tracy-collapsed' : '') . '">string</span>' . "\n";
				}

				return $toggle
					. '<div class="tracy-dump-string' . ($collapsed ? ' tracy-collapsed' : '')
					. '" title="' . $str->length . ' ' . $unit . '">'
					. $indent1
					. '<span' . ($count ? ' class="tracy-dump-lq"' : '') . ">'</span>"
					. str_replace("\n", "\n" . $indent, $str->value)
					. "<span>'</span>"
					. ($depth ? "\n" : '')
					. '</div>';
			}

			return '<span class="tracy-dump-string"'
				. ($str->length > 1 ? " title=\"{$str->length} $unit\"" : '')
				. '>'
				. "<span>'</span>"
				. $str->value
				. "<span>'</span>"
				. '</span>';
		}
	}


	private function renderArray(array|Value $array, int $depth): string
	{
		$out = '<span class="tracy-dump-array">array</span> (';

		if (is_array($array)) {
			$items = $array;
			$count = count($items);
			$out .= $count . ')';
		} elseif ($array->items === null) {
			return $out . $array->length . ') …';
		} else {
			$items = $array->items;
			$count = $array->length ?? count($items);
			$out .= $count . ')';
			if ($array->id && isset($this->parents[$array->id])) {
				return $out . ' <i>RECURSION</i>';

			} elseif ($array->id && ($array->depth < $depth || isset($this->above[$array->id]))) {
				if ($this->lazy !== false) {
					$ref = new Value(Value::TypeRef, $array->id);
					$this->copySnapshot($ref);
					return '<span class="tracy-toggle tracy-collapsed" data-tracy-dump=\'' . json_encode($ref) . "'>" . $out . '</span>';

				} elseif ($this->hash) {
					return $out . (isset($this->above[$array->id]) ? ' <i>see above</i>' : ' <i>see below</i>');
				}
			}
		}

		if (!$count) {
			return $out;
		}

		$collapsed = $depth
			? ($this->lazy === false || $depth === 1 ? $count >= $this->collapseSub : true)
			: (is_int($this->collapseTop) ? $count >= $this->collapseTop : $this->collapseTop);

		$span = '<span class="tracy-toggle' . ($collapsed ? ' tracy-collapsed' : '') . '"';

		if ($collapsed && $this->lazy !== false) {
			$array = isset($array->id) ? new Value(Value::TypeRef, $array->id) : $array;
			$this->copySnapshot($array);
			return $span . " data-tracy-dump='" . self::jsonEncode($array) . "'>" . $out . '</span>';
		}

		$out = $span . '>' . $out . "</span>\n" . '<div' . ($collapsed ? ' class="tracy-collapsed"' : '') . '>';
		$indent = '<span class="tracy-dump-indent">   ' . str_repeat('|  ', $depth) . '</span>';
		$this->parents[$array->id ?? null] = $this->above[$array->id ?? null] = true;

		foreach ($items as $info) {
			[$k, $v, $ref] = $info + [2 => null];
			$out .= $indent
				. $this->renderVar($k, $depth + 1, self::TypeArrayKey)
				. ' => '
				. ($ref && $this->hash ? '<span class="tracy-dump-hash">&' . $ref . '</span> ' : '')
				. ($tmp = $this->renderVar($v, $depth + 1))
				. (substr($tmp, -6) === '</div>' ? '' : "\n");
		}

		if ($count > count($items)) {
			$out .= $indent . "…\n";
		}

		unset($this->parents[$array->id ?? null]);
		return $out . '</div>';
	}


	private function renderObject(Value $object, int $depth): string
	{
		$editorAttributes = '';
		if ($this->classLocation && $object->editor) {
			$editorAttributes = Helpers::formatHtml(
				' title="Declared in file % on line %%%" data-tracy-href="%"',
				$object->editor->file,
				$object->editor->line,
				$object->editor->url ? "\nCtrl-Click to open in editor" : '',
				"\nAlt-Click to expand/collapse all child nodes",
				$object->editor->url,
			);
		}

		$pos = strrpos($object->value, '\\');
		$out = '<span class="tracy-dump-object"' . $editorAttributes . '>'
			. ($pos
				? Helpers::escapeHtml(substr($object->value, 0, $pos + 1)) . '<b>' . Helpers::escapeHtml(substr($object->value, $pos + 1)) . '</b>'
				: Helpers::escapeHtml($object->value))
			. '</span>'
			. ($object->id && $this->hash ? ' <span class="tracy-dump-hash">#' . $object->id . '</span>' : '');

		if ($object->items === null) {
			return $out . ' …';

		} elseif (!$object->items) {
			return $out;

		} elseif ($object->id && isset($this->parents[$object->id])) {
			return $out . ' <i>RECURSION</i>';

		} elseif ($object->id && ($object->depth < $depth || isset($this->above[$object->id]))) {
			if ($this->lazy !== false) {
				$ref = new Value(Value::TypeRef, $object->id);
				$this->copySnapshot($ref);
				return '<span class="tracy-toggle tracy-collapsed" data-tracy-dump=\'' . json_encode($ref) . "'>" . $out . '</span>';

			} elseif ($this->hash) {
				return $out . (isset($this->above[$object->id]) ? ' <i>see above</i>' : ' <i>see below</i>');
			}
		}

		$collapsed = $object->collapsed ?? ($depth
			? ($this->lazy === false || $depth === 1 ? count($object->items) >= $this->collapseSub : true)
			: (is_int($this->collapseTop) ? count($object->items) >= $this->collapseTop : $this->collapseTop));

		$span = '<span class="tracy-toggle' . ($collapsed ? ' tracy-collapsed' : '') . '"';

		if ($collapsed && $this->lazy !== false) {
			$value = $object->id ? new Value(Value::TypeRef, $object->id) : $object;
			$this->copySnapshot($value);
			return $span . " data-tracy-dump='" . self::jsonEncode($value) . "'>" . $out . '</span>';
		}

		$out = $span . '>' . $out . "</span>\n" . '<div' . ($collapsed ? ' class="tracy-collapsed"' : '') . '>';
		$indent = '<span class="tracy-dump-indent">   ' . str_repeat('|  ', $depth) . '</span>';
		$this->parents[$object->id] = $this->above[$object->id] = true;

		foreach ($object->items as $info) {
			[$k, $v, $type, $ref] = $info + [2 => Value::PropertyVirtual, null];
			$out .= $indent
				. $this->renderVar($k, $depth + 1, $type)
				. ': '
				. ($ref && $this->hash ? '<span class="tracy-dump-hash">&' . $ref . '</span> ' : '')
				. ($tmp = $this->renderVar($v, $depth + 1))
				. (substr($tmp, -6) === '</div>' ? '' : "\n");
		}

		if ($object->length > count($object->items)) {
			$out .= $indent . "…\n";
		}

		unset($this->parents[$object->id]);
		return $out . '</div>';
	}


	private function renderResource(Value $resource, int $depth): string
	{
		$out = '<span class="tracy-dump-resource">' . Helpers::escapeHtml($resource->value) . '</span> '
			. ($this->hash ? '<span class="tracy-dump-hash">@' . substr($resource->id, 1) . '</span>' : '');

		if (!$resource->items) {
			return $out;

		} elseif (isset($this->above[$resource->id])) {
			if ($this->lazy !== false) {
				$ref = new Value(Value::TypeRef, $resource->id);
				$this->copySnapshot($ref);
				return '<span class="tracy-toggle tracy-collapsed" data-tracy-dump=\'' . json_encode($ref) . "'>" . $out . '</span>';
			}

			return $out . ' <i>see above</i>';

		} else {
			$this->above[$resource->id] = true;
			$out = "<span class=\"tracy-toggle tracy-collapsed\">$out</span>\n<div class=\"tracy-collapsed\">";
			foreach ($resource->items as [$k, $v]) {
				$out .= '<span class="tracy-dump-indent">   ' . str_repeat('|  ', $depth) . '</span>'
					. $this->renderVar($k, $depth + 1, Value::PropertyVirtual)
					. ': '
					. ($tmp = $this->renderVar($v, $depth + 1))
					. (substr($tmp, -6) === '</div>' ? '' : "\n");
			}

			return $out . '</div>';
		}
	}


	private function copySnapshot(mixed $value): void
	{
		if ($this->collectingMode) {
			return;
		}

		if ($this->snapshotSelection === null) {
			$this->snapshotSelection = [];
		}

		if (is_array($value)) {
			foreach ($value as [, $v]) {
				$this->copySnapshot($v);
			}
		} elseif ($value instanceof Value && $value->type === Value::TypeRef) {
			if (!isset($this->snapshotSelection[$value->value])) {
				$ref = $this->snapshotSelection[$value->value] = $this->snapshot[$value->value];
				$this->copySnapshot($ref);
			}
		} elseif ($value instanceof Value && $value->items) {
			foreach ($value->items as [, $v]) {
				$this->copySnapshot($v);
			}
		}
	}


	public static function jsonEncode(mixed $value): string
	{
		$old = @ini_set('serialize_precision', '-1'); // @ may be disabled
		try {
			return json_encode($value, JSON_HEX_APOS | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		} finally {
			if ($old !== false) {
				ini_set('serialize_precision', $old);
			}
		}
	}
}
