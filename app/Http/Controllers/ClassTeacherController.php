<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassTeacher;
use App\Models\Department;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClassTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
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

        $teacherdata = ClassTeacher::with('teacher', 'class', 'section', 'department')
                ->filter(request()->only('search'))
                ->paginate(10)
                ->withQueryString();

        return Inertia::render('Admin/class-teacher/Index', [
            'classdata' => $class,
            'sectiondata' => $section,
            'teachers' => $teacher,
            'departmentdata' => $department,
            'teacherdata' => $teacherdata,
            'filters' => request()->all('search')
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
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

        return Inertia::render('Admin/class-teacher/create', [
            'classdata' => $class, 'sectiondata' => $section, 'teacherdata' => $teacher, 'departmentdata' => $department
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $id = Auth::user()->organisation_id;
        $data = $request->validate([
            'teacher_id' => '',
            'class_id' => '',
            'section_id' => '',
            'department_id' => '',
        ]);
        $data['organisation_id'] = $id;
        ClassTeacher::create($data);

        return redirect()->route('class-teacher.index')->with('success', 'Class Teacher Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  ClassTeacher  $classTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(ClassTeacher $classTeacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ClassTeacher  $classTeacher
     * @return \Inertia\Response
     */
    public function edit(ClassTeacher $classTeacher)
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
        return Inertia::render('Admin/class-teacher/edit', [
            'classdata' => $class, 'sectiondata' => $section, 'teacherdata' => $teacher, 'departmentdata' => $department,
            'classTeacher' => $classTeacher->toArray()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, ClassTeacher $classTeacher)
    {
        $data = $request->validate([
            'teacher_id' => '',
            'class_id' => '',
            'section_id' => '',
            'department_id' => '',
        ]);
        $classTeacher->update($data);
        return redirect()->route('class-teacher.index')->with('success', 'Class Teacher Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ClassTeacher  $classTeacher
     * @return RedirectResponse
     */
    public function destroy(ClassTeacher $classTeacher)
    {
         $classTeacher->delete();
        return Redirect::back()->with('success', 'Class Teacher deleted successfully');
    }
}
