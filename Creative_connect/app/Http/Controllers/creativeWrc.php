<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class creativeWrc extends Controller
{
   public function Index()
   {
       return view('Wrc.Creative-wrc-create');
   }

     public function View()
   {
       return view('Lots.Creative_Wrc');
   }
}