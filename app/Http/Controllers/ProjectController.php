<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //

    public function show()
    {
        return view('project.projects');
    }

    public function add()
    {
        return view('project.add');
    }
}