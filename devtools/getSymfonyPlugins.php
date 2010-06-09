#!/usr/bin/php5
<?php

/**
 * fetch all available symfony plugins from the webpage and output them on the cli
 * in a PHPien array format
 */

// that's the url all plugins are listed
define('URL', 'http://www.symfony-project.org/plugins/all_by_category');

$page = file_get_contents(URL);

// fetch the names by the links
preg_match_all('|<a.*?href="/plugins/.+?".*?>([\w\d]+?Plugin)</a>|i', $page, $matches);

// remove if some plugins are duplicated (this actually happens!)
$plugins = array_unique($matches[1]);
// sort them so the auto-completion does not have to do it each time
sort($plugins, SORT_LOCALE_STRING);

echo "array(\n";

foreach($plugins as $plugin) {
	echo sprintf("\t'%s',\n", $plugin);
}

echo ");\n";

