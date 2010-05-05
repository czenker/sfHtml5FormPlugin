<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(7, new lime_output_color());

$v = new sfValidator5Email();

try {
	$v->clean('foobar@example.org');
	$t->pass('Validates on valid data. (just like sfValidatorEmail)');
}
catch(sfValidatorError $e) {
	$t->fail('Validates on valid data. (just like sfValidatorEmail)');
}

$t->diag('option multiple true');
$v->setOption('multiple', true);

try {
	$t->is_deeply($v->clean('foobar@example.org'), array('foobar@example.org'), 'single: returns an array');
	$t->pass('Validates on single email address.');
}
catch(sfValidatorError $e) {
	$t->skip(1);
	$t->fail('Validates on single email address.');
}

try {
	$t->is_deeply($v->clean('foobar@example.org,baz@example.com'), array('foobar@example.org', 'baz@example.com'), 'multiple: returns an array');
	$t->pass('Validates on multiple email addresses.');
}
catch(sfValidatorError $e) {
	$t->skip(1);
	$t->fail('Validates on multiple email address.');
}

try {
	$v->clean('foobar@example.org,noemail');
	$t->skip(1);
	$t->fail('Fails on invalid data.');
}
catch(sfValidatorError $e) {
	$args = $e->getArguments();
	$t->pass('Fails on invalid data.');
	$t->is($args['%value%'], 'noemail', 'displays just the first invalid email address.');
}


