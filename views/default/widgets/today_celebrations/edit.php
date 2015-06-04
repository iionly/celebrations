<?php
/**
 * Elgg Celebrations Plugin
 *
 * @package Celebrations
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Fernando Graells
 * @copyright Fernando Graells 2009
 * @link
 *
 * for Elgg 1.8 and newer by iionly
 * @copyright iionly 2012
 * iionly@gmx.de
 */
?>

<p>
<?php echo elgg_echo('celebrations:filterby').": ";
$user_guid = elgg_get_logged_in_user_guid();
echo elgg_view('input/select',array('name' => 'params[todayfilterid]', 'options_values'=>filterlist($user_guid),'value'=>$vars['entity']->filterid));
?>
</p>
