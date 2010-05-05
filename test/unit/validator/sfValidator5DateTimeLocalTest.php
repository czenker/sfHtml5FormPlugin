<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(7, new lime_output_color());

$v = new sfValidator5DateTimeLocal();

try {
	$t->is($v->clean('2007-02-19T12:34:56'), '2007-02-19 12:34:56', 'returns correct value.');
	$t->pass('Validates on valid data.');
}
catch(sfValidatorError $e) {
	$t->skip(1);
	$t->fail('Validates on valid data.');
}

try {
	$t->is($v->clean('2007-02-19T12:34:56.789'), '2007-02-19 12:34:56', 'microseconds are stripped and ignored.');
	$t->pass('Validates on valid data with microseconds.');
}
catch(sfValidatorError $e) {
	$t->skip(1);
	$t->fail('Validates on valid data with microseconds.');
}

// opera does not send 
try {
	$t->is($v->clean('2007-02-19T12:34'), '2007-02-19 12:34:00', 'validates on missing seconds and returns current value.');
	$t->pass('validates on missing seconds.');
}
catch(sfValidatorError $e) {
	$t->skip(1);
	$t->fail('validates on missing seconds.');
}

try {
	$v->clean('19.02.2007 12:34:56');
	$t->fail('Fails on invalid data.');
}
catch(sfValidatorError $e) {
	$t->pass('Fails on invalid data.');
}
