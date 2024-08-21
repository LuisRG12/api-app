<?php

namespace Modules\apiModule\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(){
        return view('apiModule::prueba');
    }
}