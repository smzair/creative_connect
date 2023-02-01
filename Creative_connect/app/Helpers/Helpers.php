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
            $hours = $hours;
        }

        $t_days = floor($time_in_second / 86400);

        $days = $t_days."day ";
        if($t_days > 1){
            $days = $t_days."days ";
        }

        return $mainDuration =  $days . $hours . 'h ' . $minutes . 'min ' . $second.'sec';
    }
}

if (!function_exists('getTypeOfShootList')) {

    function getTypeOfShootList($id = '')
    {
        $typeOfShootList =
        array(
            'Apparel model with ghost shots' => 'Apparel model with ghost shots',
            'Apparel model' => 'Apparel Model',
            'Model Shoot' => 'Model Shoot',
            'Product Shoot' => 'Product Shoot',
            'Table-Top shoot' => 'Table-Top Shoot',
            'Apparel mannequin' => 'Apparel mannequin',
            'Flat lay shoot' => 'Flat lay shoot',
            'Flat Lay shoot Large Size Apparels' => 'Flat Lay shoot Large Size Apparels',
            'Ghost Mannequin Shoot' => 'Ghost Mannequin Shoot',
            'Hanger_Table Top_Flat Lay Shoot' => 'Hanger_Table Top_Flat Lay Shoot',
            'Apparel Model_Flat Lay Shoot' => 'Apparel Model_Flat Lay Shoot',
            'Creative Shoot' => 'Creative Shoot',
            'Editing' => 'Editing',
            'Product Shoot with Model' => 'Product Shoot with Model',
            'Hanger Shoot' => 'Hanger Shoot',
            'Extra Mood Shot' => 'Extra Mood Shot',
            'Lifestyle Non-Model Shoot for Products' => 'Lifestyle Non-Model Shoot for Products',
            'Catalog Videos' => 'Catalog Videos',
            '360 Videos' => '360 Videos',
            '360 Degree' => '360 Degree',
            '360 Videos without model' => '360 Videos without model',
            'Stylized Videos' => 'Stylized Videos',
            'Banner Shoot' => 'Banner Shoot',
            'Texture Shot' => 'Texture Shot',
            'Catalog videos + Catalog shoot' => 'Catalog videos + Catalog shoot',
            'Detail Angles' => 'Detail Angles',
            'Utility Shot' => 'Utility Shot',
            'Catalog shoot' => 'Catalog shoot',
            'Filling shot' => 'Filling shot',
            'Group shot' => 'Group shot',
            'High Resolution Images' => 'High Resolution Images'
        );



        if (!empty($id) && isset($typeOfShootList[$id])) {
            $typeOfShootList = $typeOfShootList[$id];
        }
        return $typeOfShootList;
    }
}

