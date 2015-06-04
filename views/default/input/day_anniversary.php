<?php

/**
 * Elgg Celebrations Plugin date input
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

elgg_require_js("celebrations/day_anniversary");

$class = $vars['class'];
if (!$class) {
	$class = "celebrations-input-date";
} else {
    $class .= " celebrations-input-date";
}

$birthdate = $vars['value'];
$ybdate = (int)gmdate('Y', $birthdate);
$mbdate = (int)gmdate('m', $birthdate);
$dbdate = (int)gmdate('d', $birthdate);

$daycount = 1;
$options_values_days = array();
while ($daycount < 32) {
	$options_values_days[$daycount] = $daycount;
	++$daycount;
}
$params_days = array(
	'name' => 'FirstSelectDay_' . $vars['name'],
	'id' => 'dayid_' . $vars['name'],
	'options_values' => $options_values_days,
	'value' => $dbdate,
	'class' => $class,
	'data-fieldname' => $vars['name'],
);

$monthcount = 1;
$options_values_months = array();
while ($monthcount < 13) {
	$options_values_months[$monthcount] = elgg_echo("celebrations:month:{$monthcount}");
	++$monthcount;
}
$params_months = array(
	'name' => 'FirstSelectMonth_' . $vars['name'],
	'id' => 'monthid_' . $vars['name'],
	'options_values' => $options_values_months,
	'value' => $mbdate,
	'class' => $class,
	'data-fieldname' => $vars['name'],
);

$year = (int)gmdate('Y');
$yearcount = $year;
$yearend = $year - 99;
$options_values_years = array();
while ($yearcount > $yearend) {
	$options_values_years[$yearcount] = $yearcount;
	--$yearcount;
}
$params_years = array(
	'name' => 'FirstSelectYear_' . $vars['name'],
	'id' => 'yearid_' . $vars['name'],
	'options_values' => $options_values_years,
	'value' => $ybdate,
	'class' => $class,
	'data-fieldname' => $vars['name'],
);

if ($vars['disabled']) {
	$params_days['disabled'] = true;
	$params_months['disabled'] = true;
	$params_years['disabled'] = true;
}

echo elgg_view('input/hidden', array('name' => $vars['name'], 'id' => $vars['name'] . 'id', 'value' => (int)$vars['value']));
echo "<p>";
echo elgg_view('input/select', $params_days);
echo elgg_view('input/select', $params_months);
echo elgg_view('input/select', $params_years);
echo "</p>";
