<?php

/**
 * Elgg Celebrations Plugin
 *
 * @package Celebrations
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Fernando Graells - ferg
 * @copyright Fernando Graells 2009
 *
 * for Elgg 1.8 and newer by iionly
 * @copyright iionly 2012
 * iionly@gmx.de
 */

elgg_register_event_handler('init', 'system', 'celebrations_init');

function celebrations_init() {

	elgg_register_library('celebrations_lib', elgg_get_plugins_path() . 'celebrations/lib/celebrations_lib.php');
	elgg_load_library('celebrations_lib');

	if (elgg_get_plugin_setting("ViewReminder", "celebrations") == 'yes') {
		elgg_register_event_handler('login:after', 'user', 'show_next_celebrations');
	}

	elgg_register_plugin_hook_handler('profile:fields', 'profile', 'celebrations_profile_fields_plugin_handler');

	if (elgg_is_logged_in()) {
		elgg_register_menu_item('site', array('name' => 'celebrations', 'text' => elgg_echo('celebrations:shorttitle'), 'href' => "celebrations/celebrations"));
	}

	// Extend system CSS
	elgg_extend_view('css/elgg', 'celebrations/css');

	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('celebrations','celebrations_page_handler');

	//add widgets
	elgg_register_widget_type('today_celebrations',elgg_echo("today_celebrations:title"),elgg_echo("today_celebrations:description"));
	elgg_register_widget_type('next_celebrations',elgg_echo("next_celebrations:title"),elgg_echo("next_celebrations:description"));

	//add index widgets for Widget Manager plugin
	elgg_register_widget_type('index_today_celebrations', elgg_echo('today_celebrations:title'), elgg_echo('today_celebrations:description'), array("index"));
	elgg_register_widget_type('index_next_celebrations', elgg_echo('next_celebrations:title'), elgg_echo('next_celebrations:description'), array("index"));

	elgg_register_plugin_hook_handler("entity:url", "object", "celebrations_widget_urls");

	elgg_register_action('celebrations/settings/save', elgg_get_plugins_path() . "celebrations/actions/celebrations/settings.php", 'admin');

	if (elgg_is_active_plugin('profile_manager')) {
		$profile_options = array(
			"show_on_register" => "no",
			"mandatory" => "no",
			"user_editable" => "yes",
			"output_as_tags" => "no",
			"admin_only" => "no",
			"count_for_completeness" => "yes"
		);
		profile_manager_add_custom_field_type("custom_profile_field_types", "day_anniversary", "day_anniversary", $profile_options);
		profile_manager_add_custom_field_type("custom_profile_field_types", "yearly", "day_anniversary", $profile_options);
	}
}

function celebrations_page_handler($page) {
	if (!isset($page[0])) {
		return false;
	}

	$resource_vars = array();
	switch ($page[0]) {
		case "celebrations":
			$resource_vars['month'] = elgg_extract(1, $page, date("n"));
			$resource_vars['filterid'] = elgg_extract(2, $page, 0);
			echo elgg_view_resource('celebrations/celebrations', $resource_vars);
			break;
		default:
			return false;
	}

	return true;
}

function show_next_celebrations() {

	$ViewReminder = elgg_get_plugin_setting("ViewReminder","celebrations");
	if(!$ViewReminder) {
		$ViewReminder = "no";
	}

	if ($ViewReminder = "yes") {
		$nextdaysCelebrations = elgg_get_plugin_setting("nextdaysCelebrations","celebrations");
		if(!$nextdaysCelebrations) {
			$nextdaysCelebrations = 7;
		}

		$celebrations = user_celebrations($nextdaysCelebrations, 'next', 0);

		//draw celebrations
		if (!empty($celebrations)) {
			foreach($celebrations as $key => $val) {
				if ($val['rest'] == 0) {
					$days = elgg_echo('next_celebrations:today');
				} elseif ($val['rest'] == 1) {
					$days = elgg_echo('next_celebrations:dayleft');
				} else {
					$days = elgg_echo('next_celebrations:in').' '.$val['rest'].' '.elgg_echo('next_celebrations:daysleft');
				}

				system_message($days.elgg_echo('next_celebrations:celebrate').$val['fullname'].elgg_echo('next_celebrations:genitive').elgg_echo('today_celebrations:'.$val['type']).'.');
			}
		}
	}

	return true;
}

function celebrations_profile_fields_plugin_handler($hook, $type, $return_value, $params) {

	// add celebrations fields to the core profile
	if((elgg_get_plugin_setting("lastname_field","celebrations") == 'yes') && (!array_key_exists('lastname', $return_value))) {
		$return_value['lastname'] = 'text';
	}
	if((elgg_get_plugin_setting("secondlastname_field","celebrations") == 'yes') && (!array_key_exists('secondlastname',$return_value ))) {
		$return_value['secondlastname'] = 'text';
	}
	if ((elgg_get_plugin_setting("celebrations_birthdate_field","celebrations") == 'yes') && (!array_key_exists('celebrations_birthdate', $return_value))) {
		$return_value['celebrations_birthdate'] = 'day_anniversary';
	}
	if ((elgg_get_plugin_setting("celebrations_dieday_field","celebrations") == 'yes') && (!array_key_exists('celebrations_dieday', $return_value))) {
		$return_value['celebrations_dieday'] = 'day_anniversary';
	}
	if ((elgg_get_plugin_setting("celebrations_feastdate_field","celebrations") == 'yes') && (!array_key_exists('celebrations_feastdate', $return_value))) {
		$return_value['celebrations_feastdate'] = 'yearly';
	}
	if ((elgg_get_plugin_setting("celebrations_weddingdate_field","celebrations") == 'yes') && (!array_key_exists('celebrations_weddingdate', $return_value))) {
		$return_value['celebrations_weddingdate'] = 'day_anniversary';
	}

	elgg_set_config('profile_celebrations_prefix', 'celebrations_');

	return $return_value;
}

function celebrations_widget_urls($hook_name, $entity_type, $return_value, $params) {
	$result = $return_value;
	$widget = $params["entity"];

	if(empty($result) && ($widget instanceof ElggWidget)) {
		switch($widget->handler) {
			case "today_celebrations":
			case "next_celebrations":
			case "index_today_celebrations":
			case "index_next_celebrations":
				$result = 'celebrations/celebrations/' . date("n") . '/0/';
				break;
		}
	}
	return $result;
}
