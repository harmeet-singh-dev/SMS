<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ClassRoutine;
use App\Models\ClassTeacher;
use Illuminate\Http\Request;

use Inertia\Inertia;
use Auth;
use App\Models\Notice;
use App\Models\Student;
use App\Models\StudentAttendance;
use Carbon\Carbon;

class TeacherController extends Controller
{
    public function dashboard(Request $request){
        $user_type = Auth::user()->user_type;
        if($user_type == '4'){
            $notices = Notice::where('teacher', 1)->orderBy('created_at', 'desc')->get();
            return Inertia::render('Frontend/Teacher/DashboardTeacher', compact('notices'));
        }
    }

    public function routine(Request $request) {
        $user = auth()->user();
        $user_type = Auth::user()->user_type;
        if($user_type == '4'){
            $id = Auth::user()->organisation_id;

            $now = Carbon::now();
            // $day = strtolower($now->format('l'));

            $routines = collect();
            // if($day != 'sunday') {
                $routines = ClassRoutine::with('subject', 'class', 'section')
                    ->where('teacher_name', $user->id)
                    // ->where($day, 1)
                    // ->where('date', $now->format('Y-m-d'))
                    ->filter(request()->only('search'))
                    ->paginate(10)
                    ->withQueryString();

                return Inertia::render('Frontend/Teacher/Routine', [
                    'routines' => $routines,
                    'filters' => request()->all('search')
                ]);
            // }
            // return redirect()->route('teachers.dashboard');
        }
    }

    public function class(Request $request) {
        $user = auth()->user();
        $user_type = Auth::user()->user_type;
        if($user_type == '4'){
            $id = Auth::user()->organisation_id;

            $now = Carbon::now();

            $classes = ClassTeacher::with('subject', 'class', 'section', 'department')
                ->where('teacher_id', $user->id)
                ->filter(request()->only('search'))
                ->paginate(10)
                ->withQueryString();

            return Inertia::render('Frontend/Teacher/ClassTeacher', [
                'classes' => $classes,
                'filters' => request()->all('search')
            ]);
        }
    }

    public function attendance(Request $request, $teacher_class){
        $user = auth()->user();
        $user_type = Auth::user()->user_type;
        if($user_type == '4'){
            $notices = Notice::where('teacher', 1)->orderBy('created_at', 'desc')->get();
            $students = Student::has('user')->with('user')->get();
            $class_teacher = ClassTeacher::with('subject', 'class', 'section', 'department')->where('id', $teacher_class)->first();
            
            $attendance = [];
            foreach($students as $student) {
                $present_days = [];
                $now = Carbon::now();
                $month_days = cal_days_in_month(CAL_GREGORIAN, $now->format('m'), $now->format('Y'));
                // dd($days);
                for($i = 1; $i <= $month_days; $i++) {
                    $date = Carbon::parse($i. ' ' . $now->format('M') . $now->format('Y'));

                    $is_present = StudentAttendance::where('teacher_id', $user->id)
                        ->where('class_id', $class_teacher->class_id)
                        ->where('section_id', $class_teacher->section_id)
                        ->where('subject_id', $class_teacher->subject_id)
                        ->where('department_id', $class_teacher->department_id)
                        ->where('student_id', $student->id)
                        ->where('current_date', $date)
                        ->first();

                    $present_days[$i] = 0;
                    if($is_present) {
                        $present_days[$i] = 1;
                    }
                }
                $attendance[$student->id] = $present_days;
            }
            // dd($attendance);
            return Inertia::render('Frontend/Teacher/StudentAttendance', compact('students', 'class_teacher', 'attendance', 'month_days'));
        }
    }

    public function update_attendance(Request $request, $student_id) {
        $user = auth()->user();
        $user_type = Auth::user()->user_type;
        if($user_type == '4'){
            $student = Student::find($student_id);
            $class_teacher = ClassTeacher::with('subject', 'class', 'section', 'department')->where('id', $request->class_teacher_id)->first();

            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            $now = Carbon::now();
            $month = $now->format('M');
            $year = $now->format('Y');

            if($request->has('month') && $request->has('year')) {
                $month = $months[$request->month -1];
                $year = $request->year;
            }
            $date = Carbon::parse($request->day. ' ' . $month . $year);


            $attendance = StudentAttendance::where('teacher_id', $user->id)
                ->where('class_id', $class_teacher->class_id)
                ->where('section_id', $class_teacher->section_id)
                ->where('subject_id', $class_teacher->subject_id)
                ->where('department_id', $class_teacher->department_id)
                ->where('student_id', $student->id)
                ->where('current_date', $date)
                ->first();

            if($attendance) {
                $attendance->delete();
            } else {
                $attendance = StudentAttendance::create([
                    'organisation_id' => $class_teacher->organisation_id,
                    'teacher_id' => $class_teacher->teacher_id,
                    'class_id' => $class_teacher->class_id,
                    'section_id' => $class_teacher->section_id,
                    'subject_id' => $class_teacher->subject_id,
                    'department_id' => $class_teacher->department_id,
                    'student_id' => $student->id,
                    'current_date' => $date
                ]);
            }

            return response()->json(['success' => 1], 200);
        }
        
    }

    public function attendance_list(Request $request) {
        $user = auth()->user();
        $user_type = Auth::user()->user_type;
        if($user_type == '4'){
            $id = Auth::user()->organisation_id;

            $now = Carbon::now();

            $classes = ClassTeacher::with('subject', 'class', 'section', 'department')
                ->where('teacher_id', $user->id)
                ->filter(request()->only('search'))
                ->paginate(10)
                ->withQueryString();

            return Inertia::render('Frontend/Teacher/AttendanceList', [
                'classes' => $classes,
                'filters' => request()->all('search')
            ]);
        }
    }

    public function attendance_show(Request $request, $teacher_class){
        $user = auth()->user();
        $user_type = Auth::user()->user_type;
        if($user_type == '4'){
            $notices = Notice::where('teacher', 1)->orderBy('created_at', 'desc')->get();
            $students = Student::has('user')->with('user')->get();
            $class_teacher = ClassTeacher::with('subject', 'class', 'section', 'department')->where('id', $teacher_class)->first();
            
            $attendance = [];
            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            $now = Carbon::now();
            $month = $now->format('M');
            $year = $now->format('Y');

            $month_days = cal_days_in_month(CAL_GREGORIAN, $now->format('m'), $year);
            if($request->has('month') && $request->has('year')) {
                $month = $months[$request->month -1];
                $year = $request->year;
                $month_days = cal_days_in_month(CAL_GREGORIAN, $request->month, $year);
            }
            
            foreach($students as $student) {
                $present_days = [];

                for($i = 1; $i <= $month_days; $i++) {
                    
                    $date = Carbon::parse($i. ' ' . $month . $year);

                    $is_present = StudentAttendance::where('teacher_id', $user->id)
                        ->where('class_id', $class_teacher->class_id)
                        ->where('section_id', $class_teacher->section_id)
                        ->where('subject_id', $class_teacher->subject_id)
                        ->where('department_id', $class_teacher->department_id)
                        ->where('student_id', $student->id)
                        ->where('current_date', $date)
                        ->first();

                    $present_days[$i] = 0;
                    if($is_present) {
                        $present_days[$i] = 1;
                    }
                }
                $attendance[$student->id] = $present_days;
            }
            // dd($month);
            $filters = $request;
            return Inertia::render('Frontend/Teacher/ShowAttendance', compact('students', 'class_teacher', 'attendance', 'filters', 'month', 'year', 'month_days'));
        }
    }
}
