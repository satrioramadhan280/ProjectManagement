<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function addFile(Request $request, Project $project){
        $PROJECT_FOLDER = $project->folder;
        $request->file('fileInput')->storeAs($PROJECT_FOLDER, $request->fileInput->getClientOriginalName());

        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'files'])->with('uploadFile', 'Upload File Successfuil');
    }

    public function deleteFile(Request $request, Project $project){
        $filePath = $request->input('filePath');
        Storage::delete($filePath);
        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id, 'user_tabs' => 'files'])->with('deleteFile', 'Delete File Successfuil');
    }
 
    public function downloadFile(Request $request){
        $filePath = $request->input('filePath');
        return Storage::download($filePath);
    }
}
