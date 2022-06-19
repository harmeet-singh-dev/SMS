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

class AdminController extends Controller
{

    public function dashboard(Request $request)
    {
        $user_type = Auth::user()->user_type;


        if ($user_type == '0') {
            $Data = User::where('user_type', '=', '1')->count();
            return Inertia::render('Admin/Dashboard', compact('Data'));
        }
        if ($user_type == '1') {
            return Inertia::render('Admin/OwnerDashboard');
        }
    }

    public function createclasspro(Request $request)
    {
        $id = Auth::user()->id;
        $users = User::find($id);

        $this->validate($request, [
            'name' => 'required',
        ]);
//dd($users);
        if ($users['user_type'] == '0' || $users['user_type'] == '1') {
            if ($users['organisation_id'] == '0') {
                /// dd($request);
                $class = new Classes;
                $class->name = $request->name;
                $class->organisation_id = $id;
                $class->save();
                return response()->json([
                    'success' => 'Done'
                ]);

            }
        }
    }

    public function allclass()
    {
        $id = Auth::user()->id;
        $users = User::find($id);
        $Classes = Classes::where('organisation_id', $id)->select('id', 'name')->get();
        return Inertia::render('Admin/Allclass', ['Data' => $Classes]);
    }

    public function update($id)
    {
        $Data = Classes::where('id', $id)->select('id', 'name')->get();
        return Inertia::render('Admin/Updateclass', ['updatedata' => $Data]);
    }

    public function update_class(Request $request)
    {

        $class = new Classes();
        $this->validate($request, [
            'name' => 'required',
        ]);
        $class = Classes::find($request->id);
        $class->name = $request->get('name');
        $class->save();
        return response()->json([
            'success' => 'Done'
        ]);
    }

    public function delete($id)
    {
        Classes::find($id)->delete();
        return response()->json([
            'success' => 'Deleted'
        ]);
    }

    public function sub_admin()
    {
        return Inertia::render('Admin/Createsubadmin');
    }

    public function subadminpro(Request $request)
    {
        $id = Auth::user()->id;
        $users = User::find($id);

        if ($users['user_type'] == '1' || $users['user_type'] == '5') {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
            ]);

