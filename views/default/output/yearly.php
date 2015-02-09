<?php

/**
 * today celebrations output
 * Displays a date output field
 *
 * @package celebrations
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Fernando Graells
 * @copyright Fernando Graells 2009-2014
 *
 * for Elgg 1.8+1.9 by iionly
 * @copyright iionly 2012-2014
 * iionly@gmx.de
 *
 * @uses $vars['value'] The current value, if any
 *
 */

$feastday = $vars['value'];
$feast = explode('-', $feastday);

$feastoutput = $feast[0].' '.elgg_echo('profile:celebrations_dayofmonth').' '.elgg_echo("celebrations:month:{$feast[1]}");

$odd_even = $vars['odd_even'];

echo htmlentities($feastoutput, ENT_QUOTES, 'UTF-8'); // $vars['value'];
