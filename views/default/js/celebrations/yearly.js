define(function(require) {
	var elgg = require("elgg");
	var $ = require("jquery");

	//function for returning how many days there are in a month not considering leap years
	function DaysInMonthPartial2(WhichMonth) {
		var DaysInMonth = 31;
		if (WhichMonth == 4 || WhichMonth == 6 || WhichMonth == 9 || WhichMonth == 11) {
			DaysInMonth = 30;
		}
		if (WhichMonth == 2) {
			DaysInMonth = 29;
		}
		return DaysInMonth;
	}

	//function to change the available days in a months
	function ChangeOptionDays2(resultid2) {
		DaysObject2 = document.getElementById('dayid2_' + resultid2);
		MonthObject2 = document.getElementById('monthid2_' + resultid2);

		Day2 = DaysObject2.value;
		Month2 = MonthObject2.value;

		DaysForThisSelection = DaysInMonthPartial2(Month2);
		CurrentDaysInSelection = DaysObject2.length;

		if (CurrentDaysInSelection > DaysForThisSelection) {
			for (i = 0; i < (CurrentDaysInSelection - DaysForThisSelection); i++) {
				DaysObject2.options[DaysObject2.options.length - 1] = null;
			}
		}
		if (DaysForThisSelection > CurrentDaysInSelection) {
			for (i = 0; i < (DaysForThisSelection - CurrentDaysInSelection); i++) {
				NewOption = new Option(DaysObject2.options.length + 1);
				DaysObject2.options.add(NewOption);
			}
		}
		if (DaysObject2.selectedIndex < 0) {
			DaysObject2.selectedIndex == 0;
		}

		if (Day2 > 0 && Month2 > 0) {
			setFeast2(resultid2, Day2, Month2);
		}
	}

	//Function to save the date
	function setFeast2(resultid2, Day2, Month2) {
		resultObj2 = document.getElementById(resultid2 + 'id');
		resultfeast = Day2 + '-' + Month2;
		resultObj2.value = resultfeast;
	}

	$(".celebrations-input-feast").change(function() {
		var fieldname = $(this).data('fieldname');
		ChangeOptionDays2(fieldname);
	});
});
