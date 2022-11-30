<?php

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Aws\S3\MultipartUploader;

if (!function_exists('pr')) {

    function pr($data, $die = 0) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";

        if ($die == 1) {
            die;
        }
        return;
    }

}


