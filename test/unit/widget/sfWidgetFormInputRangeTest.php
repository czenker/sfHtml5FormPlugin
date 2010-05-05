<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(1, new lime_output_color());

$w = new sfWidgetFormInputRange();

$t->is($w->render('foobar'), '<input type="range" name="foobar" id="foobar" />', 'render empty tag ok');
