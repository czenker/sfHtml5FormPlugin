<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(9, new lime_output_color());

$w = new sfWidgetFormInputDateTime();
$now = time();
$timeNow = date('Y-m-d\TH:i:s.uP', $now);
$pregTimeNow = preg_quote($timeNow, '/');
$timeNow2 = date('Y-m-d\TH:i:s.u\Z', $now);

$t->is($w->render('foobar'), '<input type="datetime" name="foobar" id="foobar" />', 'render empty tag ok');

$w->setOption('min', $now);
$t->like($w->render('foobar'), '/min="'.$pregTimeNow.'"/', 'render attribute min ok');

$w->setOption('max', $now);
$t->like($w->render('foobar'), '/max="'.$pregTimeNow.'"/', 'render attribute max ok');

try {
	$t->is($w->formatDate($now), $timeNow, 'formatDate accepts unix timestamp and renders correctly');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts unix timestamp');
}

try {
	$t->is($w->formatDate($timeNow), $timeNow, 'formatDate accepts RFC3339-like date-time with numeric timezone and renders correctly');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts RFC3339-like date-time with numeric timezone');
}

try {
	$t->is($w->formatDate($timeNow), $timeNow, 'formatDate accepts RFC3339-like date-time with no timezone and renders correctly');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts RFC3339-like date-time with no timezone');
}

try {
	$t->is($w->formatDate(new DateTime($timeNow)), $timeNow, 'formatDate accepts DateTime and renders correctly');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts DateTime');
}

try {
	$t->is($w->formatDate('2007-02-19 12:34:56'), '2007-02-19T12:34:56.000000'.date('P', strtotime('2007-02-19')), 'formatDate accepts yyyy-mm-dd hh:ii:ss');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts yyyy-mm-dd hh:ii:ss');
}

try {
	$t->is($w->formatDate('2007-02-19'), '2007-02-19T00:00:00.000000'.date('P', strtotime('2007-02-19')), 'formatDate accepts yyyy-mm-dd');
}
catch(InvalidArgumentException $e) {
	$t->fail('formatDate accepts yyyy-mm-dd');
}
