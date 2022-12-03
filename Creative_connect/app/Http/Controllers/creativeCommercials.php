<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class creativeCommercials extends Controller
{
   
   public function Index()
   {
       return view('commercial.Creative-commercials');
   }


    public function View()
   {
       return view('commercial.Creative_commercialView');
   }
}
