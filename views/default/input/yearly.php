<?php

/**
 * Elgg Celebrations Plugin partial date input
 * Displays a date selection
 * Adapted from plugin "profile age and gender"
 * @package celebrations
 * @subpackage input field
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Fernando Graells
 * @copyright Fernando Graells 2009-2014
 * @link
 *
 * for Elgg 1.8+1.9 by iionly
 * @copyright iionly 2012-2014
 * iionly@gmx.de
 *
 * @uses $vars['value'] The current value, if any
 * @uses $vars['name'] The name of the input field
 * @uses $vars['disabled'] If true then control is read-only
 * @uses $vars['class'] Class override
 */


$class = $vars['class'];
if (!$class) {
	$class = "input-feast";
}

$feastdate = $vars['value'];
$feast = explode('-', $feastdate);

$mbdate2 = $feast[1]; //date("m", $feastdate);
$dbdate2 = $feast[0]; //date("d", $feastdate);

?>

<script language="JavaScript">

//function for returning how many days there are in a month not considering leap years
function DaysInMonthPartial<?php echo $vars['name']; ?>(WhichMonth)
{
	var DaysInMonth = 31;
	if (WhichMonth == 4 || WhichMonth == 6 || WhichMonth == 9 || WhichMonth == 11) DaysInMonth = 30;
	if (WhichMonth == 2) DaysInMonth = 29;
	return DaysInMonth;
}

//function to change the available days in a months
function ChangeOptionDays2(resultid2) {

	DaysObject2 = document.getElementById('dayid2');
	MonthObject2 = document.getElementById('monthid2');

	Day2 = DaysObject2.value;
	Month2 = MonthObject2.value;

	DaysForThisSelection = DaysInMonthPartial<?php echo $vars['name']; ?>(Month2);
	CurrentDaysInSelection = DaysObject2.length;

	if (CurrentDaysInSelection > DaysForThisSelection) {
		for (i=0; i<(CurrentDaysInSelection-DaysForThisSelection); i++) {
			DaysObject2.options[DaysObject2.options.length - 1] = null;
		}
	}
	if (DaysForThisSelection > CurrentDaysInSelection) {
		for (i=0; i<(DaysForThisSelection-CurrentDaysInSelection); i++) {
			NewOption = new Option(DaysObject2.options.length +1);
			DaysObject2.options.add(NewOption);
		}
	}
	if (DaysObject2.selectedIndex < 0) DaysObject2.selectedIndex == 0;

	if (Day2 > 0 && Month2 > 0) {
		setFeast(resultid2,Day2,Month2);
	}
}

//Function to save the date
function setFeast(resultid2,Day2,Month2) {

	resultObj2 = document.getElementById(resultid2);
	resultfeast = Day2+'-'+Month2;
	resultObj2.value = resultfeast;
}

</script>
<input type="hidden" name="<?php echo $vars['name']; ?>" id="<?php echo $vars['name']; ?>id" value="<?php echo $vars['value']; ?>"/>
<p>
<select <?php if ($vars['disabled']) echo ' disabled="yes" '; ?> name="FirstSelectDay2" id="dayid2" class="<?php echo $class ?>" onchange="ChangeOptionDays2('<?php echo $vars['name']; ?>id')" >
	<?php
		$daycount2 = 1;

		while ($daycount2 < 32) {
			echo '<option value="' . $daycount2 . '"';
			if ($daycount2 == $dbdate2) {
				echo ' selected="selected"';
			}

			echo '>' . $daycount2 . '</option>' . chr(10);
			$daycount2 = $daycount2 +1;
		}
	?>
</select>

<select <?php if ($vars['disabled']) echo ' disabled="yes" '; ?> name="FirstSelectMonth2" id="monthid2" class="<?php echo $class ?>" onchange="ChangeOptionDays2('<?php echo $vars['name']; ?>id')" >
	<?php
		$monthcount2 = 1;

		while ($monthcount2 < 13) {
			echo '<option value="' . $monthcount2 . '"';
			if ($monthcount2 == $mbdate2) {
				echo ' selected="selected"';
			}

			echo '>' . elgg_echo("celebrations:month:{$monthcount2}") . '</option>' . chr(10);
			$monthcount2 = $monthcount2 +1;
		}
	?>
</select>
</p>
