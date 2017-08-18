<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function index(){
    	$response = \Guzzle::get('https://google.com');

    	 
    	

        try {

               $client = new \GuzzleHttp\Client();
               $res = $client->request('GET','https://www.googleapis.com/calendar/v3/calendars/eeu2rvlqj388vukf66hqrc7fr8@group.calendar.google.com/events/18kc3tg3aqjbu5glr4vdg5vafc?key=AIzaSyDzewwoEhn2i2Ahfq8eNB3Tq-lhw6ClvmY',[
        
            /*$res = $client->request('GET','https://www.googleapis.com/calendar/v3/calendars/eeu2rvlqj388vukf66hqrc7fr8%40group.calendar.google.com/events/18kc3tg3aqjbu5glr4vdg5vafc?key=AIzaSyDzewwoEhn2i2Ahfq8eNB3Tq-lhw6ClvmY',[*/
                  /*  'form_params'=>
                    [
                        'key' => 'AIzaSyDzewwoEhn2i2Ahfq8eNB3Tq-lhw6ClvmY'  
                    //'fields' => 'items'
                    ]*/
                ]);//consulta datos y retorna respuesta WS

                // Here the code for successful request

            $resultBody= $res->getBody();
            json_decode($resultBody);
            dd(json_decode($resultBody));
            } catch (RequestException $e) {

                // Catch all 4XX errors 

                // To catch exactly error 400 use 
                if ($e->getResponse()->getStatusCode() == '400') {
                    //dd($res);
                        dd("Got response 400");
                }

                // You can check for whatever error status code you need 

            } 
    }

  
}
