import React, { useState, useEffect } from "react";
import "react-dates/initialize"; // Required for react-dates to work properly
import "react-dates/lib/css/_datepicker.css";
import { DateRangePicker } from "react-dates";
import { createRoot } from "react-dom/client";
import moment from "moment";

function Calendar({ roomType, minimumNights }) {
    const [startDate, setStartDate] = useState(null);
    const [endDate, setEndDate] = useState(null);
    const [focusedInput, setFocusedInput] = useState(null); // Add this line

    const isMobile = window.innerWidth <= 768;

    const unavailableDates = [
        {
            startDate: moment().add(2, "days"),
            endDate: moment().add(4, "days"),
        }, // Unavailable from 2 days from today to 4 days from today
        {
            startDate: moment().add(8, "days"),
            endDate: moment().add(10, "days"),
        }, // Unavailable from 8 days from today to 10 days from today
    ];

    const handleDatesChange = ({ startDate, endDate }) => {
        setStartDate(startDate);
        setEndDate(endDate);
        // set format d-m-Y with moment
        document.getElementById("checkin_date").value =
            moment(startDate).format("DD-MM-YYYY");
        document.getElementById("checkout_date").value =
            moment(endDate).format("DD-MM-YYYY");
    };

    const isDayBlocked = (day) => {
        return unavailableDates.some((range) =>
            day.isBetween(range.startDate, range.endDate, null, "[]")
        );
    };

    // Allow today and after to be selected
    const isOutsideRange = (day) => day.isBefore(moment().subtract(1, "days"));

    const totalNight = endDate && startDate && endDate.diff(startDate, "days");

    return (
        <>
            <label>
                Select Date {totalNight && <>({totalNight} nights)</>}
            </label>
            <DateRangePicker
                startDate={startDate}
                endDate={endDate}
                onDatesChange={handleDatesChange}
                focusedInput={focusedInput}
                onFocusChange={(focusedInput) => setFocusedInput(focusedInput)}
                startDateId="startDate"
                endDateId="endDate"
                enableOutsideDays={true}
                // isOutsideRange={isOutsideRange} // Allow selection of any date
                // isDayBlocked={[]} // Mark unavailable dates
                minimumNights={minimumNights}
                displayFormat="DD/MM/YYYY"
                // withFullScreenPortal={true}
                // orientation={"vertical"}
                withPortal={true}
                numberOfMonths={isMobile ? 1 : 2}
                showClearDates={true}
                noBorder={true}
                autoFocus={true}
            />
        </>
    );
}

export default Calendar;

if (document.getElementById("calendar")) {
    createRoot(document.getElementById("calendar")).render(<Calendar />);
}
