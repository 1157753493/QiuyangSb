<?php
function errimg($error) {
   // $error is an array of error messages, each taking up one line
   // initialization
   $font_size = 2;
   $text_width = imagefontwidth($font_size);
   $text_height = imagefontheight($font_size);
   $width = 0;
   // the height of the image will be the number of items in $error
   $height = count($error);

   // this gets the length of the longest string, in characters to determine
   // the width of the output image
   for($x = 0; $x < count($error); $x++) {
      if(strlen($error[$x]) > $width) {
         $width = strlen($error[$x]);
      }
   }
   
   // next we turn the height and width into pixel values
   $width = $width * $text_width;
   $height = $height * $text_height;
   
   // create image with dimensions to fit text, plus two extra rows and
   // two extra columns for border
   $im = imagecreatetruecolor($width + ( 2 * $text_width ), 
                              $height + ( 2 * $text_height ) );
   if($im) {
      // image creation success
      $text_color = imagecolorallocate($im, 233, 14, 91);
      // this loop outputs the error message to the image
      for($x = 0; $x < count($error); $x++) {
         // imagestring(image, font, x, y, msg, color);
         imagestring($im, $font_size, $text_width, 
                     $text_height + $x * $text_height, $error[$x], 
                     $text_color);
      }
      // now, render your image using your favorite image* function
      // (imagejpeg, for instance)
      out($im, array(), $error);
   } else {
      // image creation failed, so just dump the array along with extra error
      $error[] = "Is GD Installed?";
      die(var_dump($error));
   }
}
?>