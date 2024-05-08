<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\S3\S3Client;

class FileController extends Controller
{
    protected $s3;

    public function __construct()
    {
        $this->s3 = new S3Client([
            'version' => 'latest',
            'region' => 'us-east-1',
        ]);
    }

    public function upload(Request $request)
    {
        $files = $request->file('files');
        $uploadedFiles = [];

        foreach ($files as $file) {
            $fileName = $file->getClientOriginalName();
            $filePath = 'uploads/' . $fileName;

            // Upload file to S3 bucket
            $result = $this->s3->putObject([
                'Bucket' => 'webs3applicationtest',
                'Key'    => $filePath,
                'Body'   => fopen($file->getRealPath(), 'r'),
                'ACL'    => 'public-read',
            ]);

            $uploadedFiles[] = $result['ObjectURL'];
        }

        return response()->json(['files' => $uploadedFiles]);
    }

    public function listFiles()
    {
        $objects = $this->s3->listObjectsV2([
            'Bucket' => 'webs3applicationtest',
        ]);

        $files = [];
        foreach ($objects['Contents'] as $object) {
            $files[] = $object['Key'];
        }

        return response()->json(['files' => $files]);
    }

    public function deleteFile(Request $request)
    {
        $filePath = $request->input('file_path');

        // Delete file from S3 bucket
        $this->s3->deleteObject([
            'Bucket' => 'webs3applicationtest',
            'Key'    => $filePath,
        ]);

        return response()->json(['message' => 'File deleted successfully']);
    }
}