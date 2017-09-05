<?php
class ModDirectioninfoHelper {
	/* Запрос прав */
	static function canDo($p) {
		return JFactory::getUser()->authorise($p, 'com_railway2');
	}

	/* Инфа о коконах */
	public static function getCocon()
	{
		$dir = JFactory::getApplication()->input->getInt('id', 0);
		if ($dir == 0) return false;

		$db    =& JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('`cocon`')
			->from('#__rw2_direction_info')
			->where("`directionID` = {$dir}");
		$db->setQuery($query, 0, 1);
		return $db->loadResult();
	}

	/* Информация о направлении */
	public static function getInfo()
	{
		$dir = JFactory::getApplication()->input->getInt('id', 0);
		if ($dir == 0) return false;

		$db    =& JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('*')
			->from('#__rw2_directions_list')
			->where("`id` = {$dir}");
		if (!self::canDo('core.admin'))
		{
			$query->where('`active` = 1');
		}
		$db->setQuery($query, 0, 1);
		$result = $db->loadObject();

		return (!empty($result->id)) ? $db->loadObject() : false;
	}

	/* Пересадки на метро */
	public static function getCrosses()
	{
		$dir = JFactory::getApplication()->input->getInt('id', 0);
		if ($dir == 0) return false;

		$db =& JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('`c`.`stationID`, `s`.`name`, `n`.`popularName`, `m`.`title_ru` as `metroStation`, `l`.`title_ru` as `metroLine`, `l`.`color`')
			->from('#__rw2_cross_metro as `c`')
			->leftJoin('#__rw2_stations as `s` ON `s`.`id` = `c`.`stationID`')
			->leftJoin('#__rw2_directions as `d` ON `d`.`stationID` = `c`.`stationID`')
			->leftJoin('#__rw2_station_names as `n` ON `n`.`stationID` = `c`.`stationID`')
			->leftJoin('#__rw2_metro_stations as `m` ON `m`.`id` = `c`.`metroID`')
			->leftJoin('#__rw2_metro_lines as `l` ON `l`.`id` = `m`.`line`')
			->where("`d`.`directionID` = {$dir} AND `m`.`active` = 1 AND `l`.`active` = 1");
		$db->setQuery($query);
		$result = $db->loadObjectList();
		if (empty($result)) return false;
		$cross = array();
		foreach ($result as $item) {
			$name = (!empty($item->popularName)) ? $item->popularName : $item->name;
			$link = JHtml::link(JRoute::_('index.php?option=com_railway2&view=station&id='.$item->stationID.'&Itemid=236'), $name);
			if (!isset($cross[$link])) $cross[$link] = $cross[$link] = array();
			$cross[$link][] = "<a class='jutooltip' style='color: {$item->color};' title='".$item->metroLine." ".mb_strtolower(JText::_('MOD_DIRECTIONINFO_METRO_LINE'))."'>$item->metroStation</a>";
		}
		$result = array();
		foreach ($cross as $station => $metro) {
			$result[$station] = implode(', ', $metro);
		}
		return $result;
	}

	/* Время работы касс на направлении */
	public static function getDescTime()
	{
		$dir = JFactory::getApplication()->input->getInt('id', 0);
		if ($dir == 0) return false;

		$db =& JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('DISTINCT `s`.`id` as `stationID`, `s`.`name` as `name`, `n`.`popularName` as `popularName`, `t`.`time_1`, `t`.`time_2`, `t`.`turnstiles`')
			->from('#__rw2_station_tickets as `t`')
			->leftJoin('#__rw2_directions as `d` ON `d`.`stationID` = `t`.`stationID`')
			->leftJoin('#__rw2_station_names as `n` ON `n`.`stationID` = `t`.`stationID`')
			->leftJoin('#__rw2_stations as `s` ON `s`.`id` = `t`.`stationID`')
			->where("`d`.`directionID` = {$dir} AND `t`.`time_1` IS NOT NULL AND `t`.`time_2` IS NOT NULL")
			->order('`d`.`indexID`, `t`.`time_1`')
		;
		$db->setQuery($query);
		$result = $db->loadObjectList();
		$stations = array(); //Результирующий массив
		foreach ($result as $item) {
			$sname = (!empty($item->popularName)) ? $item->popularName : $item->name;
			$stations[$sname][] = ($item->time_1 == '00:00:00' && $item->time_2 == '23:59:59') ? JText::_('MOD_DIRECTIONINFO_EVERYTIME') : date("H.i", strtotime(date("Y-m-d ").$item->time_1)).'-'.date("H.i", strtotime(date("Y-m-d ").$item->time_2));
		}
		$result = array();
		foreach ($stations as $name => $value) {
			$result[$name] = implode(', ', $value);
		}
		return $result;
	}

	/* Станции с турникетами */
	public static function getTurnstiles()
	{
		$dir = JFactory::getApplication()->input->getInt('id', 0);

		if ($dir == 0) return false;
		$db =& JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('DISTINCT `s`.`id` as `stationID`, `s`.`name` as `name`, `n`.`popularName` as `popularName`, `t`.`turnstiles`')
			->from('#__rw2_station_tickets as `t`')
			->leftJoin('#__rw2_directions as `d` ON `d`.`stationID` = `t`.`stationID`')
			->leftJoin('#__rw2_station_names as `n` ON `n`.`stationID` = `t`.`stationID`')
			->leftJoin('#__rw2_stations as `s` ON `s`.`id` = `t`.`stationID`')
			->where("`d`.`directionID` = {$dir} AND `t`.`time_1` IS NULL AND `t`.`time_2` IS NULL AND `t`.`turnstiles` IS NOT NULL")
			->order('`d`.`indexID`')
		;
		$db->setQuery($query);
		$result = $db->loadObjectList();
		return $result;
	}
}