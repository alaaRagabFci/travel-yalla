<?php
/**
 * Created by PhpStorm.
 * User: alaa
 * Date: 17/07/20
 * Time: 11:28 ص
 */

namespace App\Services;


use App\Models\Price;
use Illuminate\Http\Response;

class PriceService
{
    /**
     * List prices.
     *
     * @return array
     * @author alaa <alaaragab34@gmail.com>
     */
    public function listPrices(): Response
    {
        $prices = Price::with('roomType')->get(['id','price', 'room_type_id']);

        return new Response(json_encode(array('status' => true, 'prices' => $prices)), 200);
    }

    /**
     * Get price details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function getPriceDetails(int $priceId): Response
    {
        $price = Price::with('roomType')->find($priceId);

        if(!$price)
            return new Response(json_encode(array('code' => '403', 'message' => 'No price found with this id')), 403);

        return new Response(json_encode(array('status' => true, 'price' => $price)), 200);
    }

    /**
     * create price.
     *
     * @param  array  $parameters
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function createPrice(array $parameters): Response
    {
        $price = Price::create($parameters);

        return new Response(json_encode(array('status' => true, 'price' => $price)), 201);

    }

    /**
     * Update price details.
     *
     * @param  int  $id
     * @param  array  $parameters
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function updatePriceDetails(int $priceId, array $parameters): Response
    {
        $price = Price::find($priceId);

        if(!$price)
            return new Response(json_encode(array('code' => '403', 'message' => 'No price found with this id')), 403);

        $price->update($parameters);
        return new Response(json_encode(array('status' => true, 'price' => $price)), 200);
    }

    /**
     * Delete price.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function deletePrice(int $priceId): Response
    {
        $price = Price::find($priceId);

        if(!$price)
            return new Response(json_encode(array('code' => '403', 'message' => 'No price found with this id')), 403);

        $price->delete();

        return new Response(json_encode(array('status' => true, 'message' => 'Price deleted')), 204);

    }
}