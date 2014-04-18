<?php
?>

<div class="elgg-module elgg-module-aside">
	<div class="elgg-head">
		<h3><?php echo elgg_echo('celebrations:list_monthly'); ?></h3>
	</div>
	<div>
		<?php
			$filterid = $vars['filterid'];

            for($i = 1; $i <= 12; $i += 1) {
				$url = elgg_get_site_url() . "celebrations/celebrations/$i/$filterid";
				$item = new ElggMenuItem(elgg_echo("celebrations:month:{$i}"), elgg_echo("celebrations:month:{$i}"), $url);
				$item->setContext('celebrations');
				$item->setSection('a');

				$celebrations_monthly .= elgg_view('navigation/menu/elements/item', array('item' => $item));
			}
			echo $celebrations_monthly;
		?>
	</div>
</div>
