<?php

namespace Takeoffset\ApiBundle\Client;

use Guzzle\Plugin\History\HistoryPlugin;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;

/**
 * Middleware between the BookingEngine and the data model
 * Communicate with the API hosted on a Phoenix instance running on a local or distant server.
 */
interface PhoenixClientInterface
{
    /**
     * Create new Prodigy Rest client.
     * service definition 'prodigy_rest_client' which defines default connection details.
     *
     * @param string        $host      Hostname of the server hosting the Phoenix instance
     * @param string        $port      Port number to listen to on the server
     * @param string        $site      Site code (url fragment, e.g. CTWEB)
     * @param string        $interface Interface code (url fragment, e.g. FLGHTCNTR)
     * @param string        $basePath  Url path to Phoenix
     * @param bool          $authority Whether to use ssl certificate or not
     * @param Logger        $logger    Monolog log channel
     * @param AppState      $appState  BookingEngine AppState service - used by local client
     * @param HistoryPlugin $profiler  Playbloom Guzzle profiler subscriber
     */
    public function __construct($host, $port, $site, $interface, $basePath, $authority, Logger $logger, AppState $appState, HistoryPlugin $profiler);

    /**
     * Find flights for given search options.
     *
     * @param Search $search
     *
     * @return array
     */
    public function getFlights(Search $search);

    /**
     * Find hotels for given search options.
     *
     * @param HotelSearch $hotelSearch
     *
     * @return array
     */
    public function getHotels(HotelSearch $hotelSearch);

    /**
     * Retrieve an insurance offer for the given search options
     * Phoenix URL: /insurance.
     *
     * @param InsuranceSearch $insuranceSearch
     *
     * @return array
     */
    public function getInsurance(InsuranceSearch $insuranceSearch);

    /**
     * Make a flights reservation for the given trips and passengers.
     *
     * @param string     $bookingId  The bookingId to reserve the flights against
     * @param array      $payload    Payload for the request
     *
     * @return array
     */
    public function getFlightReservation($bookingId, $payload);

    /**
     * Make a hotel reservation for the given Hotel and Passengers.
     *
     * @param string        $bookingId     The bookingId to reserve the flights against
     * @param SelectedHotel $selectedHotel The selected hotel to be reserved
     * @param Passengers    $passengers    Passengers entity
     *
     * @return array
     */
    public function getHotelReservation($bookingId, SelectedHotel $selectedHotel, Passengers $passengers);

    /**
     * Make an insurance reservation for the given Insurance and Passengers.
     *
     * @param string     $bookingId  The bookingId to reserve the flights against
     * @param Insurance  $insurance  The insurance offer the customer has agreed to
     * @param Passengers $passengers Passengers entity
     *
     * @return array
     */
    public function getInsuranceReservation($bookingId, Insurance $insurance, Passengers $passengers);

    /**
     * Send a getReservationsBreakdown request and handle errors.
     *
     * @param Booking $bookingId The bookingId to fetch breakdowns for
     *
     * @return JsonResponse|Response
     */
    public function getReservationsBreakdown($bookingId);

    /**
     * Finalise the booking.
     *
     * @param string                 $emailAddress
     * @param Booking                $booking
     * @param array                  $fraudDetectionContext
     * @param array                  $paymentMethods
     * @param array                  $companyDetails
     * @param string                 $threeDSecurePaRes
     *
     * @return array
     */
    public function getFinaliseBooking($emailAddress, Booking $booking, $fraudDetectionContext, $paymentMethods, $companyDetails, $threeDSecurePaRes = null);

    /**
     * Get itinerary pdf hex content.
     *
     * @param Booking $booking
     *
     * @return array
     */
    public function getItinerary(Booking $booking);

    /**
     * Get baggage option for a given flight
     * See http://localhost:9080/phoenix/CTWEB/FLGHTCNTR/baggageOption?flightContext=VA:401:20130725:ADL:SYD:0600:0825:Y^VA:931:20130725:SYD:BNE:1000:1130:N|1:0:0&airlineCode=VA¤cy=AUD&fareKey=Key:0:Adult@ADULT:S:SZDA,1:Adult@ADULT:S:SZDA&reservationSystem=GLL.
     *
     * @param string $flightContext
     * @param string $currency
     * @param string $fareKey
     * @param string $reservationSystem
     *
     * @return array
     */
    public function getBaggageOption($flightContext, $currency, $fareKey, $reservationSystem);

    /**
     * Get airports list.
     *
     * @return array
     */
    public function getAirports();

    /**
     * Get fareRules for a flight.
     *
     * @return array
     */
    public function getFareRule($fareRuleKey, $reservationSystem);

    /**
     * Get fees for a flight.
     *
     * @param Search $search
     * @param string $paymentType
     *
     * @return array
     */
    public function getFees(Search $search, $paymentType);

    /**
     * Requesting paypal.
     *
     * @param string $returnUrl
     * @param string $cancelUrl
     * @param float  $amount
     * @param string $currency
     *
     * @return array
     */
    public function getPaypal($returnUrl, $cancelUrl, $amount, $currency);

    /**
     * Notify Phoenix that the customer has declined the insurance offer.
     *
     * @param string $token
     */
    public function getInsuranceDecline($token);

    /**
     * Add a consultant to the customer's booking.
     *
     * @param string     $bookingId  The bookingId to add the consultant to
     * @param Consultant $consultant The consultant to be added to the booking
     */
    public function getReferConsultant($bookingId, Consultant $consultant);

    /**
     * Get seat map mapping for a given flight
     *
     * @param integer $legIndex
     * @param integer $journeyIndex
     * @param string $flightContext
     * @param string $fareKey
     * @param string $reservationSystem
     * @param string $currency
     *
     * @return array
     */
    public function getSeats($legIndex, $journeyIndex, $flightContext, $fareKey, $reservationSystem, $currency);
}
