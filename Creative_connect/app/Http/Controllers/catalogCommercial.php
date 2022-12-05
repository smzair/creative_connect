<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class catalogCommercials extends Controller
{
   
   public function Index()
   {
       return view('commercial.Catalog_commercial');
   }


    public function View()
   {
       return view('commercial.Catalog_commercialView');
   }
}
