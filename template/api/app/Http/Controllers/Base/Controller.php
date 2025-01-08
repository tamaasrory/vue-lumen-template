<?php
/**
 * Copyright (c) 2020. dibuat Oleh Tama Asrory Ridhana, S.T, MTA.
 * website : https://tamaasrory.com
 * email : tamaasrory@gmail.com
 */

namespace App\Http\Controllers\Base;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @param Request $request
     * @param $fieldName
     * @param null $pathToSave
     * @return array|array[]
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function uploader(Request $request, $fieldName, $pathToSave = null): array
    {
        if ($request->hasFile($fieldName)) {
            //  Let's do everything here
            if ($request->file($fieldName)->isValid()) {
                //
                $validated = $this->validate($request, [
                    'image' => 'mimes:jpeg,png,svg|max:1014',
                ]);

                /** @var \Illuminate\Http\UploadedFile $file */
                $file = $request->{$fieldName};
                $extension = $file->extension();
                $fileName = Str::uuid() . "." . $extension;
                $request->{$fieldName}->storeAs('/public' . $pathToSave, $fileName);
                return [
                    'result' => [
                        'url' => Storage::url($fileName),
                        'filename' => $fileName
                    ],
                ];
            }
            return [
                'result' => false,
                'msg' => 'File Not Valid',
            ];
        }
        return [
            'result' => false,
            'msg' => 'No File Uploaded',
        ];
    }

    /**
     * @param Request $request
     * @param $name
     * @return array|mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function getJSON(Request $request, $name)
    {
        $tmp = json_decode($request->file($name)->get(), true);
        if (is_string($tmp)){
            $tmp = json_decode($tmp,true);
        }
        return $tmp;
    }
}
