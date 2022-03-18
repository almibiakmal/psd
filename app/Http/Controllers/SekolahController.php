<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Livewire\SekolahCrud;

class SekolahController extends Controller
{
    public function index(){
          return SekolahCrud::class;
    }
}
