<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function welcomeEmail(){
        dd("oka");
        $endpoint = "https://testing.egenienext.com:3004/v1/users/signup";

        $this->curlGet($endpoint);
        
        $myBody['name'] = "faheem ";
        $myBody['email'] = 'mfahim@egenienext.com';
        $myBody['password'] = 'password@1';
        // $endpoint = "https://testing.egenienext.com:3004/v1/users/checkAuth";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $endpoint,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($myBody),
                CURLOPT_HTTPHEADER => array(
                    // Set here requred headers
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                dd("cURL Error #:" . $err);
            } else {
                dd(json_decode($response));
            }
            dd();

        $email = 'abc@gmail.com';
        $data = array(
            'name' => 'ali ',
            'email' => 'ali@gmail.com',
            'message' => 'messages ',
        );
        Mail::send('emails/welcome', ['data' => $data], function ($message) use ($email) {
            $message->to($email, $email)->subject('');
        });
    }

    public function forgotPassword(){
        $email = 'abc@gmail.com';
        $data = array(
            'name' => 'ali ',
            'email' => 'ali@gmail.com',
            'message' => 'messages ',
        );
        Mail::send('emails/forgotpassword', ['data' => $data], function ($message) use ($email) {
            $message->to($email, $email)->subject('Contact Us');
        });
    }

   

}
