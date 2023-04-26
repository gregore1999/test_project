<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TESTCOMPANIES;
class companiesController extends Controller
{


    public function getCompanies(){

        $response['data'] = TESTCOMPANIES::get();
        $response['message'] = "OK";
        return response($response,200);
    }

}
