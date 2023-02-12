<?php
    function getMonths(){
        $months = [];
        for ($m=1; $m<=12; $m++) {
            $months[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }
        return $months;
    }

    function sendSMSMultiple($receivers, $message){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://smsml.creationsoftnepal.com/send?to=977'.$receivers.'&content='.$message.'&token='.env('SMS_TOKEN'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        $sms_log = new \App\Models\SMSLog();
        $sms_log->log = json_encode($response);
        $sms_log->save();
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($status_code == 200) {
            return true;
        } else {
            return false;
        }
    }

    function subArraysToString($ar, $sep = ', ') {
        $str = '';
        foreach ($ar as $val) {
            $str .= implode($sep, $val);
            $str .= $sep; // add separator between sub-arrays
        }
        $str = rtrim($str, $sep); // remove last separator
        return $str;
    }

    function getsubsidiary($id){
  
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

    

