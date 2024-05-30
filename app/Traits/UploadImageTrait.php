<?php
namespace App\Traits;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
    public function uploadImage($request, $path)
    {
        $file = $request->file('image');
        $file_raw_name_with_ext = $file->getClientOriginalName();                   // cv1.jpg
        $make_them_array = explode('.', $file_raw_name_with_ext);                   // ['cv1','jpg']
        array_pop($make_them_array);                                                // ['cv1']
        $file_raw_name = implode('.', $make_them_array);                            // 'cv1'
        $file_safe_ext = $file->guessExtension();                                   // 'jpg'
        $rand_naming = time() . random_int(0, 99) . gen_ran_str(5);                  // RANDOM_VALUE!
        $final_name = $rand_naming . '-' . $file_raw_name . '.' . $file_safe_ext;   // '171505931760ZlSqy-cv1.jpg'

        // $request->file('image')->storeAs('users-images', $final_name, 'public');
        // OR
        Storage::putFileAs($path, $request->file('image'), $final_name);
        return $final_name;
    }
    protected function uploadImage2(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads', ['disk' => 'public']);
        return $path;

    }


}
