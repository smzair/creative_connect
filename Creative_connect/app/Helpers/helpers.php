<?php
// project / vartical type
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

// Client Bucket
if (!function_exists('clientBucket')) {
    function clientBucket()
    {
        $clientBucket  = (object) array(
            array(
                'id' => "1",
                'value' => 'Existing',
            ),
            array(
                'id' => "2",
                'value' => 'Upselling'
            ),
            array(
                'id' => "3",
                'value' => 'New'
            )
        );
        return   $clientBucket;
    }
}

// dateFormat

function dateFormat($date){

    return date('d-m-Y',strtotime($date));
}

// timeFormat

function timeFormat($date){

    return date('H:i A',strtotime($date));
}
// get date time based on second 
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
