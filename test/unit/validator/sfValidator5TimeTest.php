<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(5, new lime_output_color());

$v = new sfValidator5Time();

try {
	$t->is($v->clean('12:34:56'), '12:34:56', 'returns correct value.');
	$t->pass('Validates on valid data.');
}
catch(sfValidatorError $e) {
	$t->skip(1);
	$t->fail('Validates on valid data.');
}

try {
	$t->is($v->clean('12:34:56.789'), '12:34:56', 'returns correct value with microseconds.');
	$t->pass('Validates on valid data with microseconds.');
}
catch(sfValidatorError $e) {
	$t->skip(1);
	$t->fail('Validates on valid data with microseconds.');
}

try {
	$v->clean('19.02.2007');
	$t->fail('Fails on invalid data.');
}
catch(sfValidatorError $e) {
	$t->pass('Fails on invalid data.');
}
