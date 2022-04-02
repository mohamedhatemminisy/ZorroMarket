<?php

define('PAGINATION_COUNT', 10);

function getFolder()
{

    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}

 if(!function_exists('upload_image'))
 {
     function upload_image($file, $prefix)
     {
         if($file){
             $files = $file;
             $imageName = $prefix.rand(3,999).'-'.time().'.'.$files->extension();
             $image = "storage/".$imageName;
             $files->move(public_path('storage'), $imageName);
             $getValue = $image;
             return $getValue;
         }
     }
 }

 if(!function_exists('random4DigitNumberGenerator'))
 {
        function random4DigitNumberGenerator()
        {
            $digits = 4;
            $i = 0; //counter
            $pin = ""; //our default pin is blank.
            while ($i < $digits) {
                //generate a random number between 0 and 9.
                $pin .= mt_rand(1, 9);
                $i++;
            }
            return $pin;
        }
 }