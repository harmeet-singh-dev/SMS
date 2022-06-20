<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $user = Auth::user();
        $Department = Department::where('organisation_id', '=', $user->organisation_id)->get();
        $teachers = Teacher::where('organisation_id',$user->organisation_id)
            ->whereHas('user')->with('user')->paginate(10);
        return Inertia::render('Admin/teacher/index', ['teachers' => $teachers,'Departmentdata' => $Department]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $id = Auth::user()->id;
        $users = User::find($id);
        if ($users['user_type'] == '1' || $users['user_type'] == '2') {
            if ($users['organisation_id'] == 0) {
                $users = User::find($id);
                $Department = Department::where('organisation_id', '=', $id)->get();

                return Inertia::render('Admin/teacher/create', ['Departmentdata' => $Department]);
            } else {
                $Department = Department::where('organisation_id', '=', $users['organisation_id'])->get();
                return Inertia::render('Admin/teacher/create', ['Departmentdata' => $Department]);
            }

        } else {
            return Inertia::render('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse|\Inertia\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'blood_group' => 'required',
            'religion' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            'description' => 'string|nullable',
            'photo' => ['nullable', 'image'],
        ]);


        $id = Auth::user()->id;
        $users = User::find($id);
        if ($users['user_type'] == '1' || $users['user_type'] == '2') {
            if ($users['organisation_id'] == 0) {


                $user = User::create([
                    'organisation_id' => $id,
                    'user_type' => '4',
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'password' => bcrypt('12345678'),
                ]);
                $lastinsertid = $user->id;

                Teacher::create([
                    'organisation_id' => $id,
                    'user_id' => $lastinsertid,
                    'gender' => $request->get('gender'),
                    'dob' => $request->get('dob'),
                    'spouse_name' => $request->get('spouse_name'),
                    'blood_group' => $request->get('blood_group'),
                    'religion' => $request->get('religion'),
                    'phone' => $request->get('phone'),
                    'address' => $request->get('address'),
                    'city' => $request->get('city'),
                    'state' => $request->get('state'),
                    'department_id' => $request->get('department'),
                    'country' => $request->get('country'),
                    'pincode' => $request->get('pincode'),
                    'father_name' => $request->get('father_name'),
                    'mother_name' => $request->get('mother_name'),
                    'description' => $request->get('description'),
                    'photo' => $request->file('photo') ? $request->file('photo')->store('teachers') : '',
                ]);
                return response()->json([
                    'success' => 'Done'
                ]);

            } else {

                $users = User::find($id);

                $user = User::create([
                    'organisation_id' => $users['organisation_id'],
                    'user_type' => '4',
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'email' => $request->get('email'),
                    'password' => bcrypt('12345678'),
                ]);
                $lastinsertid = $user->id;

                Teacher::create([
                    'organisation_id' => $users['organisation_id'],
                    'user_id' => $lastinsertid,
                    'gender' => $request->get('gender'),
                    'dob' => $request->get('dob'),
                    'spouse_name' => $request->get('spouse_name'),
                    'blood_group' => $request->get('blood_group'),
                    'department_id' => $request->get('department'),
                    'religion' => $request->get('religion'),
                    'description' => $request->get('description'),
                    'phone' => $request->get('phone'),
                    'address' => $request->get('address'),
                    'city' => $request->get('city'),
                    'pincode' => $request->get('pincode'),
                    'state' => $request->get('state'),
                    'country' => $request->get('country'),
                    'father_name' => $request->get('father_name'),
                    'mother_name' => $request->get('mother_name'),
                    'photo' => $request->file('photo') ? $request->file('photo')->store('teachers') : '',

                ]);
                return response()->json([
                    'success' => 'Done'
                ]);
            }
        } else {
            return Inertia::render('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return RedirectResponse
     */
    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            'father_name' => 'required',
            'mother_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'blood_group' => 'required',
            'religion' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            'description' => 'string|nullable',

        ]);

        $teacher->update($data);

        if ($request->file('photo')) {
            $teacher->update([
                'photo' => $request->file('photo')->store('students')
            ]);
        }

        return  Redirect::back()->with('success', 'Teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return RedirectResponse
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return Redirect::back()->with('success', 'Teacher deleted successfully');
    }
}
