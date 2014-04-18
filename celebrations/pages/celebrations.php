<?php

gatekeeper();

elgg_set_context("celebrations");

if (get_input('filterid')){
	$filterid = get_input('filterid');
} else {
	$filterid = 0;
}
if (get_input('month')){
	$month = get_input('month');
} else {
	$month = date("n");
	forward(elgg_get_site_url() . "celebrations/celebrations/$month/$filterid");
}

$user_guid = elgg_get_logged_in_user_guid();
$onChange = "MM_jumpMenu('parent',this, $month)";
$divbox = '<div class="elgg-module elgg-module-aside"><div class="elgg-head"><h3>'.elgg_echo('celebrations:filterby').'</h3></div>';

$title = elgg_view_title(elgg_echo('celebrations:title').' '.elgg_echo('next_celebrations:in_title').' '.elgg_echo("celebrations:month:{$month}"));

// Format page
$area2 = $title . elgg_view('celebrations/list_celebrations', array('filterid' => $filterid, 'month' => $month));
$area3 = elgg_view('celebrations/sidebar', array('filterid' => $filterid, 'month' => $month));
$area3 .= $divbox . elgg_view('input/dropdown', array('name' => 'input_filterid', 'options_values' => filterlist($user_guid), 'value' => $filterid, 'onChange' => $onChange)) . '</div>';
$body = elgg_view('page/layouts/one_sidebar', array('content' => $area2, 'sidebar' => $area3));

// Draw it
echo elgg_view_page(elgg_echo('celebrations:title'), $body);

?>

<script type="text/javascript">
function MM_jumpMenu(targ,selObj,month){
	eval(targ+".location='<?php echo elgg_get_site_url() ?>"+"celebrations/celebrations/"+month+"/"+selObj.options[selObj.selectedIndex].value+"'");
}
</script>
