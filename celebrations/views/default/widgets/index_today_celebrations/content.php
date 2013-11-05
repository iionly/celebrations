<?php
/**
 * Celebrations Plugin
 *
 * Index page Todays Celebrations widget for Widget Manager plugin
 *
 */

//filtered users
$filterid = (int) $vars['entity']->index_todayfilterid;
if (!$filterid){
    $filterid = 0;
}

print '<div class="user_settings"><p style="text-align:right">'.elgg_echo('today_celebrations:today').' <strong>'.printcelebrationsdate(1, time()).'</strong></p>';

$row_celebrations = user_celebrations(0,'next', $filterid);

// list of celebrations
if (!empty($row_celebrations)) {
    print '<table width="100%">';

    foreach($row_celebrations as $key => $val) {
        if (($val['type'] == 'dieday') || ($val['id'] == elgg_get_logged_in_user_guid())) {
            $sendcelebrationsmessage = '';
        } else {
            $sendcelebrationsmessage = '<a class="privatemessages" href="'.elgg_get_site_url().'messages/compose?send_to='.$val['id'].'" >&nbsp;</a>';
        }
        if ((elgg_get_plugin_setting("replaceage","celebrations") == 'yes') && ($val['type'] == 'birthdate')){
            $age = showage($val['date']).' '.elgg_echo('celebrations:age');
        } else {
            $age = '';
        }
        $even_odd = ( 'F3F3F3' != $even_odd ) ? 'F3F3F3' : 'FFFFFF';
        echo "<tr bgcolor=\"#{$even_odd}\">";
        print '<td><img class="user_mini_avatar" src="'.$val['icon'].'"> <a href="'.$val['url'].'" title="'.$val['fullname'].'">'.$val['name'].'</a></td><td align="right">'.elgg_echo('today_celebrations:'.$val['type']).'</td><td align="right">'.$age.'</td><td align="right">'.$sendcelebrationsmessage.'</td></tr>';
    }
    print '</table>';
} else {
    print "<p>".elgg_echo('today_celebrations:nocelebrations')."</p>";
}
print '</div>';
