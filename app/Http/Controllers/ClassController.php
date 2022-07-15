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

    public function allclassteacher()
    {
         $id = Auth::user()->organisation_id;

        $teacher = User::where('organisation_id', $id)
            ->where('user_type', '4')
            ->select('id', 'first_name', 'last_name')
            ->get();
        $class = Classes::where('organisation_id', $id)
            ->select('id', 'class_name')
            ->get();
        $section = Section::where('organisation_id', $id)
            ->select('id', 'section_name')
            ->get();
        $department = Department::where('organisation_id', $id)
            ->select('id', 'department_name')
            ->get();

         $teacherdata = DB::table('class_teachers')
            ->join('users', 'users.id', '=', 'class_teachers.teacher_id')
            ->join('classes', 'classes.id', '=', 'class_teachers.class_id')
            ->join('sections', 'sections.id', '=', 'class_teachers.section_id')
            ->join('departments', 'departments.id', '=', 'class_teachers.department_id')
            ->select('class_teachers.id','users.first_name','users.last_name','users.email','classes.class_name','sections.section_name','departments.department_name')
             ->when(request()->only('search'), function ($query) {
                 return $query->where('users.first_name', 'like', '%'.request('search').'%')
                     ->orWhere('users.last_name', 'like', '%'.request('search').'%')
                     ->orWhere('users.email', 'like', '%'.request('search').'%')
                     ->orWhere('classes.class_name', 'like', '%'.request('search').'%')
                     ->orWhere('sections.section_name', 'like', '%'.request('search').'%')
                     ->orWhere('departments.department_name', 'like', '%'.request('search').'%');
             })
             ->paginate(10)
             ->withQueryString();
        return Inertia::render('Admin/Allclassteacher', [
            'classdata' => $class,
            'sectiondata' => $section,
            'teachers' => $teacher,
            'departmentdata' => $department,
            'teacherdata' => $teacherdata,
            'filters' => request()->all('search')
        ]);

    }

    public function deleteclassteacher($id)
    {
        ClassTeacher::where('id',$id)->delete();
        return Redirect::back()->with('success', 'Class Teacher deleted successfully');
    }

    public function createclassroutine()
    {
        $id = Auth::user()->organisation_id;
        $classes = Classes::where('organisation_id',$id)->select(['id','class_name'])->get();
        $section = Section::where('organisation_id',$id)->select(['id','section_name'])->get();
        $subject = Subject::where('organisation_id',$id)->select(['id','subject_name'])->get();
        $teacher = User::where('organisation_id',$id)->where('user_type','4')->select(['id','first_name','last_name'])->get();

     return Inertia::render('Admin/Createclassroutine',compact('classes','section','subject','teacher'));
  }

  public function routinepost(Request $request)
  {
            $user = Auth::user();
            if($user->user_type == '1' || $user->user_type == '5'){
            $request->validate([
                'class_name' => 'required',
                'section_name' => 'required',
                'subject_name' => 'required',
                'teacher_name' => 'required',
                               ]);
        $id = Auth::user()->organisation_id;
        $class_routine = new ClassRoutine;
        $class_routine->organisation_id = $user->organisation_id;
        $class_routine->class_name = $request->class_name;
        $class_routine->section_name = $request->section_name;
        $class_routine->subject_name = $request->subject_name;
        $class_routine->teacher_name = $request->teacher_name;
        $class_routine->start_time = $request->start_time;
        $class_routine->end_time = $request->end_time;
        $class_routine->date = $request->date;
        $class_routine->monday = $request->monday;
        $class_routine->tuesday = $request->tuesday;
        $class_routine->wednesday = $request->wednesday;
        $class_routine->thursday = $request->thursday;
        $class_routine->friday = $request->friday;
        $class_routine->saturday = $request->saturday;
        $class_routine->start_break = $request->start_break;
        $class_routine->end_break = $request->end_break;
        $class_routine->save();
        return response()->json([
            'success' => 'Done'
        ]);
  }else{
  }
  }

    public function allclassroutine()
    {
        $id = Auth::user()->organisation_id;
        $classes = Classes::where('organisation_id', $id)->select(['id', 'class_name'])->get();
        $section = Section::where('organisation_id', $id)->select(['id', 'section_name'])->get();
        $subject = Subject::where('organisation_id', $id)->select(['id', 'subject_name'])->get();
        $teacher = User::where('organisation_id', $id)->where('user_type', '4')->select([
            'id', 'first_name', 'last_name'
        ])->get();


        $classroutine = DB::table('class_routines')
            ->when(request()->only('class'), function ($query) {
                return $query->where('class_routines.class_name', request('class'));
            })
            ->when(request()->only('section'), function ($query) {
                return $query->where('class_routines.section_name', request('section'));
            })
            ->when(request()->only('teacher'), function ($query) {
                return $query->where('class_routines.teacher_name', request('teacher'));
            })
            ->join('users', 'users.id', '=', 'class_routines.teacher_name')
            ->join('classes', 'classes.id', '=', 'class_routines.class_name')
            ->join('sections', 'sections.id', '=', 'class_routines.section_name')
            ->join('subjects', 'subjects.id', '=', 'class_routines.subject_name')
            ->where('class_routines.organisation_id', $id)
            ->select('users.first_name', 'users.last_name', 'classes.class_name', 'sections.section_name',
                'subjects.subject_name',
                'class_routines.start_time', 'class_routines.end_time', 'class_routines.date', 'class_routines.monday',
                'class_routines.tuesday', 'class_routines.wednesday', 'class_routines.thursday',
                'class_routines.friday',
                'class_routines.saturday', 'class_routines.start_break', 'class_routines.end_break',
                'class_routines.id')
            ->paginate(10)
            ->withQueryString();
      return Inertia::render('Admin/Allclassroutine', [
          'classroutine' => $classroutine,
          'classes' => $classes,
          'section' => $section,
          'subject' => $subject,
          'teacher' => $teacher,
          'filters' =>  request()->all(['class', 'section', 'teacher']),
      ]);
  }

      public function deleteroutine($id)
      {
        ClassRoutine::where('id',$id)->delete();
        return Redirect::back()->with('success', 'Class Routine deleted successfully');
      }
}
