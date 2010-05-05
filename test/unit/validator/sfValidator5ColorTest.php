<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(3, new lime_output_color());

$v = new sfValidator5Color();

try {
	$v->clean('#ff00ff');
	$t->pass('Validates on valid data.');
}
catch(sfValidatorError $e) {
	$t->fail('Validates on valid data.');
}

try {
	$v->clean('foobar');
	$t->fail('Fails on invalid data.');
}
catch(sfValidatorError $e) {
	$t->pass('Fails on invalid data.');
}

try {
	$v->clean('#ff0');
	$t->fail('Fails on short #rgb-syntax.');
}
catch(sfValidatorError $e) {
	$t->pass('Fails on short #rgb-syntax.');
}


