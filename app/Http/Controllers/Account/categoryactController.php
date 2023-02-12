<?php

namespace App\Http\Controllers\Account;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
// use App\eventcategory;

class categoryactController extends Controller
{

public function tokenhelper(){
	$username = "user3";
  $password = "user123";

  $filusername = $username;
  $filepassword = $password;
  $data = 'username='.$filusername.'&password='.$filepassword.'&grant_type=password';

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://actm.prabhumanagement.com/token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/x-www-form-urlencoded'
    ),
  ));

  $response= curl_exec($curl);

  curl_close($curl);
  $text= json_decode($response, true);

  if(!isset($_COOKIE["Token"])) {
      $cookie_name = "Token";
      $cookie_value = $text['access_token']; 
      $cookie_time = $text['ExpiryDate'];
      setcookie($cookie_name, $cookie_value,strtotime($cookie_time));
      request()->headers->get('referer');
    }
  
  return $text;
}


function getsubsidiary($id){
    $value= (new categoryactController)->tokenhelper();
    $giventoken = $_COOKIE["Token"];
        $parentGl = $id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://actm.prabhumanagement.com/api/ChartOfAccount/GetChildLedgerByGLCode?GLCode='. $parentGl,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $giventoken
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $subtext= json_decode($response, true);
        return $subtext;
    }


    

    }