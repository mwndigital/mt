<?php

namespace Database\Seeders;

use App\Models\PolicyPages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolicyPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tcsMainContent = <<<EOT
<p>The following terms and conditions apply to all bookings made at this property whether via our online website reservation system, by email, by phone or by any other means.&nbsp; By proceeding with a booking, you are choosing to accept the terms and conditions of that booking which are as follows:</p>
<ol>
<li>All bookings made at this property are accepted as a contract between ourselves (The Mash Tun) and the booking party, whether the individual themselves or the person that has booked accommodation on behalf of an individual.&nbsp; As such, once the hotel has confirmed, in writing, the details of the reservation this should be accepted as legally binding up until the contract is broken by agreement of both parties.</li>
<li>At the point of reservation, regardless of which booking means is used, we will ask for credit card details (long number, expiry, CVC) which should remain valid through until the point of departure.&nbsp; These details will be held in a secure file on our premises in order to operate a 72-hour cancellation policy.&nbsp; If a room(s) is canceled within the 72-hour period prior to arrival, the first night's accommodation will be charged to these card details.&nbsp; No deposit will be taken at the point of reservation nor will pre-payment be processed unless expressly requested by the guest(s) themselves.&nbsp; In circumstances of a no-show, the total value of the booking will be charged.&nbsp; No charge will be incurred for cancellations made prior to the 72-hour period.</li>
<li>We operate dynamic pricing which means our room pricing may change on demand.&nbsp; When a reservation request is made, the pricing provided for the total stay is true at the point of booking and will remain true through until your departure.&nbsp; Pricing quoted at the point of reservation is per room, per night and is inclusive of breakfast and VAT (the current rate at the time of writing is 20%).&nbsp; Any changes to the VAT will be taken into account in your final total unless you have paid your accommodation in full prior to your arrival.&nbsp; Any other meals are not included in quoted prices and are dealt with separately at both the point of reserving your room and at the point of payment.</li>
<li>We offer rates both for single occupancy and double occupancy in our Deluxe, Club, Executive Club, and Junior Suite rooms.&nbsp; Occupancy will therefore be determined by the rate that is chosen at the point of reservation.&nbsp; If this is exceeded at the point of arrival, the full rate will be charged as applicable at the time of check-in.&nbsp; We have one extra bed that can be placed in some of our rooms, space dependent, which is charged at &pound;35 for children under 12 per night and at &pound;40 for adults over 12 per night.&nbsp; A cot for those under 3 can also be provided at the cost of &pound;15 per night.&nbsp; These extras must be organised at the point of reservation and are only guaranteed if organised at that time.</li>
<li>Check-in (officially) starts at 2 pm on the day of arrival.&nbsp; Earlier access is sometimes possible however, this can only be allowed by the hotel and will not be guaranteed under any circumstances.&nbsp; Our last (official) check-in time is 9pm therefore if your arrival time will be after this point, it is essential that you inform the hotel in order for us to provide you with a self-check-in procedure.&nbsp; This includes a 4-digit code which is only able to be provided by the hotel.&nbsp; Check-out time is 11 am on the day of departure.&nbsp; Late check-outs are not available although luggage may be kept in our locked cloakroom until your departure from the area.</li>
<li>We are a strictly no-smoking hotel in accordance with the law in Scotland.&nbsp; If this law is not adhered to during your stay and we have sufficient evidence to suggest that smoking has taken place in any of our rooms or public areas, the hotel reserves the right to charge a fine of &pound;250.&nbsp; We have a specially built 'Smoking Bothy' which offers the only smoking zone on hotel grounds.</li>
<li>We have a no pets policy within the hotel's public areas and rooms, with the exception of assistance dogs.&nbsp; Pets can have access to the Glenfiddich Terrace and the rest of the grounds as long as owners remain respectful of our other guests.&nbsp; It is the responsibility of the pet owners to pick up after them - refuse bags are available on request.</li>
<li>We have an accessibility toilet as part of our larger toilet suite; however, we do not guarantee any further disabled access within the hotel's public areas or rooms (all rooms are at least one set of stairs above the main reception area).&nbsp; Any accessibility issues must be dictated to the hotel at the point of reservation, however, due to the age and layout of the hotel we are unable to deal with any severe mobility issues.</li>
<li>Any damage to or loss of hotel property that is caused by you or members of your party, including to our other guests and their belongings, will incur a charge required to make good or remedy such damage or loss.</li>
<li>The Mash Tun Staff have the right to work in a safe and healthy environment whereby they are not threatened with or on the receiving end of verbal or physical abuse from guests.&nbsp; In circumstances where this is violated, we reserve the right to immediately eject you and other members of your party from the premises.&nbsp; All charges incurred up until the point of ejection will be taken from the card provided at the point of reservation.</li>
</ol>

EOT;


        PolicyPages::create([
            'title' => 'Deposit & Cancellations Policy',
            'slug' => 'deposit-cancellations-policy',
            'main_content' => "<p>A deposit of &pound;50 per room is required at the time of booking.&nbsp; Should your length of stay be more than 2 nights, a larger sum may be required as a deposit.&nbsp; This deposit is non-refunable.</p>
<p>If you cancel your booking within 14 days of arrival, you may be liable for the full cost of the reservation.&nbsp; However, should any part of your room(s) be re-let we shall be pleased to refund that applicable portions of the cancellation charges.&nbsp; You can insure against cancellations for reasons beyond your control.</p>"
        ]);
        PolicyPages::create([
           'title' => "Terms & Conditions",
           'slug' => 'terms-conditions',
            'main_content' => $tcsMainContent,
        ]);
    }
}
