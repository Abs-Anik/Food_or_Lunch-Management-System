<?php

namespace App\Helpers;

use App\Models\ImageLibary;
use App\Models\ProductImage;
use Request;
use File;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class UploadHelper
{

  /**
   * upload Upload Any Types of File. It's not checking the file type which may be checked before pass here in validation
   * @param  [type] $f               [request for file or not]
   * @param  [type] $file            [pdf file]
   * @param  [type] $name            [filename]
   * @param  [type] $target_location [location where file will store]
   * @return [type]                  [filename]
   */
  public static function upload($f, $file, $name, $target_location)
  {

    if (Request::hasFile($f)) {
      $filename = $name . '.' . $file->getClientOriginalExtension();
      $extension = $file->getClientOriginalExtension();
      $file->move($target_location, $filename);
      return $filename;
    } else {
      return NULL;
    }
  }


  /**
   * [update file]
   * @param  [type] $f               [request for file or not]
   * @param  [type] $file            [pdf file]
   * @param  [type] $name            [filename]
   * @param  [type] $target_location [location where file will store]
   * @param  [type] $old_location    [file location which will delete]
   * @return [type]                  [filename]
   */
  public static function update($f, $file, $name, $target_location, $old_location)
  {
    //delete the old notice file
    $target_location = $target_location . '/';
    if (File::exists($target_location . $old_location)) {
      File::delete($target_location . $old_location);
    }

    $filename = $name . '.' . $file->getClientOriginalExtension();
    $file->move($target_location, $filename);
    return $filename;
  }


  /**
   * [delete file]
   * @param  [type] $location [file location that will delete]
   * @return [type]                  [null]
   */
  public static function deleteFile($location)
  {
    if (File::exists($location)) {
      File::delete($location);
    }
  }
  public static function imageUpload($image, $strImageName, $imageTitle, $imageAlternativeText, $target_location, $inBusinessID)
  {

    if (!empty($image)) {
      if ($strImageName == null || $strImageName == '') {
        $originalName = $image->getClientOriginalName();
        $strImageName = md5(rand(15000000, 24678543)) . '.' . pathinfo($originalName, PATHINFO_EXTENSION);
      }
      $image->move(
        base_path() . $target_location,
        $strImageName
      );
      try {
        DB::beginTransaction();
        $image = new ImageLibary();
        $image->strImageName = $strImageName;
        $image->imageTitle = $imageTitle;
        $image->imageAlternativeText = $imageAlternativeText;
        $image->inBusinessID = $inBusinessID;
        $image->intUserID = Auth::id();
        $image->basicPath = $target_location . '/';
        $image->save();
        DB::commit();

        return $image->intImageID;
      } catch (\Exception $e) {
        session()->flash('db_error', $e->getMessage());
        DB::rollBack();
        return back();
      }
    } else  return null;
  }
  public static function multiProductImageUpload($images, $strImageName, $imageTitle, $imageAlternativeText, $target_location, $intProductID, $inBusinessID)
  {

    foreach ($images as $image) {

   
      try {
       
        DB::beginTransaction();
        $productImage = new ProductImage();
        $productImage->intProductID =  $intProductID;
        $productImage->intUserID =  Auth::id();
        $productImage->intImageID = UploadHelper::imageUpload($image, null, null, null, $target_location, 1);;
        $productImage->save();
        DB::commit();
      } catch (\Exception $e) {
        session()->flash('db_error', $e->getMessage());
        DB::rollBack();
        // dd(session('db_error'));
        return back();
        
      }
    }
    // dd($images);
  }
}
