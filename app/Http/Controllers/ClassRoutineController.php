<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassRoutine;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClassRoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $id = Auth::user()->organisation_id;
        $classes = Classes::where('organisation_id', $id)->select(['id', 'class_name'])->get();
        $section = Section::where('organisation_id', $id)->select(['id', 'section_name'])->get();
        $subject = Subject::where('organisation_id', $id)->select(['id', 'subject_name'])->get();
        $teacher = User::where('organisation_id', $id)->where('user_type', '4')->select([
            'id', 'first_name', 'last_name'
        ])->get();


        $classroutine = ClassRoutine::with('class', 'section', 'subject', 'teacher')->where('organisation_id', $id)
            ->when(request()->only('class'), function ($query) {
                return $query->where('class_name', request('class'));
            })
            ->when(request()->only('section'), function ($query) {
                return $query->where('section_name', request('section'));
            })
            ->when(request()->only('teacher'), function ($query) {
                return $query->where('teacher_name', request('teacher'));
            })
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/class-routine/index', [
            'classroutine' => $classroutine,
            'classes' => $classes,
            'section' => $section,
            'subject' => $subject,
            'teacher' => $teacher,
            'filters' => request()->all(['class', 'section', 'teacher']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $user = Auth::user();
        $id = $user->organisation_id;
        if ($user->user_type !== '1' && $user->user_type != '5') {
            return back()->with('error', 'You are not authorized to access this page');
        }
        $classes = Classes::where('organisation_id', $id)->select(['id', 'class_name'])->get();
        $section = Section::where('organisation_id', $id)->select(['id', 'section_name'])->get();
        $subject = Subject::where('organisation_id', $id)->select(['id', 'subject_name'])->get();
        $teacher = User::where('organisation_id', $id)->where('user_type', '4')->select([
            'id', 'first_name', 'last_name'
        ])->get();

        return Inertia::render('Admin/class-routine/create', compact('classes', 'section', 'subject', 'teacher'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->user_type != '1' && $user->user_type != '5') {
            return back()->with('error', 'You are not authorized to access this page');
        }

        $data = $request->validate([
            'class_name' => '',
            'section_name' => '',
            'subject_name' => '',
            'teacher_name' => '',
            'start_time' => '',
            'end_time' => '',
            'date' => '',
            'monday' => '',
            'tuesday' => '',
            'wednesday' => '',
            'thursday' => '',
            'friday' => '',
            'saturday' => '',
            'start_break' => '',
            'end_break' => ''
        ]);


        $id = Auth::user()->organisation_id;
        $data['organisation_id'] = $id;

        ClassRoutine::create(
            $data
        );
        return redirect()->route('class-routine.index')->with('success', 'Class routine created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassRoutine  $classRoutine
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoutine $classRoutine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassRoutine  $classRoutine
     * @return \Inertia\Response
     */
    public function edit(ClassRoutine $classRoutine)
    {
        $user = Auth::user();
        $id = $user->organisation_id;
        if ($user->user_type !== '1' && $user->user_type != '5') {
            return back()->with('error', 'You are not authorized to access this page');
        }
        $classes = Classes::where('organisation_id', $id)->select(['id', 'class_name'])->get();
        $section = Section::where('organisation_id', $id)->select(['id', 'section_name'])->get();
        $subject = Subject::where('organisation_id', $id)->select(['id', 'subject_name'])->get();
        $teacher = User::where('organisation_id', $id)->where('user_type', '4')->select([
            'id', 'first_name', 'last_name'
        ])->get();

        return Inertia::render('Admin/class-routine/edit',
            compact('classes', 'section', 'subject', 'teacher', 'classRoutine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassRoutine  $classRoutine
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, ClassRoutine $classRoutine)
    {
        $user = Auth::user();
        if ($user->user_type != '1' && $user->user_type != '5') {
            return back()->with('error', 'You are not authorized to access this page');
        }
        $data = $request->validate([
            'class_name' => '',
            'section_name' => '',
            'subject_name' => '',
            'teacher_name' => '',
            'start_time' => '',
            'end_time' => '',
            'date' => '',
            'monday' => '',
            'tuesday' => '',
            'wednesday' => '',
            'thursday' => '',
            'friday' => '',
            'saturday' => '',
            'start_break' => '',
            'end_break' => ''
        ]);

        $classRoutine->update($data);
        return redirect()->route('class-routine.index')->with('success', 'Class routine updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassRoutine  $classRoutine
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ClassRoutine $classRoutine)
    {
        $classRoutine->delete();
        return Redirect::back()->with('success', 'Class Routine deleted successfully');
    }
}
