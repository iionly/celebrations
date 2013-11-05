<?php
/**
 * Elgg Celebrations Plugin
 *
 * Index page Todays Celebrations widget for Widget Manager plugin
 *
 */
?>

<p>
<?php echo elgg_echo('celebrations:filterby').": ";
echo elgg_view('input/dropdown',array('name' => 'params[index_todayfilterid]',
                                      'options_values'=>array('0' => elgg_echo('celebrations:option_all'), '-1' => elgg_echo('celebrations:option_friends')),
                                      'value'=>$vars['entity']->index_todayfilterid));
?>
</p>
