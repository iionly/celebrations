<?php

// calculate remaining days until celebration date
function check_days($datecelebration) {

	$today = date("Y/m/d");
	$numdaysuntil = round((strtotime($datecelebration)-strtotime($today))/(24*60*60),0);

	return $numdaysuntil;
}

// convert dates
function convert_date($fecha, $feast) {

	if ($feast == 1) {
		list($dia, $mes) = explode("-", $fecha);
		$celebration = date("Y").'/'.$mes.'/'.$dia;
	} else {
		// year of celebration date is replaced with current year to allow for checking of upcoming celebrations days
		$celebration = gmdate("Y").'/'.gmdate("m", $fecha).'/'.gmdate("d", $fecha);
	}

	return $celebration;
}

// date order
function printcelebrationsdate($type, $date) {

	$date_type = elgg_get_plugin_setting("date_type", "celebrations");
	if(!$date_type) {
		$date_type = 1;
	}
	if (!type) {
		$type = 1; // by default short date
	}
	if (!isset($date)) {
		$date = time();
		if ($date_type == 1) {
			if ($type == 1) {
				$transformdate = date("d/m/Y", $date);
			} else {
				$date_day = date('j', $date);
				$date_month = date('n', $date);
				$date_year = date('Y', $date);
				$transformdate = $date_day . '. ' . elgg_echo("celebrations:month:$date_month") . ' ' . $date_year;
			}
		} else {
			if ($type == 1) {
				$transformdate = date("m/d/Y", $date);
			} else {
				$date_day = date('j', $date);
				$date_month = date('n', $date);
				$date_year = date('Y', $date);
				$transformdate = elgg_echo("celebrations:month:$date_month") . ' ' . $date_day . ', ' . $date_year;
			}
		}
	} else {
		if ($date_type == 1) {
			if ($type == 1) {
				$transformdate = gmdate("d/m/Y", $date);
			} else {
				$date_day = gmdate('j', $date);
				$date_month = gmdate('n', $date);
				$date_year = gmdate('Y', $date);
				$transformdate = $date_day . '. ' . elgg_echo("celebrations:month:$date_month") . ' ' . $date_year;
			}
		} else {
			if ($type == 1) {
				$transformdate = gmdate("m/d/Y", $date);
			} else {
				$date_day = gmdate('j', $date);
				$date_month = gmdate('n', $date);
				$date_year = gmdate('Y', $date);
				$transformdate = elgg_echo("celebrations:month:$date_month") . ' ' . $date_day . ', ' . $date_year;
			}
		}
	}

	return $transformdate;
}

// check if there are any celebrations within the next few days
function checknextfewdays($fecha, $feast, $num, $type, $month) {

	if ($fecha) {
		$celebration = convert_date($fecha, $feast);
		if ($type == 'month') {
			$mes = explode("/", $celebration);
			if ($mes[1] == $month) {
				return true;
			} else {
				return false;
			}
		} elseif ($type == 'next') {
			$until = check_days($celebration);
			if (($until >= 0) && ($until <= $num)) {
				$until++;
				return $until;
			} else {
				return false;
			}
		}
	} else {
		return false;
	}
}

// ordering of celebrations
function orderdate($x, $y) {
	if ( $x['rest'] == $y['rest'] ) {
		return 0;
	} else if ( $x['rest'] < $y['rest'] ) {
		return -1;
	} else {
		return 1;
	}
}

