<div align='center'>
<table border=0 width=100%>

<?php

	$filterid = $vars['filterid'];
	$month = $vars['month'];

	// checks for users celebrating something this month
	$row = user_celebrations(1, 'month', $filterid, $month);

	// start the draw of celebrations
	$row2 = array();
	if (!empty($row)) {
		// we calculate the day to order the array
		foreach($row as $key => $val) {
			if ($val['format'] == 'day_anniversary') {
				$celebrations_day = gmdate('d', $val['date']);
			} else {
				$celebrations_day = date('d', $val['date']);
			}
			$val['rest'] = $celebrations_day;
			$row2[$key] = $val;
		}
		uasort($row2, 'orderdate'); //sort by day
		if (!empty($row2)) {
			foreach($row2 as $key => $val) {
				$even_odd = ( 'F3F3F3' != $even_odd ) ? 'F3F3F3' : 'FFFFFF';

				// Let's call it for individual lines so we can add extra info like marriages, children, links etc.
				$celebrations_day = gmdate('d', $val['date']);
				$current_day = date('d',time());
				$celebrations_month = gmdate('m', $val['date']);
				$current_month = date('m',time());
				$celebrations_date = printcelebrationsdate(2, $val['date']);

				// now display a single line
				echo "<tr bgcolor=\"#{$even_odd}\">";
				echo '<td>'.elgg_echo('celebrations:day').': '.$val['rest'].'</td><td>';
				echo '<img class="user_mini_avatar" src="'.$val['icon'].'"> <a href="'.$val['url'].'">'.$val['fullname'].'</a>';
				echo '</td>';

				// show type of celebration
				echo '<td>'.elgg_echo('today_celebrations:'.$val['type']).'</td>';

				if ($val['format'] == 'day_anniversary') {
					if ((elgg_get_plugin_setting("replaceage","celebrations") == 'yes') && ($val['type'] == 'birthdate')) {
						echo "<td>".showage($val['date']).' '.elgg_echo('celebrations:age')."</td>";
					} else {
						echo "<td>".$celebrations_date."</td>";
					}
				} else {
					echo "<td>&nbsp;</td>";
				}

				if (($celebrations_month == $current_month) && ($celebrations_day == $current_day)) {
					if (($val['type'] == 'dieday') || ($val['id'] == elgg_get_logged_in_user_guid())) {
						echo "<td>&nbsp;</td>";
					} else {
						$sendcelebrationsmessage = '<a class="privatemessages" href="'.elgg_get_site_url().'messages/compose?send_to='.$val['id'].'" >&nbsp;</a>';
						echo '<td>'.$sendcelebrationsmessage.'</td>';
					}
				} else {
					echo "<td>&nbsp;</td>";
				}

				echo "</tr>\n";
			}
		}

	} else {
		echo "<div align='left'>";
		print elgg_echo('today_celebrations:nocelebrations');
		echo "</div>";
	}
?>
</table>
</div>
