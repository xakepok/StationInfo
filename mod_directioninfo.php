<?php
defined('_JEXEC') or die;
require_once 'helper.php';
$dir = JFactory::getApplication()->input->getInt('id', 0);
$info = ModDirectioninfoHelper::getInfo();
$desc = ModDirectioninfoHelper::getDescTime();
$turnstiles = ModDirectioninfoHelper::getTurnstiles();
$crosses = ModDirectioninfoHelper::getCrosses();
$cocon = ModDirectioninfoHelper::getCocon();
//$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_directioninfo', $params->get('layout', 'default'));
