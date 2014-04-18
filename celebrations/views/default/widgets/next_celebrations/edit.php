<?php
/**
 * Elgg Celebrations Plugin
 *
 * @package Celebrations
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Fernando Graells
 * @copyright Fernando Graells 2009-2014
 * @link
 *
 * for Elgg 1.8+1.9 by iionly
 * @copyright iionly 2012-2014
 * iionly@gmx.de
 */
?>

<p><?php echo elgg_echo("celebrations:numberdays"); ?>&nbsp;
<input type="text" name="params[nextdaysCelebrations]" value="<?php if(!empty($vars['entity']->nextdaysCelebrations)){ echo $vars['entity']->nextdaysCelebrations; } else { echo "7"; }?>" size="2"/>
</p>
<p><?php echo elgg_echo("celebrations:show_today"); ?>
	<select name="params[show_today]">
		<option value="0" <?php if($vars['entity']->show_today == 0) echo "SELECTED"; ?>><?php echo elgg_echo('option:no'); ?></option>
		<option value="1" <?php if($vars['entity']->show_today == 1) echo "SELECTED"; ?>><?php echo elgg_echo('option:yes'); ?></option>
    </select>
</p>
<p>
<?php echo elgg_echo('celebrations:filterby').": ";
$user_guid = elgg_get_logged_in_user_guid();
echo elgg_view('input/dropdown',array('name' => 'params[nextfilterid]', 'options_values'=>filterlist($user_guid),'value'=>$vars['entity']->filterid));
?>
</p>
