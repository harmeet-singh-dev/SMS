<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;


class SectionController extends Controller
{
    public function getAllSectons(Request $request){
        $sections = Section::all();
        return $sections;
    }
}
