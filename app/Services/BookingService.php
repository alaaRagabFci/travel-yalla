<?php
/**
 * Created by PhpStorm.
 * User: alaa
 * Date: 17/07/20
 * Time: 11:28 ص
 */

namespace App\Services;


use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Response;

class BookingService
{
    /**
     * List bookings.
     *
     * @return array
     * @author alaa <alaaragab34@gmail.com>
     */
    public function listBookings(): Response
    {
        $bookings = Booking::with('user', 'room')->get(['id','user_id', 'room_id', 'start_date', 'end_date', 'fullname', 'email', 'phone']);

        return new Response(json_encode(array('status' => true, 'bookings' => $bookings)), 200);
    }

    /**
     * Get booking details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function getBookingDetails(int $bookingId): Response
    {
        $booking = Booking::with('user', 'room')->find($bookingId);

        if(!$booking)
            return new Response(json_encode(array('code' => '403', 'message' => 'No booking found with this id')), 403);

        return new Response(json_encode(array('status' => true, 'booking' => $booking)), 200);
    }

    /**
     * create booking.
     *
     * @param  array  $parameters
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function createBooking(array $parameters): Response
    {
        $diff = abs(strtotime($parameters['start_date']) - strtotime($parameters['end_date']));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $parameters['duration'] = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $room = Room::with('roomType.price')->find($parameters['room_id']);

        $parameters['amount'] = $parameters['duration'] *  $room->roomType->price->price;

        $booking = Booking::create($parameters);

        return new Response(json_encode(array('status' => true, 'booking' => $booking)), 201);

    }

    /**
     * Update booking details.
     *
     * @param  int  $id
     * @param  array  $parameters
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function updateBookingDetails(int $bookingId, array $parameters): Response
    {
        $booking = Booking::with('room.roomType.price')->find($bookingId);

        if(!$booking)
            return new Response(json_encode(array('code' => '403', 'message' => 'No booking found with this id')), 403);

        $diff = abs(strtotime($parameters['start_date']) - strtotime($parameters['end_date']));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $parameters['duration'] = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $parameters['amount'] = $parameters['duration'] *  $booking->room->roomType->price->price;

        $booking->update($parameters);
        return new Response(json_encode(array('status' => true, 'booking' => $booking)), 200);
    }

    /**
     * Delete booking.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function deleteBooking(int $bookingId): Response
    {
        $booking = Booking::find($bookingId);

        if(!$booking)
            return new Response(json_encode(array('code' => '403', 'message' => 'No booking found with this id')), 403);

        $booking->delete();

        return new Response(json_encode(array('status' => true, 'message' => 'Booing deleted')), 204);

    }
}