<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class creativeLot extends Controller
{
    public function Index()
   {
       return view('Lots.creative-Lot-create');
   }
}
