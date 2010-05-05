<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(7, new lime_output_color());

$w = new sfWidgetFormInputNumber();

$t->is($w->render('foobar'), '<input type="number" name="foobar" id="foobar" />', 'render empty tag ok');

$w->setOption('min', 0);
$t->like($w->render('foobar'), '/min="0"/', 'render attribute min ok');

$w->setOption('max', 100);
$t->like($w->render('foobar'), '/max="100"/', 'render attribute max ok');

$t->diag('test int option');
$w = new sfWidgetFormInputNumber(array(
	'min' => -456.78,
	'max' => 456.78,
	'int' => true
));
$tag = $w->render('foobar', 123.45);
$t->like($tag, '/min="-456"/', 'min rounded up');
$t->like($tag, '/max="456"/', 'max rounded down');
$t->like($tag, '/value="123"/', 'value is rounded');
$t->like($tag, '/step="1"/', 'step is set to 1');

