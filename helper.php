<?php
class ModStationinfoHelper {
	/* Запрос прав */
	static function canDo($p) {
		return JFactory::getUser()->authorise($p, 'com_railway2');
	}

	/* Инфа о станции */
	public static function getInfo() {
		$id = JFactory::getApplication()->input->getInt('id', 0);
		if ($id == 0) return false;

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('`s`.`name`,`n`.`popularName`, `type`.`title` as `tip`, `reg`.`region`, `rail`.`road`, `rail`.`division`, `dir`.`id` as `directionID`, `dir`.`title` as `direction`, `dir`.`color`, `d`.`zoneID`, `d`.`indexID`, `code`.`esr`, `code`.`express`')
			->from('#__rw2_stations as `s`')
			->leftJoin('#__rw2_station_types as `type` ON `type`.`id` = `s`.`type`')
			->leftJoin('#__rw2_regions as `reg` ON `reg`.`id` = `s`.`region`')
			->leftJoin('#__rw2_railways as `rail` ON `rail`.`id` = `s`.`railway`')
			->leftJoin('#__rw2_directions as `d` ON `d`.`stationID` = `s`.`id`')
			->leftJoin('#__rw2_directions_list as `dir` ON `dir`.`id` = `d`.`directionID`')
			->leftJoin('#__rw2_station_codes as `code` on `code`.`id` = `s`.`id`')
			->leftJoin('#__rw2_station_names as `n` ON `n`.`stationID` = `s`.`id`')
			->where('`s`.`id` = '.$id);
		$db->setQuery($query, 0, 1);
		$result = $db->loadObject();
		if (!isset($result->esr)) return false;
		return $result;
	}

	/* Инфа о турникетах */
	public static function getTurn() {
		$id = JFactory::getApplication()->input->getInt('id', 0);
		if ($id == 0) return false;

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('`v`.`variant` as `turnstiles`')
			->from('#__rw2_station_tickets as `t`')
			->where("`stationID` = {$id}")
			->leftJoin('#__rw2_turnstile_variants as `v` ON `v`.`id` = `t`.`turnstiles`');
		$db->setQuery($query);
		$result = $db->loadResult();
		return ($result != null) ? $result : JText::_('COM_RAILWAY2_TURN_NO_EXISTS');
	}

	/* Инфа о кассах */
	public static function getDescTime()
	{
		$id = JFactory::getApplication()->input->getInt('id', 0);
		if ($id == 0) return false;

		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query
			->select('`t`.*, `u`.`name` as `user`, `v`.`variant`')
			->from('#__rw2_station_tickets as `t`')
			->where("`stationID` = {$id}")
			->leftJoin('#__rw2_turnstile_variants as `v` ON `v`.`id` = `t`.`turnstiles`')
			->leftJoin('#__users as `u` ON `u`.`id` = `t`.`thanks`');
		$db->setQuery($query);
		$result = $db->loadObjectList();
		if (count($result) < 1) return false;
		$ret = array();
		foreach ($result as $item) {
			$ret[] = self::normalTime($item->time_1, $item->time_2, $item->turnstiles).' ('.JText::_('MOD_STATIONINFO_TIMEMASK_'.$item->timemask.'_SHORT').')';
		}

		return implode(', ', $ret);
	}

	function normalTime($t1, $t2, $turn) {
		$result = '';
		$result = date("H.i", strtotime(date("Y-m-d ".$t1))).' - '.date("H.i", strtotime(date("Y-m-d ".$t2)));
		if (($t1 == '00:00:00' && $t2 == '23:59:59') || ($t1 == null && $t2 == null && $turn != null)) $result = JText::_('MOD_STATIONINFO_EVERYTIME');
		if ($t1 == null && $t2 == null && $turn == null) $result = JText::_('MOD_STATIONINFO_NODESC');
		return $result;
	}
}