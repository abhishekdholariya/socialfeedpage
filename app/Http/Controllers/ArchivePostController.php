<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchivePostController extends Controller
{
    public function show(){
        return view('layout.archivepost');
    }
}
