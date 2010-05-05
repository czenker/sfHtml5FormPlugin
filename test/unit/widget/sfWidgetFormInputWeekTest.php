<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(8, new lime_output_color());

$w = new sfWidgetFormInputWeek();
$now = time();
$dateNow = date('Y-\WW', $now);

$t->is($w->render('foobar'), '<input type="week" name="foobar" id="foobar" />', 'render empty tag ok');

$w->setOption('min', $now);
$t->like($w->render('foobar'), '/min="'.$dateNow.'"/', 'render attribute min ok');

$w->setOption('max', $now);
$t->like($w->render('foobar'), '/max="'.$dateNow.'"/', 'render attribute max ok');

try {
	$t->is($w->formatDate($now), $dateNow, 'formatDate accepts unix timestamp and renders correctly');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts unix timestamp');
}

try {
	$t->is($w->formatDate($dateNow), $dateNow, 'formatDate accepts RFC3339-like week and renders correctly');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts RFC3339-like week');
}

try {
	$t->is($w->formatDate(new DateTime($dateNow)), $dateNow, 'formatDate accepts DateTime and renders correctly');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts DateTime');
}

try {
	$t->is($w->formatDate('2007-02-19 12:34:56'), '2007-W08', 'formatDate accepts yyyy-mm-dd hh:ii:ss');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts yyyy-mm-dd hh:ii:ss');
}

try {
	$t->is($w->formatDate('2007-02-19'), '2007-W08', 'formatDate accepts yyyy-mm-dd');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts yyyy-mm-dd');
}
