<?php

namespace App\Http\Controllers;

use App\Services\RoomTypeService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RoomTypeController extends Controller
{
    protected $roomTypeService;

    /**
     * Room type controller constructor
     * @param RoomTypeService $roomTypeService
     */
    public function __construct(RoomTypeService $roomTypeService)
    {
        $this->roomTypeService = $roomTypeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return $this->roomTypeService->listRoomTypes();
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
            'name'=>'required|unique:room_types',
        ]);

        if($validation->fails())
            return new Response($validation->errors(), 400);

        return $this->roomTypeService->createRoomType($parameters);
    }

    /**
     * Get room type details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function show($id): Response
    {
        return $this->roomTypeService->getRoomTypeDetails($id);
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
            'name'=>'required|unique:room_types,name,'.$id,
        ]);

        if($validation->fails())
            return new Response($validation->errors(), 400);

        return $this->roomTypeService->updateRoomTypeDetails($id, $parameters);
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
        return $this->roomTypeService->deleteRoomType($id);
    }

}
