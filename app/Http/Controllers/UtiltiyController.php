<?php
/**
 * Created by PhpStorm.
 * User: alaa
 * Date: 17/07/20
 * Time: 03:48 ص
 */

namespace App\Http\Controllers;


use App\Services\UtilityService;

class UtiltiyController
{
    protected $utilityService;

    /**
     * Hotel controller constructor
     * @param HotelService $hotelService
     */
    public function __construct(UtilityService $utilityService)
    {
        $this->utilityService = $utilityService;
    }

    /**
     * Uplaod image.
     *
     * @return \Illuminate\Http\Response
     * @author alaa <alaaragab34@gmail.com>
     */
    public function upload(): array
    {
        $parameters = request()->all();

        return $this->utilityService->upload($parameters);

    }
}