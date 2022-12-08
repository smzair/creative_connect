<?php
// project / vartical type

use Illuminate\Support\Facades\DB;


if(!function_exists('getLotNo')){
    function getLotNo($c_short = "c_short" , $short_name = "short_name" ,$s_type_name = "s_type"){
        $s_type ="";
        $serviceType_array = explode(" ", $s_type_name);
        foreach($serviceType_array  as $key => $val){
            $s_type .= $val[0];
        }
        return $lot_number = strtoupper('ODN'.date('dmY')."-".$c_short.$short_name.$s_type);
    }

}

// date formet functions YYYY-MM-DD
if(!function_exists('dateFormet_ymd')){
    function dateFormet_ymd($date){
        return date('Y-m-d' , strtotime($date));
    }
}

// date formet functions DD-MM-YYYY
if (!function_exists('dateFormet_dmy')) {
    function dateFormet_dmy($date)
    {
        return date('d-m-Y', strtotime($date));
    }
}

// date formet functions MM-DD-YYYY
if (!function_exists('dateFormet_mdy')) {
    function dateFormet_mdy($date)
    {
        return date('m/d/Y', strtotime($date));
    }
}

if (!function_exists('projectType')) {
    function projectType()
    {
        $projectType  = (object) array(
            array(
                'id' => "1",
                'value' => 'Enhanced Content',
            ),
            array(
                'id' => "2",
                'value' => 'Creative Graphics'
            ),
            array(
                'id' => "3",
                'value' => 'Social Media'
            ),
            array(
                'id' => "4",
                'value' => 'Web/DM/MPM'
            )
        );
        return   $projectType;
    }
}

// kind of Work
if (!function_exists('kindOfWork')) {
    function kindOfWork()
    {
        $kindOfWork  = (object) array(
            array(
                'id' => "1",
                'value' => 'Website',
            ),
            array(
                'id' => "2",
                'value' => 'Videos'
            ),
            array(
                'id' => "3",
                'value' => 'Social Media'
            ),
            array(
                'id' => "4",
                'value' => 'Stock Images'
            ),
            array(
                'id' => "5",
                'value' => 'Social Media Content'
            ),
            array(
                'id' => "6",
                'value' => 'Presentation'
            ),
            array(
                'id' => "7",
                'value' => 'Pages Design'
            ),
            array(
                'id' => "8",
                'value' => 'Mailers'
            ),
            array(
                'id' => "9",
                'value' => 'HTML/Banner'
            ),
            array(
                'id' => "10",
                'value' => 'GIF'
            ),
            array(
                'id' => "11",
                'value' => 'Engagement'
            ),
            array(
                'id' => "12",
                'value' => 'Gamification'
            ),
            array(
                'id' => "13",
                'value' => 'Copy'
            ),
            array(
                'id' => "14",
                'value' => 'Concept'
            ),
            array(
                'id' => "15",
                'value' => 'Campaign'
            ),
            array(
                'id' => "16",
                'value' => 'Branding'
            ),
            array(
                'id' => "17",
                'value' => 'Brand Audit'
            ),
            array(
                'id' => "18",
                'value' => 'Banners'
            ),
            array(
                'id' => "19",
                'value' => '3D Render'
            )
        );
        return   $kindOfWork;
    }
}

// Marketplace
if (!function_exists('getMarketPlace')) {

    function getMarketPlace() {
        $getMarketPlace = array(
            'Myntra' => 'Myntra',
            'Amazon' => 'Amazon',
            'Flipkart' => 'Flipkart',
            'Ajio' => 'Ajio',
            'Nykaa' => 'Nykaa',
            'Tata Cliq' => 'Tata Cliq',
            'First Cry' => 'First Cry',
            'Brand Site' => 'Brand Site',
            'Any Other Website' => 'Any Other Website',
            'Shopify' => 'Shopify',
        );
        return $getMarketPlace;
    }
}

// Type of Service
if (!function_exists('getTypeOfService')) {

    function getTypeOfService()
    {
        $getTypeOfService = array(
            'Fossil Master Sheet' => 'Fossil Master Sheet',
            'Creative Descriptions' => 'Creative Descriptions',
            'GHC Content + Descriptions + Images Scraping' => 'GHC Content + Descriptions + Images Scraping',
            'Content Sheet Creation' => 'Content Sheet Creation',
            'Uploading' => 'Uploading',
            'Image Scraping' => 'Image Scraping',
            'Fossil Carryover SKUs' => 'Fossil Carryover SKUs'
        );
        return $getTypeOfService;
    }
}

// pre 
if (!function_exists('pre')){
    function pre($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        return ;
    }
}

// user/compny data
if(!function_exists('getUserCompanyData')){

    function getUserCompanyData(){
        $users = DB::table('users')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
            ->where([['users.Company', '<>', NULL], ['roles.name', '=', 'Client']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);

         return $users;   
    }
}