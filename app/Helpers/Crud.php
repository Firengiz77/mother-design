<?php

namespace App\Helpers;

use App\Models\Slider;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\News;

class Crud 
{

  public function  common_image($table_name,$request,$file_name){
    $image1 = $request->file($file_name);
    $fileNameImage1 = hexdec(uniqid()) . '.' . $image1->extension();
    $image1->move(public_path("uploads/".$table_name ."/"), $fileNameImage1);
   return  $imageURL1 = "uploads/".$table_name ."/" . $fileNameImage1;
 }   



 


   public function  image1($table_name,$request){
        $image1 = $request->file('image1');
        $fileNameImage1 = hexdec(uniqid()) . '.' . $image1->extension();
        $image1->move(public_path("uploads/".$table_name ."/"), $fileNameImage1);
       return  $imageURL1 = "uploads/".$table_name ."/" . $fileNameImage1;
     }     
     
     public function  thumbnail($table_name,$request){
        $thumbnail = $request->file('thumbnail');
        $fileNamethumbnail = hexdec(uniqid()) . '.' . $thumbnail->extension();
        $thumbnail->move(public_path("uploads/".$table_name ."/"), $fileNamethumbnail);
       return  $imageURL1 = "uploads/".$table_name ."/" . $fileNamethumbnail;
     }    

     public function  image2($table_name,$request){
        $image2 = $request->file('image2');
        $fileNameImage2 = hexdec(uniqid()) . '.' . $image2->extension();
        $image2->move(public_path("uploads/".$table_name ."/"), $fileNameImage2);
       return  $imageURL2 = "uploads/".$table_name ."/" . $fileNameImage2;
     }  


     public function  image($table_name,$request){
      $image = $request->file('image');
      $fileNameimage = hexdec(uniqid()) . '.' . $image->extension();
      $image->move(public_path("uploads/".$table_name ."/"), $fileNameimage);
     return  $imageURL = "uploads/".$table_name ."/" . $fileNameimage;
   }  




}
