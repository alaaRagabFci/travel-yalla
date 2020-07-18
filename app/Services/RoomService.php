<?php
/**
 * Created by PhpStorm.
 * User: alaa
 * Date: 17/07/20
 * Time: 11:28 ص
 */

namespace App\Services;


use App\Models\Room;
use Illuminate\Http\Response;

class RoomService
{
    /**
     * List rooms.
     *
     * @return array
     * @author alaa <alaaragab34@gmail.com>
     */
    public function listRooms(): Response
    {
        $rooms = Room::with('roomType', 'hotel')->get(['id','name', "image", 'hotel_id', 'room_type_id']);

        return new Response(json_encode(array('status' => true, 'rooms' => $rooms)), 200);
    }

    /**
     * Get room details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function getRoomDetails(int $roomId): Response
    {
        $room = Room::with('roomType', 'hotel')->find($roomId);

        if(!$room)
            return new Response(json_encode(array('code' => '403', 'message' => 'No room found with this id')), 403);

        return new Response(json_encode(array('status' => true, 'room' => $room)), 200);
    }

    /**
     * create room.
     *
     * @param  array  $parameters
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function createRoom(array $parameters): Response
    {
         $room = Room::create($parameters);

        return new Response(json_encode(array('status' => true, 'room' => $room)), 201);

    }

    /**
     * Update room details.
     *
     * @param  int  $id
     * @param  array  $parameters
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function updateRoomDetails(int $roomId, array $parameters): Response
    {
        $room = Room::find($roomId);

        if(!$room)
            return new Response(json_encode(array('code' => '403', 'message' => 'No room found with this id')), 403);

        $room->update($parameters);
        return new Response(json_encode(array('status' => true, 'room' => $room)), 200);
    }

    /**
     * Delete room.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function deleteRoom(int $roomId): Response
    {
        $room = Room::find($roomId);

        if(!$room)
            return new Response(json_encode(array('code' => '403', 'message' => 'No room found with this id')), 403);

        $room->delete();

        return new Response(json_encode(array('status' => true, 'message' => 'Room deleted')), 204);

    }
}