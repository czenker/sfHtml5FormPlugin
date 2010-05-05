<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(5, new lime_output_color());

$v = new sfValidator5DateTime();

try {
	$t->is($v->clean('2007-02-19T12:34:56Z'), '2007-02-19 12:34:56', 'returns correct value when  using the default timezone.');
	$t->pass('Validates on valid data using the default timezone.');
}
catch(sfValidatorError $e) {
	throw $e;
	$t->skip(1);
	$t->fail('Validates on valid data using the default timezone.');
}

$default_timezone = date_default_timezone_get();
date_default_timezone_set('Europe/Paris');


try {
	/**
	 * timezone of the Marquesas Islands
	 * 
	 * please send me a postcard if you ever happen to be there :)
	 * 
	 * although i'm not sure if I wrote this test correctly, so if 
	 * it fails, it's likely to be my fault
	 */
	$t->is($v->clean('2007-02-19T02:04:56-09:30'), '2007-02-19 12:34:56', 'returns correct value when using a different timezone.');
	$t->pass('Validates on valid data using a different timezone.');
}
catch(sfValidatorError $e) {
	throw $e;
	$t->skip(1);
	$t->fail('Validates on valid data using a different timezone.');
}

date_default_timezone_set($default_timezone);


try {
	$v->clean('19.02.2007 12:34:56');
	$t->fail('Fails on invalid data.');
}
catch(sfValidatorError $e) {
	$t->pass('Fails on invalid data.');
}
