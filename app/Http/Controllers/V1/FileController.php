<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            return response()->json([
                'result' => true,
                'message' => 'File uploaded successfully',
                'file' => $fileName],200);
        } else {
            return response()->json([
                'result' => false,
                'message' => 'No file uploaded'
            ], 404);
        }
    }
    public function deleteFile($fileName)
    {
        $filePath = public_path('uploads') . '/' . $fileName;

        if (file_exists($filePath)) {
            unlink($filePath);
            return response()->json([
                'result' => true,
                'message' => 'File deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'result' => false,
                'message' => 'File not found'
            ], 404);
        }
    }
}
