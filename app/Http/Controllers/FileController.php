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

        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id]);
    }

    public function deleteFile(Request $request, Project $project){
        $filePath = $request->input('filePath');
        Storage::delete($filePath);
        return redirect()->action([ProjectController::class, 'detailView'], ['project' => $project->id]);
    }
}
