<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(1, new lime_output_color());

$w = new sfWidgetFormInputColor();

$t->is($w->render('foobar'), '<input type="color" name="foobar" id="foobar" />', 'render empty tag ok');