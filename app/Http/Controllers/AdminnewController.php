<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Models\Classes;
use App\Models\User;
use App\Models\Section;
use App\Models\Notice;
use App\Models\Student;
use App\Models\Department;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Auth;

class AdminnewController extends Controller
{
 public function allsubadmin()
  {
     $id = Auth::user()->organisation_id;
     $sub_admin = User::where('organisation_id', '=', $id)
     ->where('user_type', '=', 5)
     ->get(['id','first_name','last_name','email']);
     return Inertia::render('Admin/Allsubadmin',compact('sub_admin'));
  }



}
