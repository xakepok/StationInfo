<?php
defined('_JEXEC') or die;
require_once 'helper.php';
$show_map = (bool) htmlspecialchars($params->get('show_map'));
$config = JComponentHelper::getParams('com_railway2');
$id         = JFactory::getApplication()->input->getInt('id', 0);
$desc       = ModStationinfoHelper::getDescTime();
$info       = ModStationinfoHelper::getInfo();
$turn       = ModStationinfoHelper::getTurn();
$crosses    = ModStationinfoHelper::getCrosses();

if (!empty($info->lt) && !empty($info->lg) && $show_map) JHtml::script('https://api-maps.yandex.ru/2.1/?lang=ru_RU');

require JModuleHelper::getLayoutPath('mod_stationinfo', $params->get('layout', 'default'));
