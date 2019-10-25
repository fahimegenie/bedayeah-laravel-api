<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use GuzzleHttp\Client;

class AuthController extends Controller
{

    public function welcomeEmail(){

        $client = new \GuzzleHttp\Client(['verify' => false]);
        
        $endpoint = "https://testing.egenienext.com:3004/v1​/users​/signup";
        
        $myBody['name'] = "ali khan";
        $myBody['email'] = 'ali@example.com';
        $myBody['password'] = 'password@1';

        $post = [
            'name' => "ali khan",
            'email' => 'ali@example.com',
            'password' => 'password@1'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        var_export($response);
        exit;
        $data = $this->curlPost($endpoint,$myBody);
        dd($data);
        $request = $client->post($endpoint,  ['body'=>$myBody]);
        $response = $request->send();
        dd($response);
        // $myBody['auth'] = "bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjVkYjFjM2FkNTM0NTNhMDAyYWZmZmEwYiIsIm5hbWUiOiJmYWhpbSIsImVtYWlsIjoiZmFoaW0uZWdlbmllQGdtYWlsLmNvbSIsImlhdCI6MTU3MTkzMTA1MywiZXhwIjoxNTcyNTM1ODUzfQ.pGQFaxp73W55bo3dfyQ3Xlf-IEhwCr1tE6WZ9WZUpCE";
        // $request = $client->post($url,  ['form_params'=>$myBody]);

        $client = new \GuzzleHttp\Client(['verify' => false]);
        $response = $client->request('POST', $endpoint, ['query' => [
            'name'=>'ali khan',
            'email'=>'abc@example.com',
            'password'=>'password@1'
        ]]);

        // $response = $client->request('POST', 'https://testing.egenienext.com:3004/v1/users/verifyEmail', [
        //     'raw' => json_encode([
        //         'auth' => 'bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjVkYjFjM2FkNTM0NTNhMDAyYWZmZmEwYiIsIm5hbWUiOiJmYWhpbSIsImVtYWlsIjoiZmFoaW0uZWdlbmllQGdtYWlsLmNvbSIsImlhdCI6MTU3MTkzMTA1MywiZXhwIjoxNTcyNTM1ODUzfQ.pGQFaxp73W55bo3dfyQ3Xlf-IEhwCr1tE6WZ9WZUpCE',
        //     ]),
        //     'headers' => ['Content-Type' => 'application/json'],
        //     // If you want more informations during request
        //     'debug' => true
        // ]);

        dd($response);
        $response = $response->send();
    
        dd($response);

        $email = 'abc@gmail.com';
        $data = array(
            'name' => 'ali ',
            'email' => 'ali@gmail.com',
            'message' => 'messages ',
        );
        Mail::send('emails/welcome', ['data' => $data], function ($message) use ($email) {
            $message->to($email, $email)->subject('Contact Us');
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


    

    function curlPost($url, $data) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($error !== '') {
            throw new \Exception($error);
        }
    
        return $response;
    }

}
