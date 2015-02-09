<?php
/**
 * Profile Manager
 *
 * Action to import from default
 *
 * @package profile_manager
 * @author ColdTrick IT Solutions
 * @copyright Coldtrick IT Solutions 2009-2014
 * @link http://www.coldtrick.com/
 *
 * adapted and modified for the celebrations plugin for Elgg 1.8+1.9 by iionly
 * (c) iionly 2012-2014
 *
 */

$site_guid = elgg_get_site_entity()->getGUID();

// Params array (text boxes and drop downs)
$params = get_input('params');
$result = false;
if(!empty($params)) {
	foreach ($params as $k => $v) {
		if (!elgg_set_plugin_setting($k, $v, 'celebrations')) {
			register_error(elgg_echo('plugins:settings:save:fail', array('celebrations')));
			forward(REFERER);
		}
	}
}

if (elgg_is_active_plugin('profile_manager', $site_guid)) {

	$added = 0;
	$removed = 0;
	$defaults = array();

	$options = array(
		"type" => "object",
		"subtype" => "custom_profile_field",
		"count" => true,
		"owner_guid" => $site_guid
	);

	$options_no_count = array(
		"type" => "object",
		"subtype" => "custom_profile_field",
		"count" => false,
		"owner_guid" => $site_guid
	);

	$max_fields = elgg_get_entities($options) + 1;

	$defaults = array(
		'lastname' => 'text',
		'secondlastname' => 'text',
		'celebrations_birthdate' => 'day_anniversary',
		'celebrations_dieday' => 'day_anniversary',
		'celebrations_feastdate' => 'yearly',
		'celebrations_weddingdate' => 'day_anniversary'
	);

	foreach($defaults as $metadata_name => $metadata_type) {
		$options["metadata_name_value_pairs"] = array("name" => "metadata_name", "value" => $metadata_name);

		$count = elgg_get_entities_from_metadata($options);

		if (($count == 1) && (elgg_get_plugin_setting($metadata_name."_field","celebrations") == 'no')) {

			$options_no_count["metadata_name_value_pairs"] = array("name" => "metadata_name", "value" => $metadata_name);
			$field_to_delete = elgg_get_entities_from_metadata($options_no_count);

			if(($field_to_delete) && ($field_to_delete[0]->getSubtype() == "custom_profile_field")) {
				if($field_to_delete[0]->delete()) {
					$max_fields--;
					$removed++;
				}
			}
		} elseif ($count > 1) {
			register_error('Error: more than one of the same custom profile field to delete found!');
		}
	}

	foreach($defaults as $metadata_name => $metadata_type) {
		$options["metadata_name_value_pairs"] = array("name" => "metadata_name", "value" => $metadata_name);

		$count = elgg_get_entities_from_metadata($options);

		if (($count == 0) && (elgg_get_plugin_setting($metadata_name."_field","celebrations") == 'yes')) {
			$field = new ElggObject();

			$field->owner_guid = $site_guid;
			$field->container_guid = $site_guid;
			$field->access_id = ACCESS_PUBLIC;
			$field->subtype = "custom_profile_field";
			$field->save();

			$field->metadata_name = $metadata_name;
			$field->metadata_type = $metadata_type;

			$field->show_on_register = "no";
			$field->mandatory = "no";
			$field->user_editable = "yes";

			$field->order = $max_fields;

			$field->save();

			$max_fields++;
			$added++;
		}
	}
}
system_message(elgg_echo('Settings for the %s plugin were saved successfully.', array('celebrations')));
forward(REFERER);