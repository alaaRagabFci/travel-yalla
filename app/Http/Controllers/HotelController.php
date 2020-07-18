<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\HotelService;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    protected $hotelService;

    /**
     * Hotel controller constructor
     * @param HotelService $hotelService
     */
    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    /**
     * Get hotel details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function getHotelDetails(int $id): Response
    {
        return $this->hotelService->getHotelDetails($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function updateHotelDetails(int $id): Response
    {
        $parameters = json_decode(request()->getContent(), true);

        $validation = Validator::make($parameters, [
            'name'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
            'zip_code'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'image'=>'required',
        ]);

        if($validation->fails())
            return new Response($validation->errors(), 400);

        return $this->hotelService->updateHotelDetails($id, $parameters);
    }
}
