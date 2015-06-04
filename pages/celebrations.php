<?php

gatekeeper();

elgg_require_js("celebrations/celebrations");

elgg_set_context("celebrations");

elgg_push_breadcrumb(elgg_echo('celebrations:shorttitle'), 'celebrations/celebrations/' . date("n") . '/0/');

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

elgg_push_breadcrumb(elgg_echo("celebrations:month:$month"));

$user_guid = elgg_get_logged_in_user_guid();
$divbox = '<div class="elgg-module elgg-module-aside"><div class="elgg-head"><h3>'.elgg_echo('celebrations:filterby').'</h3></div>';

$title = elgg_echo('celebrations:title') .' '. elgg_echo('next_celebrations:in_title') .' '. elgg_echo("celebrations:month:{$month}");

// Format page
$area2 = elgg_view('celebrations/list_celebrations', array('filterid' => $filterid, 'month' => $month));
$area3 = elgg_view('celebrations/sidebar', array('filterid' => $filterid, 'month' => $month));
$area3 .= $divbox . elgg_view('input/select', array('name' => 'input_filterid', 'id' => 'input_filterid', 'options_values' => filterlist($user_guid), 'value' => $filterid, 'data-month' => $month)) . '</div>';
$body = elgg_view_layout('content', array('content' => $area2, 'filter' => '', 'title' => $title, 'sidebar' => $area3));

// Draw it
echo elgg_view_page(elgg_echo('celebrations:title'), $body);