if (!function_exists('getProductList')) {

    function getProductList($id = '')
    {
        $productList =
        array(
            'Athleisure' => 'Athleisure',
            'Bags/Wallets/Facemask/Socks and Other Accessories' => 'Bags/Wallets/Face Mask/Socks & Other Accessories',
            'Bags/Wallets/Other Accessories' => 'Bags/Wallets/Other Accessories',
            'Bags/Wallets/Other Accessories(Facemasks)' => 'Bags/Wallets/Other Accessories (Face Masks)',
            'Bags/Wallets/Other Accessories (Socks)' => 'Bags/Wallets/Other Accessories (Socks)',
            'Briefs (Lingerie/ Innerwear)' => 'Briefs (Lingerie/ Innerwear)',
            'Dupattas' => 'Dupattas',
            'Food Products' => 'Food Products',
            'Footwear' => 'Footwear',
            'kidswear' => 'Kidswear',
            'Kidswear (Hanger Shoot)' => 'Kidswear ( Hanger Shoot)',
            'Kidswear Mask / Mask on Mannequin' => 'Kidswear Mask / Mask on Mannequin',
            'Food Products' => 'Food Products',
            'Footwear' => 'Footwear',
            'Gift Sets' => 'Gift Sets',
            'Gym Equipments' => 'Gym Equipments',
            'Home/Personal Care Products' => 'Home/Personal Care Products',
            'Infographics' => 'Infographics',
            'Men Casual' => 'Men Casual',
            'Men Suits' => 'Men Suits',
            'Mens Undergarments (briefs and trunks)' => 'Mens Undergarments (briefs and trunks)',
            'Mens Undergarments' => 'Mens Undergarments',
            'Other Accessories - Stoles & Scarves' => 'Other Accessories - Stoles & Scarves',
            'Sarees/Lehangas' => 'Sarees/Lehangas',
            'Sets' => 'Sets',
            'Sports Equipments' => 'Sports Equipments',
            'Stylised Video' => 'Stylised Video',
            'Unisex Casual / Formal' => 'Unisex Casual / Formal',
            'Watches/Jewellery (non reflective)' => 'Watches/Jewellery (non reflective)',
            'Watches/Jewellery (reflective)' => 'Watches/Jewellery (reflective)',
            'Stylised Video' => 'Stylised Video',
            'Combo Sets' => 'Combo Sets',
            'Electronics' => 'Electronics',
            'Extra Mood Shot' => 'Extra Mood Shot',
            'Flat Lay Creative Shoot' => 'Flat Lay Creative Shoot',
            'Kidswear Sets' => 'Kidswear Sets',
            'Kids Toys' => 'Kids Toys',
            'Kidswear Singles' => 'Kidswear Singles',
            'Lingerie/Innerwear - Singles' => 'Lingerie/Innerwear - Singles',
            'Lingerie/Innerwear - Sets' => 'Lingerie/Innerwear - Sets',
            'Loungewear/Nightwear' => 'Loungewear/Nightwear',
            'Men Accessories - Bracelets, Cufflinks, Pocket Squares,Ties' => 'Men Accessories - Bracelets, Cufflinks, Pocket Squares,Ties',
            'Men Casual - Table top' => 'Men Casual - Table top',
            'Men Casual - Product Functionality' => 'Men Casual - Product Functionality',
            'Men Casual Model shoot' => 'Men Casual Model shoot',
            'Men Formal' => 'Men Formal',
            'Women Casual / Kurtis - Premium Shoot' => 'Women Casual / Kurtis - Premium Shoot',
            'Watches / Jewellery - reflective' => 'Watches / Jewellery - reflective',
            'Women Casual / Kurtis' => 'Women Casual / Kurtis',
            'Women Formal' => 'Women Formal',
            'Mens Western Wear' => 'Mens Western Wear',
            'Women Western Wear' => 'Women Western Wear',
            'Mens Ethnic Wear' => 'Mens Ethnic Wear',
            'Women Ethnic Wear' => 'Women Ethnic Wear',
            'Footwear & Lifestyle Accessories' => 'Footwear & Lifestyle Accessories',
            'Handbags-Backpacks' => 'Handbags-Backpacks',
            'Jewellery, Watches, Personal Care & Other Metal/Glass Accessories (Non-Reflective)' => 'Jewellery, Watches, Personal Care & Other Metal/Glass Accessories (Non-Reflective)',
            'Jewellery, Watches, Personal Care & Other Metal/Glass Accessories (Reflective)' => 'Jewellery, Watches, Personal Care & Other Metal/Glass Accessories (Reflective)',
            '7-Stripe Doormat 40*60 cm' => '7-Stripe Doormat 40*60 cm',
            '7-Stripe Doormat 45*90 cm' => '7-Stripe Doormat 45*90 cm',
            'PVC S-mat 90*60 cm' => 'PVC S-mat 90*60 cm',
            'PVC S-mat 90*90 cm' => 'PVC S-mat 90*90 cm',
            '7-Stripe Doormat 60*120 cm' => '7-Stripe Doormat 60*120 cm',
            'PVC S-mat 90*150 cm' => 'PVC S-mat 90*150 cm',
            'Grab bar 30/50/60 cm' => 'Grab bar 30/50/60 cm',
            'Grab bar flip-up' => 'Grab bar flip-up',
            '7-stripe 45x75' => '7stripe 45x75',
            'Home Decor' => 'Home Decor',
            'Home Essentials' => 'Home Essentials',
            'Bed Sheets' => 'Bed Sheets'
        );

        if (!empty($id) && isset($productList[$id])) {
            $productList = $productList[$id];
        }
        return $productList;
    }
}

if (!function_exists('getAdaptationsList')) {

    function getAdaptationsList($id = '')
    {
        $adaptationsList =
            array(
                'Brand-Site' => 'Brand-Site',
                'Noon' => 'Noon',
                'Noon-Athletiq' => 'Noon-Athletiq',
                'Noon-DRIP' => 'Noon-DRIP',
                'Noon-QUWA' => 'Noon-QUWA',
                'Noon-OFFROAD' => 'Noon-OFFROAD',
                'Noon-AILA' => 'Noon-AILA',
                'Noon-NEON' => 'Noon-NEON',
                'Noon-SHIVCRAFT' => 'Noon-SHIVCRAFT',
                'Noon-ZARAFA' => 'Noon-ZARAFA',
                'Tata Cliq' => 'Tata Cliq',
                'Tata cliq luxury' => 'Tata cliq luxury',
                'Flipkart' => 'Flipkart',
                'Snapdeal' => 'Snapdeal',
                'Amazon' => 'Amazon',
                'Myntra' => 'Myntra',
                'Myntra_premium' => 'Myntra Premium',
                'Ajio' => 'Ajio',
                'Nykaa' => 'Nykaa',
                'Nykaa Fashion' => 'Nykaa Fashion',
                'First Cry' => 'First Cry',
                'Meesho' => 'Meesho',
                'NA' => 'NA',
                'STATE 8' => 'STATE 8',
                'High Resolution' => 'High Resolution',
                'Low White' => 'Low White',
                'Low Grey' => 'Low Grey',
                'Myntra OMNI' => 'Myntra OMNI',
                'Purple' => 'Purple',
                'Netmeds' => 'Netmeds',
                'Lime road' => 'Lime road',
                'Namashi' => 'Namashi'

            );


        if (!empty($id) && isset($adaptationsList[$id])) {
            $adaptationsList = $adaptationsList[$id];
        }
        return $adaptationsList;
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