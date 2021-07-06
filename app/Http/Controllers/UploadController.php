<?php

namespace App\Http\Controllers;

use App\Http\Requests\Upload\UploadPhotoRequest;
use App\Http\Requests\Upload\UploadVideoRequest;
use App\Repositories\UploadRepository;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload)
    {
        $this->upload = $upload;
    }

    public function getmedia(Request $request, $userId, $type)
    {
        return $this->upload->getmedia($request, $userId, $type);
    }

    public function uploadPhoto(UploadPhotoRequest $request)
    {
        return $this->upload->uploadPhoto($request);
    }

    public function uploadVideo(UploadVideoRequest $request)
    {
        return $this->upload->uploadVideo($request);
    }
    public function getPackageUsage(Request $request)
    {
        return $this->upload->getPackageUsage($request);
    }

}
