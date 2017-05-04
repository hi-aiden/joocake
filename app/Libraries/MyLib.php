<?php
/**
 * Created by PhpStorm.
 * User: helloworld
 * Date: 2017-05-04
 * Time: 오후 1:36
 */

namespace App\Libraries;

class MyLib
{
    public function is_image($path)
    {
        $a = getimagesize($path);
        $image_type = $a[2];

        if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
        {
            return true;
        }
        return false;
    }
}
