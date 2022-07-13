<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Classes;
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
        $sub_admins = User::where('organisation_id', '=', $id)
            ->filter(request()->only('search'))
            ->where('user_type', '=', 5)
            ->with('permission')
            ->select(['id', 'first_name', 'last_name', 'email'])
            ->paginate(10)
            ->withQueryString();
        //loop through the sub admin and check if permission is set
        foreach ($sub_admins as $sub_admin) {
            $sub_admin->permission_set = false;
            if ($sub_admin->permission) {
                $sub_admin->permission_set = true;
            }
        }


        return Inertia::render('Admin/Allsubadmin', [
            'sub_admins' => $sub_admins,
            'filters' => request()->all('search')
        ]);
    }

    public function updateSubAdmin(Request $request, User $user)
    {
        $data = $request->data;
        $user->update($data);

        return Redirect::back()->with('success', 'Permission updated successfully');

    }

    public function updateSubAdminPermission(Request $request, User $user)
    {
        $data = $request->data;
        $user->permission()->update($data);

        return Redirect::back()->with('success', 'Permission updated successfully');

    }

    public function deleteSubAdmin(User $user)
    {
        $user->permission()->delete();
        $user->delete();

        return Redirect::back()->with('success', 'Sub Admin deleted successfully');
    }

    public function allsubject()
    {
        $id = Auth::user()->organisation_id;
        $subject = Subject::where('organisation_id', '=', $id)->select(['id', 'subject_name'])->paginate(5);
        return Inertia::render('Admin/Allsubject', compact('subject'));
    }

    public function deleteSubject($id)
    {
        Subject::where('id', $id)->delete();

        return Redirect::back()->with('success', 'Subject deleted successfully');
    }

    public function updatesubject(Request $request)
    {

        $newdata = $request->data;


        $subject = Subject::find($newdata['id']);
        $subject->subject_name = $newdata['subject_name'];
        $subject->save();

        return Redirect::back()->with('success', 'Subject updated successfully');
    }

    public function alldepartment()
    {
        $id = Auth::user()->organisation_id;
        $department = Department::where('organisation_id', '=', $id)
            ->filter(request()->only('search'))
            ->select(['id', 'department_name'])
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Alldepartment', [
            'department' => $department,
            'filters' => request()->all('search')
        ]);

    }

    public function deletedepartment($id)
    {
        Department::where('id', $id)->delete();

        return Redirect::back()->with('success', 'Department deleted successfully');
    }

    public function updatedepartment(Request $request)
    {

        $newdata = $request->data;


        $department = Department::find($newdata['id']);
        $department->department_name = $newdata['department_name'];
        $department->save();

        return Redirect::back()->with('success', 'Department updated successfully');
    }

    public function allsection()
    {
        $id = Auth::user()->organisation_id;

        $section = Section::where('organisation_id', '=', $id)
            ->filter(request()->only('search'))
            ->select(['id', 'section_name'])
            ->paginate(10)
            ->withQueryString();
        return Inertia::render('Admin/Allsection', [
            'section' => $section,
            'filters' => request()->all('search')
        ]);
    }

    public function deletesection($id)
    {
        Section::where('id', $id)->delete();
        return Redirect::back()->with('success', 'Section deleted successfully');
    }

    public function updatesection(Request $request)
    {
        $newdata = $request->data;
        $section = Section::find($newdata['id']);
        $section->section_name = $newdata['section_name'];
        $section->save();
        return Redirect::back()->with('success', 'Section updated successfully');
    }

    public function allclass()
    {
        $id = Auth::user()->organisation_id;
        $classes = Classes::where('organisation_id', '=', $id)
            ->filter(request()->only('search'))
            ->select(['id', 'class_name'])
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Allclass', [
            'classes' => $classes,
            'filters' => request()->all('search')
        ]);
    }

    public function deleteclass($id)
    {
        Classes::where('id', $id)->delete();
        return Redirect::back()->with('success', 'class deleted successfully');
    }

    public function updateclass(Request $request)
    {
        $newdata = $request->data;
        $class = Classes::find($newdata['id']);
        $class->class_name = $newdata['class_name'];
        $class->save();
        return Redirect::back()->with('success', 'class updated successfully');
    }

    public function allnotice()
    {
        $id = Auth::user()->organisation_id;
        $notice = Notice::where('organisation_id', '=', $id)
            ->filter(request()->only('search'))
            ->select(['id', 'title', 'description', 'posted_by', 'time', 'teacher', 'student'])
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Allnotice', [
            'notice' => $notice,
            'filters' => request()->all('search')
        ]);
    }

    public function deletenotice($id)
    {
        Notice::where('id', $id)->delete();
        return Redirect::back()->with('success', 'Notice deleted successfully');
    }

    public function updatenotice(Request $request)
    {
        $newdata = $request->data;

        $notice = Notice::find($newdata['id']);
        $notice->title = $newdata['title'];
        $notice->description = $newdata['description'];
        $notice->posted_by = $newdata['posted_by'];
        $notice->time = $newdata['time'];
        $notice->teacher = $newdata['teacher'];
        $notice->student = $newdata['student'];
        $notice->save();
        return Redirect::back()->with('success', 'Notice updated successfully');
    }

}
