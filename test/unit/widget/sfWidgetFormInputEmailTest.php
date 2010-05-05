<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(3, new lime_output_color());

$w = new sfWidgetFormInputEmail();

$t->is($w->render('foobar'), '<input type="email" name="foobar" id="foobar" />', 'render empty tag ok');

$w->setOption('multiple', true);
$t->like($w->render('foobar'), '/multiple="/', 'render attribute multiple ok');

$t->like($w->render('foobar', array('foo@example.org', 'bar@example.org')), '/value="foo@example.org,bar@example.org/', 'render email address list on attribute multiple');