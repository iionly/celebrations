<?php
/**
 * Elgg Celebrations plugin
 *
 * Index page Next Celebrations widget for Widget Manager plugin
 *
 */

//the number of days to review
$num = (int) $vars['entity']->index_nextdaysCelebrations;
if (!$num) {
	$num = 7;
}

//filtered users
$filterid = (int) $vars['entity']->index_nextfilterid;
if (!$filterid) {
	$filterid = 0;
}

print '<div class="user_settings"><p style="text-align:right">'.elgg_echo('today_celebrations:today').' <strong>'.printcelebrationsdate(1, time()).'</strong></p>';

$row_celebrations = user_celebrations($num, 'next', $filterid);

$show_today = (int) $vars['entity']->index_show_today;
if (!$show_today) {
	$show_today = 0;
}

//draw celebrations
if (!empty($row_celebrations)) {
	print '<table width="100%">';

	foreach($row_celebrations as $key => $val) {
		if (($show_today == 1) || ($val['rest'] >= 1)) {
			$even_odd = ( 'F3F3F3' != $even_odd ) ? 'F3F3F3' : 'FFFFFF';
			echo "<tr bgcolor=\"#{$even_odd}\">";

			$sendcelebrationsmessage = '';
			if ($val['rest'] == 0) {
				if (($val['type'] != 'dieday') && ($val['id'] != elgg_get_logged_in_user_guid())) {
					$sendcelebrationsmessage = '<a class="privatemessages" href="'.elgg_get_site_url().'messages/compose?send_to='.$val['id'].'" >&nbsp;</a>';
				}
				$daysleftshow = elgg_echo('next_celebrations:today');
			} else if ($val['rest'] == 1) {
				$daysleftshow = '<abbr title="'.printcelebrationsdate(1,$val['date']).'">('.elgg_echo('next_celebrations:dayleft').')</abbr>';
			} else {
				$daysleftshow = '<abbr title="'.printcelebrationsdate(1,$val['date']).'">('.$val['rest'].' '.elgg_echo('next_celebrations:daysleft').')</abbr>';
			}

			print '<td><img class="user_mini_avatar" src="'.$val['icon'].'"> <a href="'.$val['url'].'" title="'.$val['fullname'].'">'.$val['name'].'</a></td><td align="right">'.elgg_echo('today_celebrations:'.$val['type']).'</td><td align="right">'.$daysleftshow.'</td><td align="right">'.$sendcelebrationsmessage.'</td></tr>';
		}
	}
	print '</table>';
} else {
	print "<p>".elgg_echo('next_celebrations:nocelebrations',array($num))."</p>";
}
print '</div>';