function user_celebrations($num, $checkdaystype, $filter, $month = null) {

	if(!$month) {
		$$month = date("n");
	}

	if (!$filter) {
		$filter = 0;
	}
	if($filter < 0) {
		$users = elgg_get_logged_in_user_entity()->getFriends('', false);
	} elseif ($filter >= 1) {
		$group = get_entity($filter);
		if ($group instanceof ElggGroup) {
			if ($group->isMember(elgg_get_logged_in_user_entity())) {
				$users = $group->getMembers(array('limit' => false));
			}
		}
	} else {
		$users = elgg_get_entities(array('type' => 'user', 'limit' => false));
	}

	//check the profile fields for the prefix of the celebrations plugin. This let us to grow up easily the number of fields
	$celebrationfields = array();
	$prefix = elgg_get_config('profile_celebrations_prefix');
	$profile_fields = elgg_get_config('profile_fields');
	if (is_array($profile_fields) && sizeof($profile_fields) > 0) {
		foreach($profile_fields as $shortname => $valtype) {
			$match = '/^'.$prefix.'.*$/';
			if (preg_match($match, $shortname)) {
				$varcelebration = $shortname;
				$celebrationfields[$varcelebration] = $valtype;
			}
		}
	}

	if(!empty($users)) {
		foreach($users as $allusers) {
			$user = get_user($allusers->guid);
			$fullname = htmlentities($user->name, ENT_QUOTES, 'UTF-8') . " " . $user->lastname . " " . $user->secondlastname;
			if(!empty($celebrationfields)) {
				foreach($celebrationfields as $key => $valtype) {
					$celebrationday = $user->$key;
					$key = mb_substr($key, strlen($prefix), strlen($key));
					if (($valtype == 'day_anniversary') && ($rest = checknextfewdays($celebrationday, 0, $num, $checkdaystype, $month))) {
						$rest = $rest-1;
						$row[] = array('name' => $user->name, 'fullname' => $fullname, 'id' => $user->guid, 'type' => $key, 'date' => $celebrationday, 'url' => $user->getURL(), 'icon' => $user->getIconURL('topbar'), 'format' => $valtype, 'rest' => $rest);
					} elseif (($valtype == 'yearly') && ($rest = checknextfewdays($celebrationday, 1, $num, $checkdaystype, $month))) {
						$rest = $rest-1;
						list($dia, $mes) = explode("-", $celebrationday);
						$feastday = strtotime(date("Y").'/'.$mes.'/'.$dia);
						$row[] = array('name' => $user->name, 'fullname' => $fullname, 'id' => $user->guid, 'type' => $key, 'date' => $feastday, 'url' => $user->getURL(), 'icon' => $user->getIconURL('topbar'), 'format' => $valtype, 'rest' => $rest);
					}
				}
			}
		}
	}
	if ($row) {
		uasort($row, 'orderdate'); //sort by celebration
	}
	return $row;
}

function filterlist($user_guid = null) {

	if (!$user_guid) {
		$user_guid = elgg_get_logged_in_user_guid();
	}
	$user_entity = get_entity($user_guid);
	$mygroups = $user_entity->getGroups(array('limit' => false));
	$filteroptions = array();
	$filteroptions = array('0' => elgg_echo('celebrations:option_all'), '-1' => elgg_echo('celebrations:option_friends'));
	if(!empty($mygroups)) {
		foreach ($mygroups as $mygroup) {
			$mygroup_guid = $mygroup['guid'];
			$filteroptions[$mygroup_guid] = $mygroup['name'];
		}
	}

	return $filteroptions;
}

function showage($birthday) {

	// Parse Birthday Input Into Local Variables
	// Assumes Input In Form: YYYYMMDD
	$yIn=(int)gmdate("Y", $birthday);
	$mIn=(int)gmdate("m", $birthday);
	$dIn=(int)gmdate("d", $birthday);

	// Calculate Differences Between Birthday And Now
	// By Subtracting Birthday From Current Date
	$ddiff = date("d") - $dIn;
	$mdiff = date("m") - $mIn;
	$ydiff = date("Y") - $yIn;

	// Check If Birthday Month Has Been Reached
	if ($mdiff < 0) {
		// Birthday Month Not Reached
		// Subtract 1 Year From Age
		$ydiff--;
	} elseif ($mdiff==0) {
		// Birthday Month Currently
		// Check If BirthdayDay Passed
		if ($ddiff < 0) {
			//Birthday Not Reached
			// Subtract 1 Year From Age
			$ydiff--;
		}
	}

	return $ydiff;
}
