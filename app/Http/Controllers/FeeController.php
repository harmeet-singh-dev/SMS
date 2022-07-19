<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Fees;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FeeController extends Controller
{
    //index
    public function index()
    {

        $fees = Fees::where('organisation_id', Auth::user()->organisation_id)
            ->with('class', 'section', 'student')
            ->filter(request()->only('search'))
            ->with('class', 'section', 'student')
            ->paginate(10)
            ->withQueryString();


        return Inertia::render('Admin/fees/index', [
            'fees' => $fees,
            'filters' => request()->all('class', 'section', 'student'),
        ]);
    }

    //create
    public function create()
    {
        $id = Auth::user()->organisation_id;
        $classes = Classes::where('organisation_id',$id)->select(['id','class_name'])->get();
        $section = Section::where('organisation_id',$id)->select(['id','section_name'])->get();
        $users_data = User::where('organisation_id',$id)->where('user_type','2')->select(['id','first_name','last_name','email'])->get();
        $father_data = User::where('user_type','3')->select(['child_id','first_name','last_name','email'])->get();
        $fee_interval = Fees::FEE_INTERVAL;
        return Inertia::render('Admin/fees/create',compact('classes','section','users_data', 'father_data','fee_interval'));
    }

    public function edit(Fees $fee)
    {

        $id = Auth::user()->organisation_id;
        $classes = Classes::where('organisation_id', $id)->select(['id', 'class_name'])->get();
        $section = Section::where('organisation_id', $id)->select(['id', 'section_name'])->get();
        $users_data = User::where('organisation_id', $id)->where('user_type', '2')->select([
            'id', 'first_name', 'last_name', 'email'
        ])->get();
        $father_data = User::where('user_type', '3')->select(['child_id', 'first_name', 'last_name', 'email'])->get();
        $fee_interval = Fees::FEE_INTERVAL;
         return Inertia::render('Admin/fees/edit', [
             'fee' => $fee->toArray(),
             'classes' => $classes,
             'section' => $section,
             'users_data' => $users_data,
             'father_data' => $father_data,
             'fee_interval' => $fee_interval
        ]);
    }

    //store
    public function store(Request $request)
    {
        $data = $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'student_id' => 'required',
            'father_name' => 'required',
            'payment_method' => 'required',
            'receipt_number' => '',
            'fees_submition_date' => 'required',
            'fee_deposit_interval' => 'required',
            'addmission_fee' => '',
            'tution_fee' => '',
            'sports_fee' => '',
            'hostel_fee' => '',
            'food_fee' => '',
            'transpotation_fee' => '',
            'activity_fees' => '',
            'extra_class_fees' => '',
            'others' => '',
            'penality' => '',
            'pending_due' => '',
            'fee_month' => '',
            'total_fee' => 'required',
            'note' => '',
        ]);

        $data['organisation_id'] = Auth::user()->organisation_id;

        Fees::create($data);
        return redirect()->route('fees.index')->with('success','Fee Added Successfully');
    }


    //update
    public function update(Request $request,Fees $fee){
        $data = $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'student_id' => 'required',
            'father_name' => 'required',
            'payment_method' => 'required',
            'receipt_number' => '',
            'fees_submition_date' => 'required',
            'fee_deposit_interval' => 'required',
            'addmission_fee' => '',
            'tution_fee' => '',
            'sports_fee' => '',
            'hostel_fee' => '',
            'food_fee' => '',
            'transpotation_fee' => '',
            'activity_fees' => '',
            'extra_class_fees' => '',
            'others' => '',
            'penality' => '',
            'pending_due' => '',
            'fee_month' => '',
            'total_fee' => 'required',
            'note' => '',
        ]);

        $data['organisation_id'] = Auth::user()->organisation_id;

        $fee->update($data);

        return redirect()->route('fees.index')->with('success','Fee Updated Successfully');
    }


    public function destroy(Fees $fee)
    {
        $fee->delete();
        return Redirect::back()->with('success', 'Fee deleted successfully');
    }
}
