import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";
import Calendar from "./Calendar";

function BookingForm() {
    const urlParams = new URLSearchParams(window.location.search);
    const type = urlParams.get("type") || "room";
    const [roomType, setRoomType] = useState(type);
    const [children, setChildren] = useState(0);
    const [adults, setAdults] = useState(1);
    const [unavailableDates, setUnavailableDates] = useState([]);

    const handleType = (e) => setRoomType(e.target.value);

    const getUnavailableDates = async () =>
        fetch(`/api/available?type=${roomType}`).then((res) => res.json());

    // if room type adults and children change, fetch unavailable dates

    useEffect(() => {
        getUnavailableDates().then((res) => {
            if (res.error) return;
            setUnavailableDates(res.unavailable_dates);
        });
    }, [roomType, adults, children]);

    return (
        <>
            <div className="row">
                <div className="col-md-6">
                    <Calendar
                        roomType={roomType}
                        minimumNights={roomType === "room" ? 1 : 2}
                        unavailableDates={unavailableDates}
                    />
                </div>
                <div className="col-md-6">
                    <label htmlFor="">Type</label>
                    <select name="type" id="type" onChange={handleType}>
                        <option value="room" selected={roomType === "room"}>
                            Room
                        </option>
                        <option value="lodge" selected={roomType === "lodge"}>
                            Lodge
                        </option>
                    </select>
                    {roomType === "lodge" && (
                        <em>Minimum stay of 2 nights required.</em>
                    )}
                </div>
                <div className="col-md-4 d-none">
                    <label htmlFor="">Arrival Time</label>
                    <input
                        type="text"
                        name="arrival_time"
                        id="arrival_time"
                        value="14:00"
                    />
                </div>
            </div>
            <div className="row">
                <div className="col-md-6">
                    <label htmlFor="">Number of adults</label>
                    <input
                        min="1"
                        type="number"
                        name="no_of_adults"
                        id="no_of_adults"
                        value={adults}
                        onChange={(e) => setAdults(e.target.value)}
                    />
                </div>
                <div className="col-md-6">
                    <label htmlFor="">Number of children</label>
                    <input
                        type="number"
                        name="no_of_children"
                        id="no_of_children"
                        value={children}
                        onChange={(e) => setChildren(e.target.value)}
                    />
                </div>
            </div>

            <div className="row mt-4">
                <div className="col-12 d-flex justify-content-end">
                    <button type="submit" className="nextBtn">
                        Next <i className="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            <input type="hidden" name="checkin_date" id="checkin_date" />
            <input type="hidden" name="checkout_date" id="checkout_date" />
        </>
    );
}

export default BookingForm;

if (document.getElementById("booking-form")) {
    createRoot(document.getElementById("booking-form")).render(<BookingForm />);
}
