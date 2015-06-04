define(function(require) {
	var elgg = require("elgg");
	var $ = require("jquery");

	//function for returning how many days there are in a month including leap years
	function DaysInMonth(WhichMonth, WhichYear) {
		var DaysInMonth = 31;
		if (WhichMonth == 4 || WhichMonth == 6 || WhichMonth == 9 || WhichMonth == 11) {
			DaysInMonth = 30;
		}
		if (WhichMonth == 2 && (WhichYear/4) != Math.floor(WhichYear/4)) {
			DaysInMonth = 28;
		}
		if (WhichMonth == 2 && (WhichYear/4) == Math.floor(WhichYear/4)) {
			DaysInMonth = 29;
		}
		return DaysInMonth;
	}

	//function to change the available days in a months
	function ChangeOptionDays(resultid) {

		DaysObject = document.getElementById('dayid_' + resultid);
		MonthObject = document.getElementById('monthid_' + resultid);
		YearObject = document.getElementById('yearid_' + resultid);

		Day = DaysObject.value;
		Month = MonthObject.value;
		Year = YearObject.value;

		DaysForThisSelection = DaysInMonth(Month, Year);
		CurrentDaysInSelection = DaysObject.length;

		if (CurrentDaysInSelection > DaysForThisSelection) {
			for (i = 0; i < (CurrentDaysInSelection - DaysForThisSelection); i++) {
				DaysObject.options[DaysObject.options.length - 1] = null;
			}
		}
		if (DaysForThisSelection > CurrentDaysInSelection) {
			for (i = 0; i < (DaysForThisSelection - CurrentDaysInSelection); i++) {
				NewOption = new Option(DaysObject.options.length + 1);
				DaysObject.options.add(NewOption);
			}
		}
		if (DaysObject.selectedIndex < 0) {
			DaysObject.selectedIndex == 0;
		}

		if (Day > 0 && Month > 0 && Year > 0) {
			setDate(resultid, Day, Month, Year);
		}
	}

	//Function to calculate the timestamp
	function humanToTime(resultid, Day, Month, Year) {
		DaysObject = document.getElementById('dayid_' + resultid);
		MonthObject = document.getElementById('monthid_' + resultid);
		YearObject = document.getElementById('yearid_' + resultid);

		Day = DaysObject.value;
		Month = MonthObject.value;
		Year = YearObject.value;

		var humDate = new Date(Date.UTC(Year,
			(stripLeadingZeroes(Month) - 1),
			stripLeadingZeroes(Day),
			stripLeadingZeroes(0),
			stripLeadingZeroes(0),
			stripLeadingZeroes(0)));

		return (humDate.getTime() / 1000.0);
	}

	//Function to save the date
	function setDate(resultid, Day, Month, Year) {
		resultObj = document.getElementById(resultid + 'id');

		datetime = humanToTime(resultid, Day, Month, Year);
		resultObj.value = datetime;
	}

	function stripLeadingZeroes(input) {
		if((input.length > 1) && (input.substr(0, 1) == "0")) {
			return input.substr(1);
		} else {
			return input;
		}
	}

	$(".celebrations-input-date").change(function() {
		var fieldname = $(this).data('fieldname');
		ChangeOptionDays(fieldname);
	});
});