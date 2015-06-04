<?php

/**
 * Elgg Celebrations Plugin partial date input
 * Displays a date selection
 * Adapted from plugin "profile age and gender"
 * @package celebrations
 * @subpackage input field
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Fernando Graells
 * @copyright Fernando Graells 2009
 * @link
 *
 * for Elgg 1.8 and newer by iionly
 * @copyright iionly 2012
 * iionly@gmx.de
 *
 * @uses $vars['value'] The current value, if any
 * @uses $vars['name'] The name of the input field
 * @uses $vars['disabled'] If true then control is read-only
 * @uses $vars['class'] Class override
 */

elgg_require_js("celebrations/yearly");

$class = $vars['class'];
if (!$class) {
	$class = "celebrations-input-feast";
} else {
    $class .= " celebrations-input-feast";
}

$feastdate = $vars['value'];
$feast = explode('-', $feastdate);

$mbdate2 = $feast[1]; //date("m", $feastdate);
$dbdate2 = $feast[0]; //date("d", $feastdate);

$daycount2 = 1;
$options_values_days2 = array();
while ($daycount2 < 32) {
	$options_values_days2[$daycount2] = $daycount2;
	++$daycount2;
}
$params_days2 = array(
	'name' => 'FirstSelectDay2_' . $vars['name'],
	'id' => 'dayid2_' . $vars['name'],
	'options_values' => $options_values_days2,
	'value' => $dbdate2,
	'class' => $class,
	'data-fieldname' => $vars['name'],
);

$monthcount2 = 1;
$options_values_months2 = array();
while ($monthcount2 < 13) {
	$options_values_months2[$monthcount2] = elgg_echo("celebrations:month:{$monthcount2}");
	++$monthcount2;
}
$params_months2 = array(
	'name' => 'FirstSelectMonth2_' . $vars['name'],
	'id' => 'monthid2_' . $vars['name'],
	'options_values' => $options_values_months2,
	'value' => $mbdate2,
	'class' => $class,
	'data-fieldname' => $vars['name'],
);

if ($vars['disabled']) {
	$params_days2['disabled'] = true;
	$params_months2['disabled'] = true;
}

echo elgg_view('input/hidden', array('name' => $vars['name'], 'id' => $vars['name'] . 'id', 'value' => $vars['value']));
echo "<p>";
echo elgg_view('input/select', $params_days2);
echo elgg_view('input/select', $params_months2);
echo "</p>";
