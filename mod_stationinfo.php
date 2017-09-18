<?php
defined('_JEXEC') or die;
require_once 'helper.php';
$config = JComponentHelper::getParams('com_railway2');
$id         = JFactory::getApplication()->input->getInt('id', 0);
$desc       = ModStationinfoHelper::getDescTime();
$info       = ModStationinfoHelper::getInfo();
$turn       = ModStationinfoHelper::getTurn();
$crosses    = ModStationinfoHelper::getCrosses();

//$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_stationinfo', $params->get('layout', 'default'));
