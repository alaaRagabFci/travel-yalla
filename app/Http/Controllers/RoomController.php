<?php

namespace App\Http\Controllers;

use App\Services\RoomService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    protected $roomService;

    /**
     * Room controller constructor
     * @param RoomService $roomService
     */
    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return $this->roomService->listRooms();
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

        $validation = Validator::make($parameters, [
            'name'=>'required|unique:rooms',
            'room_type_id'=>'required',
            'hotel_id'=>'required',
            'image'=>'required',
        ]);

        if($validation->fails())
            return new Response($validation->errors(), 400);

        return $this->roomService->createRoom($parameters);
    }

    /**
     * Get Room details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function show($id): Response
    {
        return $this->roomService->getRoomDetails($id);
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

        $validation = Validator::make($parameters, [
            'name'=>'required|unique:rooms,name,'.$id,
            'room_type_id'=>'required',
            'hotel_id'=>'required',
            'image'=>'required',
        ]);

        if($validation->fails())
            return new Response($validation->errors(), 400);

        return $this->roomService->updateRoomDetails($id, $parameters);
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
        return $this->roomService->deleteRoom($id);
    }
}
