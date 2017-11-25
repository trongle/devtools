<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Timestamp;

class TimestampController extends Controller
{
    protected $arrDateFormat = [
        'default' => 'l, jS F Y @ h:i:s A', //'Sunday 19th November 2017 12:09:19 PM',
        'english' => 'd/m/Y H:i:s', //'11/19/2017 12:09:19',
        'german' => 'd.m.Y H:i:s', //'19.11.2017 12:09:19',
        'english12' => 'd/m/Y h:i:s A', //'11/19/2017 12:09:19 PM',
        'rfc1123' => 'r', //'Sun, 19 Nov 2017 12:09:19 +0000',
        'iso8601' => 'c', //'2017-11-19T12:09:19+00:00',
        'long' => 'd, F Y H:i:s' //'19. November 2017 12:09:19'
    ];

    public function getTimestamp(Timestamp $request){
        $customize = $request->cookie('CTM');

        $arrCustomize = json_decode($customize, true);

        $format = isset($arrCustomize['format']) ? $arrCustomize['format'] : $this->arrDateFormat['default'];
        $timezone = isset($arrCustomize['timezone']) ? $arrCustomize['timezone'] : date_default_timezone_get();

        date_default_timezone_set($timezone);

        //response
        return response()->json(['error' => 0, 'date' => date($this->arrDateFormat[$format], $request->timestamp)]);
    }

    public function customize(Timestamp $request){
        //set timezone
        date_default_timezone_set($request->customize['timezone']);

        return response()->json(['error' => 0, 'date' => date($this->arrDateFormat[$request->customize['format']], $request->timestamp)])
                        ->cookie('CTM', json_encode(['format' => $request->customize['format'], 'timezone' => $request->customize['timezone']]), 60 * 24 * 30);
    }

}
