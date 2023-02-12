<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class voucherentryController extends Controller
{
	public function journalentry(){
		$value= (new categoryactController)->tokenhelper();
		return view('account.voucherentry.journalentry');
	}
	public function savejournalentry(Request $request){
		$value= (new categoryactController)->tokenhelper();
		if(isset($_POST['debit']))
		{
			$actoken = $_COOKIE["Token"];
			$count=count($_POST["debit"]);
			for($i=0;$i<$count;$i++){

				$subdata[]= array(
					'Debit'=> $request->debit[$i],
					'Credit' => $request->credit[$i],
					'Remarks'=>  $request->remark[$i],
					'GLId' =>  $request->glname[$i],

				);              
			}

			$object=json_encode($subdata);

			$url = 'http://actm.prabhumanagement.com/api/Voucher/CreateJV';
			$ch = curl_init($url);

			$ip = getenv('HTTP_CLIENT_IP')?:
			getenv('HTTP_X_FORWARDED_FOR')?:
			getenv('HTTP_X_FORWARDED')?:
			getenv('HTTP_FORWARDED_FOR')?:
			getenv('HTTP_FORWARDED')?:
			getenv('REMOTE_ADDR');
			$data = array(
				'CreatedBy'=>Auth::user()->name,
				'FiscalYear' => date("Y",strtotime($request->date)),
				'Narration'=> $request->title,
				'CreatedDate' => $request->date,
				'RefNumber' => '99',
				'TransId'=>$request->trans_id,
				'JVVoucherDetails'=>$subdata
			);

			$final=json_encode($data);

			$response=curl_setopt($ch, CURLOPT_POSTFIELDS, $final);

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"X-Custom-Header: value",
				"Content-Type: application/json",
				"Authorization: token ".$actoken,
			));

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$message=curl_exec($ch);
			curl_close($ch);
			$result = json_decode($message,true);
			if ($result['StatusCode']!=="00") {
				return back()->withInput()->with('error', $result['Message']);;
			} else {
				return back()->withInput()->with('success', $result['Message']);;
			}

		}

	}






	public function paymententry(){
		$value= (new categoryactController)->tokenhelper();
		return view('account.voucherentry.paymentvoucher');
	}

	public function savepaymentvoucher(Request $request){
		$value= (new categoryactController)->tokenhelper();
		$actoken = $_COOKIE["Token"];


		$createddate=$request->date;


		if(isset($_POST['GLId']))
		{
			$count=count($_POST["GLId"]);
			for($i=0;$i<$count;$i++){

				$subdata[]= array(
					'GLId'=> $request->GLId[$i],
					'Amount' => $request->amount[$i],
					'Remarks'=>  $request->remark[$i],
				);              
			}
			$object=json_encode($subdata);

			$url = 'http://actm.prabhumanagement.com/api/Voucher/CreatePV';
			$ch = curl_init($url);
			$ip = getenv('HTTP_CLIENT_IP')?:
			getenv('HTTP_X_FORWARDED_FOR')?:
			getenv('HTTP_X_FORWARDED')?:
			getenv('HTTP_FORWARDED_FOR')?:
			getenv('HTTP_FORWARDED')?:
			getenv('REMOTE_ADDR');
			$data = array(
				'CreatedBy'=>Auth::user()->name, 
				'FiscalYear' => date("Y",strtotime($request->date)),
				'Narration'=> $request->title,
				'CreatedDate' => $createddate,
				'TransId'=>$request->trans_id,
				'CashGlId'=>$request->CashGlId,
				'RefNumber'=>$request->reference_no,
				'PVVoucherDetails'=>$subdata
			);

			$final=json_encode($data);

			$response=curl_setopt($ch, CURLOPT_POSTFIELDS, $final);

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"X-Custom-Header: value",
				"Content-Type: application/json",
				"Authorization: token ".$actoken,
			));

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$message=curl_exec($ch);
			curl_close($ch);
			$result = json_decode($message,true);

			if ($result['StatusCode']!=="00") {
				return back()->withInput()->with('error', $result['Message']);;
			} else {
				return back()->withInput()->with('success', $result['Message']);;
			}

		}
	}






	public function receiptentry(Request $request){
		$value= (new categoryactController)->tokenhelper();
		return view('account.voucherentry.receiptvoucher');
	}

	public function savereceiptvoucher(Request $request){
		$value= (new categoryactController)->tokenhelper();
		$actoken = $_COOKIE["Token"];
        $createddate=$request->date;

        if(isset($_POST['GLId']))
        {
            $count=count($_POST["GLId"]);
            for($i=0;$i<$count;$i++){

                $subdata[]= array(
                    'GLId'=> $request->GLId[$i],
                    'Amount' => $request->amount[$i],
                    'Remarks'=>  $request->remark[$i],
                    );              
            }
            $object=json_encode($subdata);
            
            $url = 'http://actm.prabhumanagement.com/api/Voucher/CreateRV';
            $ch = curl_init($url);
            $ip = getenv('HTTP_CLIENT_IP')?:
            getenv('HTTP_X_FORWARDED_FOR')?:
            getenv('HTTP_X_FORWARDED')?:
            getenv('HTTP_FORWARDED_FOR')?:
            getenv('HTTP_FORWARDED')?:
            getenv('REMOTE_ADDR');

            $data = array(
                'CreatedBy'=>Auth::user()->name,
                'FiscalYear' => date("Y",strtotime($request->date)),
                'Narration'=> $request->title,
                'CreatedDate' => $createddate,
                'TransId'=>$request->trans_id,
                'CashGlId'=>$request->CashGlId,
                'RefNumber'=>$request->reference_no,
                'RVDetails'=>$subdata
                );

            $final=json_encode($data);

            $response=curl_setopt($ch, CURLOPT_POSTFIELDS, $final);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "X-Custom-Header: value",
                "Content-Type: application/json",
                "Authorization: token ".$actoken,
                ));

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $message = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($message,true);

            if ($result['StatusCode']!=="00") {
				return back()->withInput()->with('error', $result['Message']);;
			} else {
				return back()->withInput()->with('success', $result['Message']);;
			}
        }
	}
}
