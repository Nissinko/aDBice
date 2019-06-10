<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class SearchControler extends Controller
{
    public function getCompanyByName($name){
        $company = new Company;
        $data = $company->where('company', $name)->get();

        return response()->json($data);
    }
}
