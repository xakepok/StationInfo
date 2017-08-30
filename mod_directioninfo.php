<?php
defined('_JEXEC') or die;
require_once 'helper.php';
$info = ModDirectioninfoHelper::getInfo();
$desc = ModDirectioninfoHelper::getDescTime();
$turnstiles = ModDirectioninfoHelper::getTurnstiles();
$crosses = ModDirectioninfoHelper::getCrosses();
//$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_directioninfo', $params->get('layout', 'default'));
