<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Env;

class IndexController extends Controller
{

    public function checkMessage(Request $request){
        
        $message = $request->query('message');
        $messageChecker = "";

        if($message!=null){
            
            $client = new Client([
                'base_uri' => env('AZURE_BASE'),
            ]);
            

            $data = array (
                'Inputs' => array (
                'input1' => array (
                    [
                        "message"=> $message
                    ]
                ),
                ),
                'GlobalParameters' =>  null
            );
            $body = json_encode($data);
            $headers = array('Content-Type: application/json', 'Authorization:Bearer ' . env('API_KEY'));

            $curl = curl_init(); 
            curl_setopt($curl, CURLOPT_URL,env('AZURE_URL'));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
            $result = curl_exec($curl);

            if ($result === false) 
                $result = curl_error($curl);
            if(str_contains(strval($result),"ham")){
                $messageChecker="ham";
            }else{
                $messageChecker="spam";
            }

        }
        return view("welcome")->with("resultString",$messageChecker)->with("message",$message);
    }

    


    
}
