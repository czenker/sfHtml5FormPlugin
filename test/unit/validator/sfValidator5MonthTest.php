<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(3, new lime_output_color());

$v = new sfValidator5Month();

try {
	$t->is($v->clean('2007-02'), '2007-02-01', 'returns correct value.');
	$t->pass('Validates on valid data.');
}
catch(sfValidatorError $e) {
	$t->skip(1);
	$t->fail('Validates on valid data.');
}

try {
	$v->clean('19.02.2007');
	$t->fail('Fails on invalid data.');
}
catch(sfValidatorError $e) {
	$t->pass('Fails on invalid data.');
}
