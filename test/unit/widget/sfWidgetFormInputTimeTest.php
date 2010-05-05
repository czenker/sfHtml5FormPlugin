<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(8, new lime_output_color());

$w = new sfWidgetFormInputTime();
$now = time();
$timeNow = date('H:i:s.u', $now);

$t->is($w->render('foobar'), '<input type="time" name="foobar" id="foobar" />', 'render empty tag ok');

$w->setOption('min', $now);
$t->like($w->render('foobar'), '/min="'.$timeNow.'"/', 'render attribute min ok');

$w->setOption('max', $now);
$t->like($w->render('foobar'), '/max="'.$timeNow.'"/', 'render attribute max ok');

try {
	$t->is($w->formatDate($now), $timeNow, 'formatDate accepts unix timestamp and renders correctly');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts unix timestamp');
}

try {
	$t->is($w->formatDate($timeNow), $timeNow, 'formatDate accepts RFC3339 partial-time and renders correctly');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts RFC3339-like partial-time');
}

try {
	$t->is($w->formatDate(new DateTime($timeNow)), $timeNow, 'formatDate accepts DateTime and renders correctly');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts DateTime');
}

try {
	$t->is($w->formatDate('2007-02-19 12:34:56'), '12:34:56.000000', 'formatDate accepts yyyy-mm-dd hh:ii:ss');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts yyyy-mm-dd hh:ii:ss');
}

try {
	$t->is($w->formatDate('2007-02-19'), '00:00:00.000000', 'formatDate accepts yyyy-mm-dd');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts yyyy-mm-dd');
}