            if ($users['organisation_id'] == 0) {
                User::create([
                    'organisation_id' => $id,
                    'user_type' => '5',
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'password' => bcrypt('12345678'),
                ]);

                return response()->json([
                    'success' => 'Done'
                ]);
            } else {
                User::create([
                    'organisation_id' => $users['organisation_id'],
                    'user_type' => '5',
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'password' => bcrypt('12345678'),
                ]);

                return response()->json([
                    'success' => 'Done'
                ]);
            }
        } else {
            return Inertia::render('/');
        }
    }

    public function section()
    {
        return Inertia::render('Admin/Createsection');
    }

    public function sectionpost(Request $request)
    {
        $id = Auth::user()->id;
        $users = User::find($id);
        if ($users['user_type'] == '1' || $users['user_type'] == '2') {
            $request->validate([
                'name' => 'required',

            ]);


            if ($users['organisation_id'] == 0) {
                Section::create([
                    'organisation_id' => $id,
                    'section_name' => $request->get('name'),
                ]);
                return response()->json([
                    'success' => 'Done'
                ]);
            } else {

                Section::create([
                    'organisation_id' => $users['organisation_id'],
                    'section_name' => $request->get('name'),
                ]);
                return response()->json([
                    'success' => 'Done'
                ]);
            }


        } else {
            return Inertia::render('/');
        }
    }

    public function notice()
    {
        return Inertia::render('Admin/Createnotice');
    }

    public function noticepost(Request $request)
    {
        $id = Auth::user()->id;
        $users = User::find($id);
        if ($users['user_type'] == '1' || $users['user_type'] == '2') {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'posted_by' => 'required',

            ]);


            if ($users['organisation_id'] == 0) {
                Notice::create([
                    'organisation_id' => $id,
                    'title' => $request->get('title'),
                    'description' => $request->get('description'),
                    'posted_by' => $request->get('posted_by'),
                    'student' => $request->get('student'),
                    'teacher' => $request->get('teacher'),
                    'time' => $request->get('time'),
                ]);
            } else {

                Notice::create([
                    'organisation_id' => $users['organisation_id'],
                    'title' => $request->get('title'),
                    'description' => $request->get('description'),
                    'posted_by' => $request->get('posted_by'),
                    'student' => $request->get('student'),
                    'teacher' => $request->get('teacher'),
                    'time' => $request->get('time'),
                ]);

            }
        } else {
            return Inertia::render('/');
        }
    }

    public function department()
    {
        $id = Auth::user()->id;
        $users = User::find($id);

        if ($users['user_type'] == '1' || $users['user_type'] == '2') {
            return Inertia::render('Admin/Createdepartment');
        } else {
            return Inertia::render('/');
        }
    }

    public function departmentpost(Request $request)
    {
        $id = Auth::user()->id;
        $users = User::find($id);

        if ($users['user_type'] == '1' || $users['user_type'] == '2') {

            if ($users['organisation_id'] == 0) {
                Department::create(['organisation_id' => $id, 'department_name' => $request->name]);
                return response()->json([
                    'success' => 'Done'
                ]);
            } else {

                Department::create([
                    'organisation_id' => $users['organisation_id'], 'department_name' => $request->name
                ]);
                return response()->json([
                    'success' => 'Done'
                ]);
            }
        } else {
            return Inertia::render('/');
        }
    }

    public function class_teacher()
    {
        $id = Auth::user()->id;
        $users = User::find($id);

        if ($users['user_type'] == '1' || $users['user_type'] == '2') {

            if ($users['organisation_id'] == 0) {
                $teacher = User::where('organisation_id', $id)
                    ->where('user_type', '4')
                    ->select('id', 'first_name', 'last_name')
                    ->get();
                $class = Classes::where('organisation_id', $id)
                    ->select('id', 'name')
                    ->get();
                $section = Section::where('organisation_id', $id)
                    ->select('id', 'section_name')
                    ->get();
                $department = Department::where('organisation_id', $id)
                    ->select('id', 'department_name')
                    ->get();

                return Inertia::render('Admin/Createclassteacher', [
                    'classdata' => $class, 'sectiondata' => $section, 'teacherdata' => $teacher,
                    'departmentdata' => $department
                ]);
            } else {

                $teacher = User::where('organisation_id', $users['organisation_id'])
                    ->where('user_type', '4')
                    ->select('id', 'first_name', 'last_name')
                    ->get();
                $class = Classes::where('organisation_id', $users['organisation_id'])
                    ->select('id', 'name')
                    ->get();
                $section = Section::where('organisation_id', $users['organisation_id'])
                    ->select('id', 'section_name')
                    ->get();
                $department = Department::where('organisation_id', $id)
                    ->select('id', 'department_name')
                    ->get();


                return Inertia::render('Admin/Createclassteacher', [
                    'classdata' => $class, 'sectiondata' => $section, 'teacherdata' => $teacher,
                    'departmentdata' => $department
                ]);
            }
        } else {
            return Inertia::render('/');
        }
    }

    public function subject()
    {
        return Inertia::render('Admin/Createsubject');
    }

    public function subjectpost(Request $request)
    {
        $id = Auth::user()->id;
        $users = User::find($id);
        $request->validate([
            'name' => 'required',
        ]);
        if ($users['user_type'] == '1' || $users['user_type'] == '2') {
            if ($users['organisation_id'] == 0) {

                Subject::create(['subject_name' => $request->name, 'organisation_id' => $id]);

                return response()->json([
                    'success' => 'Done'
                ]);


            } else {

                Subject::create(['subject_name' => $request->name, 'organisation_id' => $users['organisation_id']]);

                return response()->json([
                    'success' => 'Done'
                ]);

            }
        } else {
            return Inertia::render('/');
        }

    }

    public function fees()
    {
        return Inertia::render('Admin/Createfees');
    }
}
