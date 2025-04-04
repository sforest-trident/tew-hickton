/*

	== PHP FILE TREE JAVASCRIPT EXTENSION ==

		Based on the Expandable Listmenu Script by Daniel Nolan
		http://www.bleedingego.co.uk/webdev.php

		Modified by Cory S.N. LaViska
		http://abeautifulsite.net/ (https://www.abeautifulsite.net/php-file-tree)

		Modified by Adrian Jones for use with Tracy Debugger File Editor Panel

	== WHAT IT DOES ==

		This script makes the nested lists created by PHP File Tree expand and
		collapse dynamically.

	== USAGE ==

		Include the script into the <head></head> section of the appropriate
		page(s) as shown below:

			<script src="php_file_tree.js" type="text/javascript"></script>

		All file trees generated by PHP File Tree will automatically collapse to
		the top level (as specified by $directory) and become dynamic.

	== FAQS ==

		Q Can I have more than one file tree on one page?
		A Yes.  You can have as many as you want and they will all function as expected.

*/

function init_php_file_tree(linkedFilePath) {

	if (!document.getElementsByTagName || !document.getElementById("tracyFoldersFiles")) return;
	var path = '';
	var aMenus = document.getElementById("tracyFoldersFiles").getElementsByTagName("LI");
	for (var i = 0; i < aMenus.length; i++) {
		var parentOpen = false;
		var mclass = aMenus[i].className;
		if (mclass.indexOf("tft-d") > -1) {
			var submenu = aMenus[i].childNodes;
			for (var j = 0; j < submenu.length; j++) {
				if (submenu[j].tagName == "A") {

					submenu[j].onclick = function() {
						var node = this.nextSibling;

						while (1) {
							if (node != null) {
								if (node.tagName == "UL") {
									var d = (node.style.display == "none");
									if(d) {
										this.id = path = path + '/' + this.text;
									}
									node.style.display = (d) ? "block" : "none";
									this.className = (d) ? "open" : "closed";
									return false;
								}
								node = node.nextSibling;
							} else {
								return false;
							}
						}
						return false;
					}

					submenu[j].className = (mclass.indexOf("open") > -1) ? "open" : "closed";

					if(document.getElementById('panelTitleFilePath').innerHTML.indexOf(submenu[j].text) > -1) {
						submenu[j].className = "open";
						parentOpen = true;
					}

				}

				if (submenu[j].tagName == "UL") {
					if(parentOpen) {
						submenu[j].style.display = "block";
					}
					else {
						submenu[j].style.display = (mclass.indexOf("open") > -1) ? "block" : "none";
					}
				}

			}
		}

		if (mclass.indexOf("tft-f") > -1) {
			var items = aMenus[i].childNodes;
			for (var j = 0; j < items.length; j++) {
				if (items[j].tagName == "A") {
					var parser = document.createElement('a');
					var queryStr = items[j].href.split('?')[1];
					var currentFilePath = decodeURI(queryStr.replace('f=','').replace('&l=1',''));
					if(document.getElementById('panelTitleFilePath').innerHTML == currentFilePath || linkedFilePath == currentFilePath) {
						var els = document.getElementsByClassName("active");
						[].forEach.call(els, function (el) {
							el.classList.remove("active");
						});
						items[j].classList.add("active");
						if(document.getElementById("tfe_recently_opened")) {
							document.getElementById("tfe_recently_opened").value = currentFilePath;
						}
					}
				}
			}
		}
	}
	return false;
}

init_php_file_tree();
