<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Models\SMS;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(){
        $emails = Email::orderBy('created_at', 'desc')->get();
        $sms = SMS::orderBy('created_at', 'desc')->get();
        $datas = $emails->concat($sms);

        return view('superadmin.log.index', compact('datas'));
    }
}
