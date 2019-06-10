<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class EachjobController extends Controller
{
    public static function display($num){
        $url = '/job/' . $num;
        $job = new Job;
        $data = $job->where('url', $url)->get();
        $send = $data[0];
        return view('eachjob')->with('send', $send);
    }
}
