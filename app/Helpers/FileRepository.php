<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class FileRepository{


 public static function save($image,$path,$size){

        $orginalFileName = pathinfo($image, PATHINFO_FILENAME);
        
        
        $fileExtension =substr($image, strrpos($image, '.') + 1);
        
       
        $img = Image::make($image);
        $destinationPath =  public_path("uploads/".$path ."/");
        
        $img->fit($size[0],$size[1] ?? null);

        $img->resize($size[0], $size[1] ?? null, function ($constraint) {
           $constraint->aspectRatio();
       })->save($destinationPath.'/'.uniqid().rand(10,99).'.'.$fileExtension,80,'jpg');

       return    'uploads/'. $path.'/'.$img->basename;
    }




    public static function save2($image,$path,$size){

        $orginalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension=$image->getClientOriginalExtension();


        $img = Image::make($image->getRealPath());
        $destinationPath =  public_path("uploads/".$path ."/");
        
        $img->fit($size[0],$size[1] ?? null);

        $img->resize($size[0], $size[1] ?? null, function ($constraint) {
           $constraint->aspectRatio();
       })->save($destinationPath.'/'.uniqid().rand(10,99).'.'.$fileExtension,95,'jpg');

       return [
        'src'=>$path.'/'.$img->basename,
       ];
    }




    public static function saveWithThumb($image,$path,$size,$thumbSize){

        $orginalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension=$image->getClientOriginalExtension();


        $img = Image::make($image->getRealPath());
        $destinationPath = public_path($path);
        $img->fit($size[0],$size[1] ?? null);


        $img->resize($size[0], $size[1] ?? null, function ($constraint) {
           $constraint->aspectRatio();
       })->save($destinationPath.'/'.uniqid().rand(10,99).'.'.$fileExtension,95,'jpg');

       return [
        'src'=>$path.'/'.$img->basename,
        'thumb'=>FileRepository::thumb($image,$path,$thumbSize)
       ];
    }


    public static function thumb($image,$path,$size){

        $path=$path.'/thumb';


        $fileExtension=$image->getClientOriginalExtension();

        $img = Image::make($image->getRealPath());
        $destinationPath = public_path($path);
        $img->fit($size[0],$size[1] ?? null);
        $img->resize($size[0], $size[1] ?? null, function ($constraint) {
           $constraint->aspectRatio();
       })->save($destinationPath.'/'.uniqid().rand(10,99).'.'.$fileExtension,95,'jpg');

       return $path.'/'.$img->basename;
    }

    public static function remove($path){
        if(File::exists(public_path($path))){
            unlink(public_path($path));
        }
        return true;
    }

    public static function removeWithThumb($path,$thumb){
        if(File::exists(public_path($path))){
            unlink(public_path($path));
        }

        if(File::exists(public_path($thumb))){
           unlink(public_path($thumb));
        }
        return true;
    }

}
