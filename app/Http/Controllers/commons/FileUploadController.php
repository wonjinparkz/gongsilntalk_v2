<?php

namespace App\Http\Controllers\commons;

use App\Http\Controllers\Controller;
use App\Models\Files;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

/*
|--------------------------------------------------------------------------
| 파일 업로드
|--------------------------------------------------------------------------
|
| - 이미지 단일 업로드 (O)
| - 이미지 다중 업로드 (O)
|
*/

class FileUploadController extends Controller
{

    /**
     * 에디터 이미지 업로더
     */
    public function uplaodForEditor(Request $request)
    {

        if ($request->hasFile('upload')) {
            $image = $request->file('upload');
            // 이미지 생성
            $originImage = Image::make($image);

            // 이미지 리사이징
            $imageWidth = ($originImage->width() > 1000) ? 1000 : $originImage->width();
            $originImage->resize($imageWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            })->orientate()->encode('png', 100);
            $path = $image->hashName('image');

            // 이미지 저장
            Storage::disk('public')->put($path, $originImage);
            $storagePath = Storage::url($path);

            return response()->json(['fileName' => $path, 'uploaded' => 1, 'url' => $storagePath]);
        }
    }
    /**
     * 이미지 업로드
     */
    public function upload(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $result = $this->imageMake($request->file('image'));
        return $this->sendResponse($result, '이미지 저장에 성공했습니다.');
    }

    /**
     * 다중 이미지 업로드
     */
    public function multiUpload(Request $request)
    {
        // 오류 체크
        $validator = Validator::make($request->all(), [
            'image' => 'required|min:1',
            'image.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ]);

        if ($validator->fails()) {
            return $this->sendError("입력을 다시 확인해주시기 바랍니다.", $validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }


        $result['imageList'] = array();
        //$result['image'] = array();

        foreach ($request->file('image') as $image) {

            $imageData = $this->imageMake($image);
            //array_push($result['imageList'], $imageData);
            array_push($result['images'], $imageData);
        }

        return $this->sendResponse($result, '이미지 저장에 성공했습니다.');
    }

    /**
     * 이미지 생성
     */
    private function imageMake($image)
    {
        // 이미지 생성
        $originImage = Image::make($image);

        // 이미지 리사이징
        $imageWidth = ($originImage->width() > 1000) ? 1000 : $originImage->width();
        $originImage->resize($imageWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        })->orientate()->encode('png', 100);
        $path = $image->hashName('image');

        // 이미지 저장
        Storage::disk('public')->put($path, $originImage);


        // 썸네일 이미지 생성
        $thumbImage = Image::make($image);

        // 썸네일 리사이징
        $thumbWidth = ($thumbImage->width() > 300) ? 300 : $thumbImage->width();
        $thumbImage->resize($thumbWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        })->orientate()->encode('png', 80);
        $thumbPath = $image->hashName('thumb');

        // 썸네일 저장
        Storage::disk('public')->put($thumbPath, $thumbImage);


        $imageData['path'] = str_replace("image/", "", $path);
        $imageData['width'] = $originImage->width();
        $imageData['height'] = $originImage->height();

        $result = Images::create([
            'path' => $imageData['path'],
            'width' => $imageData['width'],
            'height' => $imageData['height'],
        ]);

        $imageData['id'] = $result->id;

        return $imageData;
    }

    /**
     * 파일 업로드
     */
    public function fileUpload(Request $request)
    {

        $file = $request->file('file');

        // 이미지 저장
        $path = $file->hashName('file');
        $fileName = $file->getClientOriginalName();
        Storage::disk('public')->put($path, $file);

        $path = str_replace("file/", "", $path);

        $result = Files::create([
            'path' => $path,
            'name' => $fileName
        ]);



        return $this->sendResponse($result, '파일 저장에 성공했습니다.');
    }

    /**
     * 파일 다운로드
     */
    public function fileDownload($path)
    {
        return response()->download(storage_path('app/public/file/' . $path . '/' . $path));
    }

    /**
     * 이미지 다운로드
     */
    public function imageDownload($path)
    {
        return response()->download(storage_path('app/public/image/' . $path ));
    }
}
