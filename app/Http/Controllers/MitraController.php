<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\pages;

class MitraController extends Controller
{
     public function index(){
          return view('pages.mitra');
    }
}
