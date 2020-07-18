<?php

namespace App\Http\Controllers;

use App\Services\PriceService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PriceController extends Controller
{
    protected $priceService;

    /**
     * Price controller constructor
     * @param PriceService $priceService
     */
    public function __construct(PriceService $priceService)
    {
        $this->priceService = $priceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return $this->priceService->listPrices();
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
            'price'=>'required',
            'room_type_id'=>'required',
        ]);

        if($validation->fails())
            return new Response($validation->errors(), 400);

        return $this->priceService->createPrice($parameters);
    }

    /**
     * Get price details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function show($id): Response
    {
        return $this->priceService->getPriceDetails($id);
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
            'price'=>'required',
            'room_type_id'=>'required',
        ]);

        if($validation->fails())
            return new Response($validation->errors(), 400);

        return $this->priceService->updatePriceDetails($id, $parameters);
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
        return $this->priceService->deletePrice($id);
    }
}
