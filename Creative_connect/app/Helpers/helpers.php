
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
