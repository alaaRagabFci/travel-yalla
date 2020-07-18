<?php
/**
 * Created by PhpStorm.
 * User: alaa
 * Date: 17/07/20
 * Time: 03:12 ص
 */
namespace App\Services;

use App\Models\Hotel;
use Illuminate\Http\Response;

class HotelService
{
    /**
     * Get hotel details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function getHotelDetails(int $hotelId): Response
    {
        $hotel = Hotel::find($hotelId);

        if(!$hotel)
            return new Response(json_encode(array('code' => '403', 'message' => 'No hotel found with this id')), 403);

        return new Response(json_encode(array('status' => true, 'hotel' => $hotel)), 200);
    }

    /**
     * Update hotel details.
     *
     * @param  int  $id
     * @param  array  $parameters
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function updateHotelDetails(int $hotelId, array $parameters): Response
    {
        $hotel = Hotel::find($hotelId);

        if(!$hotel)
            return new Response(json_encode(array('code' => '403', 'message' => 'No hotel found with this id')), 403);

        $hotel->name = $parameters['name'];
        $hotel->address = $parameters['address'];
        $hotel->city = $parameters['city'];
        $hotel->state = $parameters['state'];
        $hotel->country = $parameters['country'];
        $hotel->zip_code = $parameters['zip_code'];
        $hotel->phone = $parameters['phone'];
        $hotel->email = $parameters['email'];
        $hotel->image = $parameters['image'];
        $hotel->save();

        return new Response(json_encode(array('status' => true, 'hotel' => $hotel)), 200);

    }
}