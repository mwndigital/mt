import React, { useState, useEffect } from "react";
import "react-dates/initialize"; // Required for react-dates to work properly
import "react-dates/lib/css/_datepicker.css";
import { DateRangePicker } from "react-dates";
import { createRoot } from "react-dom/client";
import moment from "moment";

function Calendar({
    roomType,
    minimumNights,
    unavailableDates,
    fullAvailability,
}) {
    const [startDate, setStartDate] = useState(null);
    const [endDate, setEndDate] = useState(null);
    const [focusedInput, setFocusedInput] = useState(null); // Add this line

    const isMobile = window.innerWidth <= 768;

    const handleDatesChange = ({ startDate, endDate }) => {
        setStartDate(startDate);
        setEndDate(endDate);
        // set format d-m-Y with moment
        document.getElementById("checkin_date").value =
            moment(startDate).format("DD-MM-YYYY");
        document.getElementById("checkout_date").value =
            moment(endDate).format("DD-MM-YYYY");
    };

    const totalNight = endDate && startDate && endDate.diff(startDate, "days");

    const isDayBlocked = (day) => {
        return unavailableDates.some(
            (date) => date === day.format("YYYY-MM-DD")
        );
    };

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
                isDayBlocked={isDayBlocked} // Mark unavailable dates
                minimumNights={minimumNights}
                displayFormat="DD/MM/YYYY"
                // withFullScreenPortal={true}
                // orientation={"vertical"}
                withPortal={true}
                numberOfMonths={isMobile ? 1 : 2}
                showClearDates={true}
                noBorder={true}
                autoFocus={true}
                disabled={!fullAvailability}
            />
        </>
    );
}

export default Calendar;

if (document.getElementById("calendar")) {
    createRoot(document.getElementById("calendar")).render(<Calendar />);
}
