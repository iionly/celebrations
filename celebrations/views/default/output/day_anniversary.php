<?php

/**
 * today celebrations output
 * Displays a date output field
 *
 * @package celebrations
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Fernando Graells
 * @copyright Fernando Graells 2009-2013
 *
 * for Elgg 1.9 by iionly
 * @copyright iionly 2012-2013
 * iionly@gmx.de
 *
 * @uses $vars['value'] The current value, if any
 *
 */

$birthdate = printcelebrationsdate(2, $vars['value']);
$odd_even = $vars['odd_even'];

echo htmlentities($birthdate, ENT_QUOTES, 'UTF-8'); // $vars['value'];
