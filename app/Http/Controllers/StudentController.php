<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $user = Auth::user();
        $students = Student::where('organisation_id',$user->organisation_id)
            ->filter(request()->only('search'))
            ->whereHas('user')
            ->with('user')
            ->paginate(10)
            ->withQueryString();

        $Classes = Classes::where('organisation_id', $user->organisation_id)
            ->get();
        $Section = Section::where('organisation_id', $user->organisation_id)
            ->get();
        return Inertia::render('Admin/student/index', [
            'students' => $students, 'Classesdata' => $Classes, 'Sectiondata' => $Section,
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
        $id = Auth::user()->id;
        $organisation_id = Auth::user()->organisation_id;
        $user_type = Auth::user()->user_type;
        if ($user_type == '1' || $user_type == '5') {
          
                $users = User::find($id);
                $Classes = Classes::where('organisation_id', '=', $organisation_id)
                    ->get();
                $Section = Section::where('organisation_id', '=', $organisation_id)
                    ->get();
                return Inertia::render('Admin/student/create', ['Classesdata' => $Classes, 'Sectiondata' => $Section]);

            }
         else {
            return Inertia::render('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response|RedirectResponse
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $organisation_id = Auth::user()->organisation_id;
        $user_type = Auth::user()->user_type;
        if ($user_type == '1' || $user_type == '5') {
            $request->validate([
                'first_name' => 'required',
                'unique_id' => 'required',
                'last_name' => 'required',
                'father_name' => 'required',
                'mother_name' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'roll' => 'required',
                'blood_group' => 'required',
                'religion' => 'required',
                'email' => 'required',
                'classname' => 'required',
                'section' => 'required',
                'admission' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'pincode' => 'required',
                'photo' => ['nullable', 'image'],
            ]);

                $users = User::find($id);
                $classes = Classes::where('organisation_id', '=', $organisation_id)
                    ->get(['name']);
                $section = Section::where('organisation_id', '=', $organisation_id)
                    ->get(['section_name']);

                $user = User::create([
                    'organisation_id' => $organisation_id,
                    'user_type' => '2',
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'password' => bcrypt('12345678'),
                ]);
                $lastinsertid = $user->id;

                Student::create([
                    'organisation_id' => $organisation_id,
                    'user_id' => $lastinsertid,
                    'gender' => $request->get('gender'),
                    'unique_id' => $request->get('unique_id'),
                    'dob' => $request->get('dob'),
                    'roll' => $request->get('roll'),
                    'blood_group' => $request->get('blood_group'),
                    'religion' => $request->get('religion'),
                    'class' => $request->get('classname'),
                    'section' => $request->get('section'),
                    'admission' => $request->get('admission'),
                    'phone' => $request->get('phone'),
                    'address' => $request->get('address'),
                    'city' => $request->get('city'),
                    'state' => $request->get('state'),
                    'country' => $request->get('country'),
                    'pincode' => $request->get('pincode'),
                    'father_name' => $request->get('father_name'),
                    'mother_name' => $request->get('mother_name'),
                    'photo' =>$request->file('photo') ? $request->file('photo')->store('students') : '',

                ]);
                return redirect()->route('student.index')->with('success', 'Student Created Successfully');

            }
         else {
            return Inertia::render('/');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return RedirectResponse
     */
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'unique_id' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'roll' => 'required',
            'blood_group' => 'required',
            'religion' => 'required',
            'class' => 'required',
            'section' => 'required',
            'admission' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
        ]);

        $student->update($data);

        if ($request->file('photo')) {
            $student->update([
                'photo' => $request->file('photo')->store('students')
            ]);
        }

        return  Redirect::back()->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return RedirectResponse
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return Redirect::back()->with('success', 'Teacher deleted successfully');
    }
}
