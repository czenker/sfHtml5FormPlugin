<?php 
include(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(5, new lime_output_color());

$w = new sfWidgetFormInputDatalist();

$t->is($w->render('foobar'), '<input type="text" name="foobar" list="foobar_datalist" id="foobar" /><datalist id="foobar_datalist"></datalist>', 'render empty tag ok');

$w->setOption('choices', array('foo', 'bar', 'baz'));

$t->like($w->render('foobar'), '#<datalist id="foobar_datalist"><option value="foo" />
<option value="bar" />
<option value="baz" /></datalist>#', 'render attribute choices ok');

$w->setOption('choices', array());
$w->setOption('choices_url', 'autocomplete.php');

$t->like($w->render('foobar'), '#oninput="list.data = \'autocomplete.php\?q=#', 'render attribute choices_url ok');

$w->setOption('choices_url_param', 'query');
$t->like($w->render('foobar'), '#oninput="list.data = \'autocomplete.php\?query=#', 'render attribute choices_url_param ok');

$w->setOption('datalist_id', 'baz');
$t->like($w->render('foobar'), '#list="baz".*?<datalist id="baz">#', 'render attribute datalist_id ok');