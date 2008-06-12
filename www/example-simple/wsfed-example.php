<?php

require_once('../_include.php');

$config = SimpleSAML_Configuration::getInstance();
$session = SimpleSAML_Session::getInstance();

if (!$session->isValid('wsfed') ) {
	SimpleSAML_Utilities::redirect(
		'/' . $config->getBaseURL() . 'wsfed/sp/initSSO.php',
		array('RelayState' => SimpleSAML_Utilities::selfURL())
	);
}

$attributes = $session->getAttributes();

$t = new SimpleSAML_XHTML_Template($config, 'status.php', 'attributes.php');

$t->data['header'] = 'WS-Fed SP Demo Example';
$t->data['remaining'] = $session->remainingTime();
$t->data['sessionsize'] = $session->getSize();
$t->data['attributes'] = $attributes;
$t->data['icon'] = 'bino.png';
$t->data['logout'] = null;
$t->show();


?>
