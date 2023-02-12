<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class accountreportController extends Controller
{
    public function trailbalance(Request $request){
    	$value= (new categoryactController)->tokenhelper();
        if(request('search')){
          
            $actoken = $_COOKIE["Token"];
			$fromdate = $request->input("FromDate");  
	    	$todate = $request->input("ToDate"); 

			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => 'http://actm.prabhumanagement.com/api/Voucher/GetTrialBalance?FromDate='.$fromdate.'&ToDate='.$todate.'&ReportType=Details',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_POSTFIELDS => 'FromDate='.$fromdate.'&ToDate='.$todate.'&ReportType=Details',
				CURLOPT_HTTPHEADER => array(
					'Authorization: Bearer '.$actoken
					),
				));

			$response = curl_exec($curl);
			curl_close($curl);

			$result= json_decode($response, true);

        }else{
            $result = "";
        }
    	return view('account/report/trailbalance',compact('result','request'));
    }


    public function generalledger(Request $request){
    	$value= (new categoryactController)->tokenhelper();
    	if(request('search')){
          
            $actoken = $_COOKIE["Token"];
			$fromdate = $request->input("FromDate");  
	    	$todate = $request->input("ToDate"); 
	    	$glname = $request->input('glname');

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  	CURLOPT_URL => 'https://actm.prabhumanagement.com/api/Voucher/GetGLDetails?GLId='.$glname.'&FromDate='.$fromdate.'&ToDate='.$todate,
			  	CURLOPT_RETURNTRANSFER => true,
			  	CURLOPT_ENCODING => '',
			  	CURLOPT_MAXREDIRS => 10,
			  	CURLOPT_TIMEOUT => 0,
			  	CURLOPT_FOLLOWLOCATION => true,
			  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  	CURLOPT_CUSTOMREQUEST => 'GET',
		  		CURLOPT_HTTPHEADER => array(
			    	'Authorization: Bearer '.$actoken
			  	),
			));

			$response = curl_exec($curl);

			curl_close($curl);
	        $result= json_decode($response, true);

        }else{
            $result = "";
        }
    	return view('account/report/generalledger',compact('result','request'));
    }


    public function profilandloss(Request $request){
    	$value= (new categoryactController)->tokenhelper();
    	if(request('search')){
	    	$actoken = $_COOKIE["Token"];
			$fromdate = $request->input("FromDate");  
	    	$todate = $request->input("ToDate"); 

	    	$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => 'http://actm.prabhumanagement.com/api/TrialBalance/GetProfitAndLoss?FromDate='.$fromdate.'&ToDate='.$todate.'&ReportType=Details',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_POSTFIELDS => 'FromDate='.$fromdate.'&ToDate='.$todate.'&ReportType=Details',
				CURLOPT_HTTPHEADER => array(
					'Authorization: Bearer '.$actoken
					),
				));

			$response = curl_exec($curl);

			curl_close($curl);
			$result= json_decode($response, true);

        }else{
            $result = "";
        }
    	return view('account/report/profitandloss',compact('result','request'));
    }



    public function balancesheet(Request $request){
    	$value= (new categoryactController)->tokenhelper();
    	if(request('search')){
	    	$actoken = $_COOKIE["Token"];
			$fromdate = $request->input("FromDate");  
	    	$todate = $request->input("ToDate");

	    	$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => 'http://actm.prabhumanagement.com/api/TrialBalance/BalanceSheet?FromDate='.$fromdate.'&ToDate='.$todate.'&ReportType=Details',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_POSTFIELDS => 'FromDate='.$fromdate.'&ToDate='.$todate.'&ReportType=Details',
				CURLOPT_HTTPHEADER => array(
					'Authorization: Bearer '.$actoken
					),
				));

			$response = curl_exec($curl);

			curl_close($curl);
			$result= json_decode($response, true);

        }else{
            $result = "";
        }
    	return view('account/report/balancesheet',compact('result','request'));
    }

    public function daybook(Request $request){
    	$value= (new categoryactController)->tokenhelper();
    	$actoken = $_COOKIE["Token"];

		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://actm.prabhumanagement.com/api/ChartOfAccount/GetSubsidiaryListByFlag?Flag=CH',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer '.$actoken
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$cash= json_decode($response, true);



		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://actm.prabhumanagement.com/api/ChartOfAccount/GetSubsidiaryListByFlag?Flag=BK',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer '.$actoken
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$bank= json_decode($response, true);


		if(request('search')){
	    	$actoken = $_COOKIE["Token"];
			$fromdate = $request->input("FromDate");  
	    	$todate = $request->input("ToDate");
	    	$cashledger = $request->input("cashledger");
	    	$bankledger = $request->input("bankledger");
	    	$cashflag = $request->input("cashflag");
	    	$bankflag = $request->input("bankflag");

	    	if($cashflag=="on"){

				$curl = curl_init();
				curl_setopt_array($curl, array(
				  	CURLOPT_URL => 'http://actm.prabhumanagement.com/api/DayBook/DayBook?FromDate='.$fromdate.'&ToDate='.$todate.'&CashFlag=true&BankFlag=false&CashGLId='.$cashledger.'&BankGLId=0',
				  	CURLOPT_RETURNTRANSFER => true,
				  	CURLOPT_ENCODING => '',
				  	CURLOPT_MAXREDIRS => 10,
				  	CURLOPT_TIMEOUT => 0,
				  	CURLOPT_FOLLOWLOCATION => true,
				  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  	CURLOPT_CUSTOMREQUEST => 'GET',
				  	CURLOPT_HTTPHEADER => array(
				    	'Authorization: Bearer '.$actoken
				  	),
				));
				$response = curl_exec($curl);
				curl_close($curl);
				$result= json_decode($response, true);

			}else{
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  	CURLOPT_URL => 'http://actm.prabhumanagement.com/api/DayBook/DayBook?FromDate='.$fromdate.'&ToDate='.$todate.'&CashFlag=false&BankFlag=true&CashGLId=0&BankGLId='.$bankledger,
				  	CURLOPT_RETURNTRANSFER => true,
				  	CURLOPT_ENCODING => '',
				  	CURLOPT_MAXREDIRS => 10,
				  	CURLOPT_TIMEOUT => 0,
				  	CURLOPT_FOLLOWLOCATION => true,
				  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  	CURLOPT_CUSTOMREQUEST => 'GET',
				  	CURLOPT_HTTPHEADER => array(
				    	'Authorization: Bearer '.$actoken
				  	),
				));
				$response = curl_exec($curl);
				curl_close($curl);
				$result= json_decode($response, true);
			}

        }else{
            $result = "";
        }
    	return view('account/report/daybook',compact('cash','bank','result','request'));
    }
}
