<?php
// project / vartical type

use App\Models\CatalogMarketplaceCredentials;
use App\Models\Marketplace;
use Illuminate\Support\Facades\DB;


if(!function_exists('get_date_time')){
    function get_date_time($time_in_second){
        $second = $time_in_second % 60;
        if (($second <= 9)) {
            $second = '0' . $second;
        }
        
        $minutes = floor(($time_in_second / 60) % 60);
        if (($minutes <= 9)) {
            $minutes = '0' . $minutes;
        }

        $hours = floor(($time_in_second /  (60*60)) % 24);
        
        if (($hours <= 9)) {
            $hours = '0' . $hours;
        }
        return $mainDuration =  $hours . 'h ' . $minutes . 'min ' . $second.'sec';
    }
}


// getcopywriter
if (!function_exists('getcopywriter')) {

    function getcopywriter()
    {
        $users = DB::table('users')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
            ->where([['roles.name', '=', 'CW']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short'])->toArray();
        return $users;
    }
}

// getLotNo
if(!function_exists('getLotNo')){
    function getLotNo($c_short = "c_short" , $short_name = "short_name" ,$s_type_name = "s_type"){
        $s_type ="";
        $serviceType_array = explode(" ", $s_type_name);
        foreach($serviceType_array  as $key => $val){
            if($val !== '+')
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


// Mode of Delivery-

if (!function_exists('modeOfDelivary')) {
    function modeOfDelivary()
    {
        $modeOfDelivary = array(
            '1' => 'Uploading',
            '2' => 'Excel Sheet',
            '3' => 'Drive Link',
            '4' => 'Doc',
            '5' => 'Zip',
        );
        return $modeOfDelivary;
    }
}
// Uploading
// Excel Sheet
// Drive Link
// Doc
// Zip


// Marketplace
if (!function_exists('getMarketPlace')) {

    function getMarketPlace() {

        $getMarketPlace = Marketplace::
            get(['id', 'marketPlace_name', 'link', 'username', 'password'])->toArray();
        return $getMarketPlace;
    }
}

if (!function_exists('commercial_wise_MarketplaceCredentials_list')) {

    function commercial_wise_MarketplaceCredentials_list()
    {
        $data = CatalogMarketplaceCredentials::leftJoin('marketplaces', 'marketplaces.id', 'catalog_marketplace_credentials.marketplace_id')->select(
                'catalog_marketplace_credentials.id',
                'catalog_marketplace_credentials.commercial_id',
                'catalog_marketplace_credentials.link',
                'catalog_marketplace_credentials.username',
                'catalog_marketplace_credentials.password',
                'catalog_marketplace_credentials.marketplace_id',
                'marketplaces.marketPlace_name',
            )->get()->toArray();
        return $data;
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


// Copy writer
if (!function_exists('getcopyWriter')) {

    function getcopyWriter()
    {
        $users = DB::table('users')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
            ->where([['roles.name', '=', 'CW']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short'])->toArray();
        return $users;
    }
}

// Cataloguer
if(!function_exists('getCataloguer')){
    
    function getCataloguer(){
        $users = DB::table('users')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
        ->where([['roles.name', '=', 'Cataloguer']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short'])->toArray();
        return $users;   
    }
}

// user/compny data

if (!function_exists('getUserCompanyData')) {

    function getUserCompanyData()
    {
        $users = DB::table('users')
        ->leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'model_has_roles.role_id')
        ->where([['users.Company', '<>', NULL], ['roles.name', '=', 'Client']])->get(['users.id', 'users.client_id', 'users.name', 'users.Company', 'users.c_short']);

        return $users;
    }
}

//  Rajesh 
// dateFormat

function dateFormat($date)
{
    return date('d-m-Y', strtotime($date));
}

// timeFormat

function timeFormat($date)
{
    return date('H:i A', strtotime($date));
}

// 