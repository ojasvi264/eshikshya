<?php

namespace App\Http\Controllers\Account;

use App\Models\AccountCategory;
use App\Http\Requests\AccountCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request){

        $value= (new categoryactController)->tokenhelper();

        $token = $_COOKIE["Token"];
            if($token!==""){
              $curl = curl_init();

              curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://actm.prabhumanagement.com/api/ChartOfAccount/GetCOACategory',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                  'Authorization: Bearer ' .$token
                ),
              ));

              $response = curl_exec($curl);

              curl_close($curl);

              $category=json_decode($response, true);
            }else{
              redirect($_SERVER['HTTP_REFERER']);
            }

        return view('account.index',compact('category')); 
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        // $categories = AccountCategory::all();
        // return view('account.create', compact('categories'));
    }

    /**
     * @param AccountCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(Request $request){
      $value= (new categoryactController)->tokenhelper();
        $token = $_COOKIE["Token"];
        $uniqueid = $request->trans_id;
        $ac_type = $request->category_type;
      if(isset($token)){
        $ip = getenv('HTTP_CLIENT_IP')?:
        getenv('HTTP_X_FORWARDED_FOR')?:
        getenv('HTTP_X_FORWARDED')?:
        getenv('HTTP_FORWARDED_FOR')?:
        getenv('HTTP_FORWARDED')?:
        getenv('REMOTE_ADDR');
        if($ac_type=="group"){
            $data = 'CreatedBy='.Auth::user()->name.'&LedgerHead='.$request->title.'&CreatedDate='.date("Y-m-d").'&GLCode='.$request->GLCode.'&TransId='.$uniqueid.'&IpAddress='.$ip;

          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://actm.prabhumanagement.com/api/ChartOfAccount/CreateLedgerHead',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
              'Authorization: Bearer ' . $token,
              'Content-Type: application/x-www-form-urlencoded'
            ),
          ));

          $response = curl_exec($curl);

        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $err = curl_error($curl);
            curl_close($curl);


        }else{
            $ip = getenv('HTTP_CLIENT_IP')?:
                    getenv('HTTP_X_FORWARDED_FOR')?:
                    getenv('HTTP_X_FORWARDED')?:
                    getenv('HTTP_FORWARDED_FOR')?:
                    getenv('HTTP_FORWARDED')?:
                    getenv('REMOTE_ADDR');
            $value = 'GLCode=' . $request->GLCode . '&SubsidiaryName='.$request->title.'&CreatedBy='.Auth::user()->name.'&CreatedDate='.date("Y-m-d").'&TransId='.$uniqueid;

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://actm.prabhumanagement.com/api/ChartOfAccount/CreateGLSubsidiary',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $value,
              CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token,
                'Content-Type: application/x-www-form-urlencoded'
              ),
            ));

            $response = curl_exec($curl);

            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            
            
        }
        $result = json_decode($response, true);
        if ($result['StatusCode']!=="00") {
            
            return redirect()->route('account.category.index')->with('error',$result['Message']);
        } else {
            return redirect()->route('account.category.index')->with('success',$result['Message']);
        }
    }
}

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id){

        $category = AccountCategory::find($id);
        return view('account.edit', compact('category'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request){
      $value= (new categoryactController)->tokenhelper();
        $glname = $request->glname;
        $glcode = $request->glcode;
        $token = $_COOKIE["Token"];
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://actm.prabhumanagement.com/api/ChartOfAccount/UpdateGlName',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'GlName='.$glname.'&updatedBy='.Auth::user()->name.'&updatedDate='.date('Y-m-d').'&GlCode='.$glcode,
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token,
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // $subtext= json_decode($response, true);
        $result = json_decode($response, true);
        if ($result['StatusCode']!=="00") {
            
            return redirect()->route('account.category.index')->with('error',$result['Message']);
        } else {
            return redirect()->route('account.category.index')->with('success',$result['Message']);
        }
    }
}