<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\User;
use App\Models\Section;
use App\Models\Notice;
use App\Models\Student;
use App\Models\Department;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ClassRoutine;
use App\Models\ClassTeacher;
use Inertia\Inertia;
use Auth;
use DB;

class ClassController extends Controller
{
    public function getAllClasses(Request $request){
        $students = Classes::all();
        return $students;

    }

}
