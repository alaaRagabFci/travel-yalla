<?php
/**
 * Created by PhpStorm.
 * User: alaa
 * Date: 17/07/20
 * Time: 11:28 ص
 */

namespace App\Services;


use App\Models\RoomType;
use Illuminate\Http\Response;

class RoomTypeService
{
    /**
     * List room types.
     *
     * @return array
     * @author alaa <alaaragab34@gmail.com>
     */
    public function listRoomTypes(): Response
    {
        $roomTypes = RoomType::get(['id','name']);

        return new Response(json_encode(array('status' => true, 'roomTypes' => $roomTypes)), 200);
    }

    /**
     * Get room type details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function getRoomTypeDetails(int $roomId): Response
    {
        $roomType = RoomType::find($roomId);

        if(!$roomType)
            return new Response(json_encode(array('code' => '403', 'message' => 'No room type found with this id')), 403);

        return new Response(json_encode(array('status' => true, 'roomType' => $roomType)), 200);
    }

    /**
     * create room type.
     *
     * @param  array  $parameters
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function createRoomType(array $parameters): Response
    {
        $roomType = RoomType::create($parameters);

        return new Response(json_encode(array('status' => true, 'roomType' => $roomType)), 201);

    }

    /**
     * Update room type details.
     *
     * @param  int  $id
     * @param  array  $parameters
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function updateRoomTypeDetails(int $roomId, array $parameters): Response
    {
        $roomType = RoomType::find($roomId);

        if(!$roomType)
            return new Response(json_encode(array('code' => '403', 'message' => 'No room type found with this id')), 403);

        $roomType->update($parameters);
        return new Response(json_encode(array('status' => true, 'roomType' => $roomType)), 200);
    }

    /**
     * Delete room type.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function deleteRoomType(int $roomId): Response
    {
        $roomType = RoomType::find($roomId);

        if(!$roomType)
            return new Response(json_encode(array('code' => '403', 'message' => 'No room type found with this id')), 403);

        $roomType->delete();

        return new Response(json_encode(array('status' => true, 'message' => 'Room deleted')), 204);

    }
}