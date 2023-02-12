<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class AccountCategory extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'parent_id',
        'type'
    ];

    /**
     * @return BelongsTo
     */
    public function getParentCategory() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getChildCategories(){
        return $this->hasMany(self::class, 'parent_id');
    }

    public function GUID()
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public function getsubsidiary($id){
  
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

    public function voucherdetails($id,$name,$data){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://actm.prabhumanagement.com/api/Voucher/GetVoucherDetails?Id='.$id.'&VoucherNo='.$name,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '. $data
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data= json_decode($response, true);
        return $data; 
    }
}
