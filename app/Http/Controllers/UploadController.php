<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request){
//        dd($request->all());
        $num = $request->num;
        $filename = 'job_' . $num . '.pdf';
        $request->file('file')->storeAs('public/', $filename);
        $redirected_url = 'job/' . $num . '/upload';
        return redirect($redirected_url);
    }
}
