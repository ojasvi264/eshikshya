<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountCategory;
use App\Http\Middleware\EncryptCookies;
use Illuminate\Support\Facades\Auth;

class voucherController extends Controller
{
    public function getupapproved(Request $request)
    {
      $title = "Unapproved Vouchers";
        $value= (new categoryactController)->tokenhelper();
        if(request('search')){
          
            $actoken = $_COOKIE["Token"];
            $fromdate=$request->input("FromDate");
            $todate= $request->input("ToDate");
            if (isset($actoken)){
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://actm.prabhumanagement.com/api/Voucher/GETUNAPPROVEDVOUCHERLIST?FromDate='.$fromdate.'&ToDate='.$todate,
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
        return view('account.voucher.index',compact('result','title','request'));
    }

    public function getapproved(Request $request)
    {
        $title = "Approved Vouchers";
        $value= (new categoryactController)->tokenhelper();
        if(request('search')){
            $actoken = $_COOKIE["Token"];
            $fromdate=$request->input("FromDate");
            $todate= $request->input("ToDate");
            if (isset($actoken)){
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://actm.prabhumanagement.com/api/Voucher/GETAPPROVEDVOUCHERLIST?FromDate='.$fromdate.'&ToDate='.$todate,
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
        return view('account.voucher.index',compact('result','title','request'));
    }

    public function rejected(Request $request)
    { 
        $title = "Rejected Vouchers";
        $value= (new categoryactController)->tokenhelper();
        if(request('search')){
            $actoken = $_COOKIE["Token"];
            $fromdate=$request->input("FromDate");
            $todate= $request->input("ToDate");
            if (isset($actoken)){
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://actm.prabhumanagement.com/api/Voucher/GETREJECTEDVOUCHERLIST?FromDate='.$fromdate.'&ToDate='.$todate,
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
        return view('account.voucher.index',compact('result','title','request'));
    }

    public function getvoucher(Request $request){
        $voucher_id              = $request->voucher_id;
        $voucher_no              = $request->voucher_no;
        $value= (new categoryactController)->tokenhelper();
        $actoken = $_COOKIE["Token"];
        $title = $request->title;
        $voucherdetails = new AccountCategory;
        $sendingdetails = $voucherdetails->voucherdetails($voucher_id,$voucher_no,$actoken);
        $modalbody = view('account.voucher._getdetails',['sendingdetails'=>$sendingdetails,'title'=>$title])->render();
        return response()->json($modalbody);
    }


    public function approve(Request $request){
      $value= (new categoryactController)->tokenhelper();
        $voucherno = $request->voucherno;
        $id = $request->voucherid; 
        $actoken = $_COOKIE["Token"];
        
        $value = 'VoucherNo='.$voucherno.'&Id='.$id.'&Status=00&ApprovedBy='.Auth::user()->name.'&ApprovedDate='.date("Y-m-d");
        $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://actm.prabhumanagement.com/api/Voucher/VoucherApproval',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $value,
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $actoken,
                'Content-Type: application/x-www-form-urlencoded'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $result = json_decode($response, true);
        if ($result['StatusCode']!=="00") {
            return back()->withInput()->with('error', $result['Message']);;
        } else {
            return back()->withInput()->with('success', $result['Message']);;
        }
    }

    public function reject(Request $request){
      $value= (new categoryactController)->tokenhelper();
        $voucherno = $request->voucherno;
        $id = $request->voucherid; 
        $actoken = $_COOKIE["Token"];
        
        $value = 'VoucherNo='.$voucherno.'&Id='.$id.'&Status=Rj&ApprovedBy='.Auth::user()->name.'&ApprovedDate='.date("Y-m-d");
        $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://actm.prabhumanagement.com/api/Voucher/VoucherApproval',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $value,
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $actoken,
                'Content-Type: application/x-www-form-urlencoded'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $result = json_decode($response, true);
        if ($result['StatusCode']!=="00") {
            
            return back()->withInput()->with('error', $result['Message']);;
        } else {
            return back()->withInput()->with('success', $result['Message']);;
        }
    }


    Public function approveall(Request $request){
      $value= (new categoryactController)->tokenhelper();
        $actoken = $_COOKIE["Token"];

        $transcaction = $request->trans_id;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://actm.prabhumanagement.com/api/Voucher/ApproveAllVoucher',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'ApproveDate='.date("Y-m-d").'&ApproveBy='.Auth::user()->name.'&TransId='.$transcaction.'&Status=00',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$actoken,
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response, true);
        if ($result['StatusCode']!=="00") {
            
            return back()->withInput()->with('error', $result['Message']);;
        } else {
            return back()->withInput()->with('success', $result['Message']);;
        }
        
    }
}
