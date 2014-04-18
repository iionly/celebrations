<?php

/**
 * Elgg Celebrations Plugin date input
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
	$class = "input-date";
}

$birthdate = $vars['value'];
$ybdate = (int)gmdate('Y', $birthdate);
$mbdate = (int)gmdate('m', $birthdate);
$dbdate = (int)gmdate('d', $birthdate);

?>

<script language="JavaScript">

//function for returning how many days there are in a month including leap years
function DaysInMonth<?php echo $vars['name']; ?>(WhichMonth, WhichYear)
{
	var DaysInMonth = 31;
	if (WhichMonth == 4 || WhichMonth == 6 || WhichMonth == 9 || WhichMonth == 11) DaysInMonth = 30;
	if (WhichMonth == 2 && (WhichYear/4) != Math.floor(WhichYear/4)) DaysInMonth = 28;
	if (WhichMonth == 2 && (WhichYear/4) == Math.floor(WhichYear/4)) DaysInMonth = 29;
	return DaysInMonth;
}

//function to change the available days in a months
function ChangeOptionDays<?php echo $vars['name']; ?>(resultid) {

	DaysObject = document.getElementById('dayid_<?php echo $vars['name']; ?>');
	MonthObject = document.getElementById('monthid_<?php echo $vars['name']; ?>');
	YearObject = document.getElementById('yearid_<?php echo $vars['name']; ?>');

	Day = DaysObject.value;
	Month = MonthObject.value;
	Year = YearObject.value;

	DaysForThisSelection = DaysInMonth<?php echo $vars['name']; ?>(Month, Year);
	CurrentDaysInSelection = DaysObject.length;

	if (CurrentDaysInSelection > DaysForThisSelection) {
		for (i=0; i<(CurrentDaysInSelection-DaysForThisSelection); i++) {
			DaysObject.options[DaysObject.options.length - 1] = null;
		}
	}
	if (DaysForThisSelection > CurrentDaysInSelection) {
		for (i=0; i<(DaysForThisSelection-CurrentDaysInSelection); i++) {
			NewOption = new Option(DaysObject.options.length +1);
			DaysObject.options.add(NewOption);
		}
	}
	if (DaysObject.selectedIndex < 0) DaysObject.selectedIndex == 0;

	if (Day > 0 && Month > 0 && Year > 0) {
		setDate<?php echo $vars['name']; ?>(resultid,Day,Month,Year);
	}
}

//Function to calculate the timestamp
function humanToTime<?php echo $vars['name']; ?>(Day,Month,Year) {

	DaysObject = document.getElementById('dayid_<?php echo $vars['name']; ?>');
	MonthObject = document.getElementById('monthid_<?php echo $vars['name']; ?>');
	YearObject = document.getElementById('yearid_<?php echo $vars['name']; ?>');

	Day = DaysObject.value;
	Month = MonthObject.value;
	Year = YearObject.value;

	var humDate = new Date(Date.UTC(Year,
		(stripLeadingZeroes(Month)-1),
		stripLeadingZeroes(Day),
		stripLeadingZeroes(0),
		stripLeadingZeroes(0),
		stripLeadingZeroes(0)));

	return (humDate.getTime()/1000.0);
}

//Function to save the date
function setDate<?php echo $vars['name']; ?>(resultid,Day,Month,Year) {

	resultObj = document.getElementById(resultid);

	datetime = humanToTime<?php echo $vars['name']; ?>(Day,Month,Year);
	resultObj.value = datetime;
}

function stripLeadingZeroes(input) {

	if((input.length > 1) && (input.substr(0,1) == "0"))
		return input.substr(1);
	else
		return input;
}

</script>

<input type="hidden" name="<?php echo $vars['name']; ?>" id="<?php echo $vars['name']; ?>id" value="<?php echo (int)$vars['value']; ?>"/>
<p>
<select <?php if ($vars['disabled']) echo ' disabled="yes" '; ?> name="FirstSelectDay_<?php echo $vars['name']; ?>" id="dayid_<?php echo $vars['name']; ?>" class="<?php echo $class ?>" onchange="ChangeOptionDays<?php echo $vars['name']; ?>('<?php echo $vars['name']; ?>id')"/>
	<?php

		$daycount = 1;

		while ($daycount < 32) {
			echo '<option value="' . $daycount . '"';
			if ($daycount == $dbdate) {
				echo ' selected="selected"';
			}

			echo '>' . $daycount . '</option>' . chr(10);
			$daycount = $daycount +1;
		}
	?>
</select>

<select <?php if ($vars['disabled']) echo ' disabled="yes" '; ?> name="FirstSelectMonth_<?php echo $vars['name']; ?>" id="monthid_<?php echo $vars['name']; ?>" class="<?php echo $class ?>" onchange="ChangeOptionDays<?php echo $vars['name']; ?>('<?php echo $vars['name']; ?>id')"/>
	<?php
		$monthcount = 1;

		while ($monthcount < 13) {
			echo '<option value="' . $monthcount . '"';
			if ($monthcount == $mbdate) {
				echo ' selected="selected"';
			}

			echo '>' . elgg_echo("celebrations:month:{$monthcount}") . '</option>' . chr(10);
			$monthcount = $monthcount +1;
		}
	?>
</select>

<select <?php if ($vars['disabled']) echo ' disabled="yes" '; ?> name="FirstSelectYear_<?php echo $vars['name']; ?>" id="yearid_<?php echo $vars['name']; ?>" class="<?php echo $class ?>" onchange="ChangeOptionDays<?php echo $vars['name']; ?>('<?php echo $vars['name']; ?>id')"/>
	<?php
		$year = (int)gmdate('Y');
		$yearcount = $year;
		$yearend = $year - 99;

		while ($yearcount > $yearend) {
			echo '<option value="' . $yearcount . '"';
			if ($yearcount == $ybdate) {
				echo ' selected="selected"';
			}

			echo '>' . $yearcount . '</option>' . chr(10);
			$yearcount = $yearcount -1;
		}
	?>
</select>
</p>
