<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Classes\YandexWeather;

class WeatherController extends Controller
{
    public function showWeather(){
        
        $temp = (new YandexWeather())->getTemperature();
        
        return view('/pages/weather',['temp'=>$temp]);
    }
}