<?php
/**
 * Elgg Celebrations Plugin
 *
 * Index page Next Celebrations widget for Widget Manager plugin
 *
 */
?>

<p><?php echo elgg_echo("celebrations:numberdays"); ?>&nbsp;
<input type="text" name="params[index_nextdaysCelebrations]" value="<?php if(!empty($vars['entity']->index_nextdaysCelebrations)){ echo $vars['entity']->index_nextdaysCelebrations; } else { echo "7"; }?>" size="2"/>
</p>
<p><?php echo elgg_echo("celebrations:show_today"); ?>
	<select name="params[index_show_today]">
		<option value="0" <?php if($vars['entity']->index_show_today == 0) echo "SELECTED"; ?>><?php echo elgg_echo('option:no'); ?></option>
		<option value="1" <?php if($vars['entity']->index_show_today == 1) echo "SELECTED"; ?>><?php echo elgg_echo('option:yes'); ?></option>
	</select>
</p>
<p>
<?php echo elgg_echo('celebrations:filterby').": ";
echo elgg_view('input/dropdown',array('name' => 'params[index_nextfilterid]',
										'options_values'=>array('0' => elgg_echo('celebrations:option_all'), '-1' => elgg_echo('celebrations:option_friends')),
										'value'=>$vars['entity']->index_nextfilterid
));
?>
</p>
