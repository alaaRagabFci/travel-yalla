<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    protected $bookingService;

    /**
     * Booking controller constructor
     * @param BookingService $bookingService
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return $this->bookingService->listBookings();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(): Response
    {
        $parameters = json_decode(request()->getContent(), true);

        return $this->bookingService->createBooking($parameters);
    }

    /**
     * Get booking details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function show($id): Response
    {
        return $this->bookingService->getBookingDetails($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function update($id)
    {
        $parameters = json_decode(request()->getContent(), true);

        return $this->bookingService->updateBookingDetails($id, $parameters);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function destroy($id): Response
    {
        return $this->bookingService->deleteBooking($id);
    }
}
