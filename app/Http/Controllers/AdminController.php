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

    public function dashboard(Request $request){
      $user_type = Auth::user()->user_type;


      if($user_type == '0'){
      $Data = User::where('user_type', '=', '1')->count();
      return Inertia::render('Admin/Dashboard',compact('Data'));
       }
       if($user_type == '1'){
       return Inertia::render('Admin/OwnerDashboard');
       }
    }
    public function createclasspro(Request $request){
      $id = Auth::user()->organisation_id;
     $this->validate($request, [
        'name' => 'required',
      ]);

          $class = new Classes;
          $class->class_name = $request->name;
          $class->organisation_id = $id;
          $class->save();
          return response()->json([
              'success' => 'Done'
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

   if($users['user_type'] == '1' || $users['user_type'] == '5'){
         $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
         ]);

        if($users['organisation_id']== 0){
         User::create([
             'organisation_id' => $id,
             'user_type' => '5',
            'first_name'=>$request->get('first_name'),
            'last_name'=>$request->get('last_name'),
            'email'=>$request->get('email'),
            'password'=>bcrypt('12345678'),
      ]);

        return response()->json([
              'success' => 'Done'
          ]);
     }else{
          User::create([
             'organisation_id' => $users['organisation_id'],
             'user_type' => '5',
            'first_name'=>$request->get('first_name'),
            'last_name'=>$request->get('last_name'),
            'email'=>$request->get('email'),
            'password'=>bcrypt('12345678'),
      ]);

        return response()->json([
              'success' => 'Done'
          ]);
     }}else{
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
         if($users['user_type'] == '1' || $users['user_type'] == '2'){
        $request->validate([
            'name' => 'required',

         ]);


     if($users['organisation_id']== 0){
         Section::create([
             'organisation_id' => $id,
              'section_name'=>$request->get('name'),
         ]);
          return response()->json([
              'success' => 'Done'
          ]);
        }else{

            Section::create([
             'organisation_id' => $users['organisation_id'],
              'section_name'=>$request->get('name'),
         ]);
 return response()->json([
              'success' => 'Done'
          ]);
        }


    }else{
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
           if($users['user_type'] == '1' || $users['user_type'] == '2'){
         $request->validate([
            'title' => 'required',
            'description' => 'required',
            'posted_by' => 'required',
      ]);


   if($users['organisation_id']== 0){
         Notice::create([
             'organisation_id' => $id,
              'title'=>$request->get('title'),
              'description'=>$request->get('description'),
              'posted_by'=>$request->get('posted_by'),
              'student'=>$request->get('student'),
              'teacher'=>$request->get('teacher'),
              'time'=>$request->get('time'),
         ]);
        }else{

            Notice::create([
             'organisation_id' => $users['organisation_id'],
              'title'=>$request->get('title'),
              'description'=>$request->get('description'),
              'posted_by'=>$request->get('posted_by'),
              'student'=>$request->get('student'),
              'teacher'=>$request->get('teacher'),
              'time'=>$request->get('time'),
         ]);

        }
      }else{
        return Inertia::render('/');
      }
    }

    public function student()
    {
       $id = Auth::user()->id;
      $users = User::find($id);
    if($users['user_type'] == '1' || $users['user_type'] == '2'){
    if($users['organisation_id']== 0){
    $users = User::find($id);
    $Classes = Classes::where('organisation_id', '=', $id)
        ->get();
     $Section = Section::where('organisation_id', '=', $id)
        ->get();
      return Inertia::render('Admin/Createstudent',['Classesdata'=>$Classes,'Sectiondata'=>$Section]);

        }else{

     $users = User::find($id);
     $Classes = Classes::where('organisation_id', '=', $users['organisation_id'])
        ->get();
     $Section = Section::where('organisation_id', '=', $users['organisation_id'])
        ->get();
     return Inertia::render('Admin/Createstudent',['Classesdata'=>$Classes,'Sectiondata'=>$Section]);

    }}else{
       return Inertia::render('/');
    }
    }

    public function studentpost(Request $request)
    {
        $id = Auth::user()->id;
        $users = User::find($id);
        if($users['user_type'] == '1' || $users['user_type'] == '2'){
         $request->validate([ 'first_name' => 'required',
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
                          'pincode' => 'required'
                        ]);


     if($users['organisation_id']== 0){

     $users = User::find($id);
     $classes = Classes::where('organisation_id', '=', $id)
        ->get(['name']);
     $section = Section::where('organisation_id', '=', $id)
        ->get(['section_name']);

     $user = User::create(['organisation_id'=>$id,
                      'user_type'=>'2',
                      'first_name'=>$request->get('first_name'),
                      'last_name'=>$request->get('last_name'),
                      'email'=>$request->get('email'),
                      'password'=>bcrypt('12345678'),
                     ]);
      $lastinsertid = $user->id;

        Student::create(['organisation_id'=>$id,
                      'user_id'=>$lastinsertid,
                      'unique_id'=>$request->get('unique_id'),
                      'gender'=>$request->get('gender'),
                      'dob'=>$request->get('dob'),
                      'roll'=>$request->get('roll'),
                      'blood_group'=>$request->get('blood_group'),
                      'religion'=>$request->get('religion'),
                      'class'=>$request->get('classname'),
                      'section'=>$request->get('section'),
                      'admission'=>$request->get('admission'),
                      'phone'=>$request->get('phone'),
                      'address'=>$request->get('address'),
                      'city'=>$request->get('city'),
                      'state'=>$request->get('state'),
                      'pincode'=>$request->get('pincode'),
                      'country'=>$request->get('country'),
                      'father_name'=>$request->get('father_name'),
                      'mother_name'=>$request->get('mother_name'),

                       ]);
                       return response()->json([
              'success' => 'Done'
          ]);


    }else{

     $users = User::find($id);
     $classes = Classes::where('organisation_id', '=', $users['organisation_id'])
        ->get(['name']);
     $section = Section::where('organisation_id', '=', $users['organisation_id'])
        ->get(['section_name']);

     $user = User::create(['organisation_id'=>$users['organisation_id'],
                      'user_type'=>'2',
                      'first_name'=>$request->get('first_name'),
                      'last_name'=>$request->get('last_name'),
                      'email'=>$request->get('email'),
                      'password'=>bcrypt('12345678'),
                     ]);
      $lastinsertid = $user->id;

        Student::create(['organisation_id'=>$users['organisation_id'],
                      'user_id'=>$lastinsertid,
                      'gender'=>$request->get('gender'),
                      'unique_id'=>$request->get('unique_id'),
                      'dob'=>$request->get('dob'),
                      'roll'=>$request->get('roll'),
                      'blood_group'=>$request->get('blood_group'),
                      'religion'=>$request->get('religion'),
                      'class'=>$request->get('classname'),
                      'section'=>$request->get('section'),
                      'admission'=>$request->get('admission'),
                      'phone'=>$request->get('phone'),
                      'address'=>$request->get('address'),
                      'city'=>$request->get('city'),
                      'state'=>$request->get('state'),
                      'country'=>$request->get('country'),
                      'pincode'=>$request->get('pincode'),
                      'father_name'=>$request->get('father_name'),
                      'mother_name'=>$request->get('mother_name'),

                       ]);

                       return response()->json([
              'success' => 'Done'
          ]);

        }
      }else{
       return Inertia::render('/');

      }
    }

    public function department()
    {
       $id = Auth::user()->id;
       $users = User::find($id);

   if($users['user_type'] == '1' || $users['user_type'] == '2'){
        return Inertia::render('Admin/Createdepartment');
    }else{
   return Inertia::render('/');
    }
    }

    public function departmentpost(Request $request)
    {
      $id = Auth::user()->id;
         $users = User::find($id);

   if($users['user_type'] == '1' || $users['user_type'] == '2'){

       if($users['organisation_id']== 0){
          Department::create(['organisation_id'=>$id,'department_name'=>$request->name]);
           return response()->json([
              'success' => 'Done'
          ]);
        }else{

          Department::create(['organisation_id'=>$users['organisation_id'],'department_name'=>$request->name]);
          return response()->json([
              'success' => 'Done'
          ]);
        }
        }else{
     return Inertia::render('/');
   }
    }

  public function teacher()
  {
     $id = Auth::user()->id;
    $users = User::find($id);
    if($users['user_type'] == '1' || $users['user_type'] == '2'){
    if($users['organisation_id']== 0){
    $users = User::find($id);
    $Department = Department::where('organisation_id', '=', $id)->get();

       return Inertia::render('Admin/Createteacher',['Departmentdata'=>$Department]);
    }else{
    $Department = Department::where('organisation_id', '=', $users['organisation_id'])->get();
        return Inertia::render('Admin/Createteacher',['Departmentdata'=>$Department]);
    }

    }else{
 return Inertia::render('/');
    }
  }


  public function teacherpost(Request $request)
  {
     $request->validate([ 'first_name' => 'required',
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
                          'pincode' => 'required'
                        ]);
        $id = Auth::user()->id;
        $users = User::find($id);
 if($users['user_type'] == '1' || $users['user_type'] == '2'){
     if($users['organisation_id']== 0){


     $user = User::create(['organisation_id'=>$id,
                      'user_type'=>'4',
                      'first_name'=>$request->get('first_name'),
                      'last_name'=>$request->get('last_name'),
                      'email'=>$request->get('email'),
                      'password'=>bcrypt('12345678'),
                     ]);
      $lastinsertid = $user->id;

        Teacher::create(['organisation_id'=>$id,
                      'user_id'=>$lastinsertid,
                      'gender'=>$request->get('gender'),
                      'dob'=>$request->get('dob'),
                      'spouse_name'=>$request->get('spouse_name'),
                      'blood_group'=>$request->get('blood_group'),
                      'religion'=>$request->get('religion'),
                      'phone'=>$request->get('phone'),
                      'address'=>$request->get('address'),
                      'city'=>$request->get('city'),
                      'state'=>$request->get('state'),
                      'department_id'=>$request->get('department'),
                      'country'=>$request->get('country'),
                      'pincode'=>$request->get('pincode'),
                      'father_name'=>$request->get('father_name'),
                      'mother_name'=>$request->get('mother_name'),
                      'description'=>$request->get('description'),
                       ]);
   return response()->json([
              'success' => 'Done'
          ]);

    }else{

     $users = User::find($id);

     $user = User::create(['organisation_id'=>$users['organisation_id'],
                      'user_type'=>'4',
                      'first_name'=>$request->get('first_name'),
                      'last_name'=>$request->get('last_name'),
                      'email'=>$request->get('email'),
                      'password'=>bcrypt('12345678'),
                     ]);
      $lastinsertid = $user->id;

        Teacher::create(['organisation_id'=>$users['organisation_id'],
                      'user_id'=>$lastinsertid,
                      'gender'=>$request->get('gender'),
                      'dob'=>$request->get('dob'),
                      'spouse_name'=>$request->get('spouse_name'),
                      'blood_group'=>$request->get('blood_group'),
                      'department_id'=>$request->get('department'),
                      'religion'=>$request->get('religion'),
                      'description'=>$request->get('description'),
                      'phone'=>$request->get('phone'),
                      'address'=>$request->get('address'),
                      'city'=>$request->get('city'),
                      'pincode'=>$request->get('pincode'),
                      'state'=>$request->get('state'),
                      'country'=>$request->get('country'),
                      'father_name'=>$request->get('father_name'),
                      'mother_name'=>$request->get('mother_name'),

                       ]);
   return response()->json([
              'success' => 'Done'
          ]);
        }
  }else{
    return Inertia::render('/');
  }
 }

 public function class_teacher()
 {
            $id = Auth::user()->id;
         $users = User::find($id);

   if($users['user_type'] == '1' || $users['user_type'] == '2'){

     if($users['organisation_id']== 0){
     $teacher = User::where('organisation_id',$id)
        ->where('user_type','4')
        ->select('id','first_name','last_name')
        ->get();
     $class = Classes::where('organisation_id',$id)
       ->select('id','class_name')
        ->get();
     $section = Section::where('organisation_id',$id)
       ->select('id','section_name')
        ->get();
        $department = Department::where('organisation_id',$id)
       ->select('id','department_name')
        ->get();

        return Inertia::render('Admin/Createclassteacher',['classdata'=>$class,'sectiondata'=>$section,'teacherdata'=>$teacher,'departmentdata'=>$department]);
     }else{

 $teacher = User::where('organisation_id',$users['organisation_id'])
        ->where('user_type','4')
        ->select('id','first_name','last_name')
        ->get();
     $class = Classes::where('organisation_id',$users['organisation_id'])
       ->select('id','class_name')
        ->get();
     $section = Section::where('organisation_id',$users['organisation_id'])
       ->select('id','section_name')
        ->get();
        $department = Department::where('organisation_id',$id)
       ->select('id','department_name')
        ->get();


   return Inertia::render('Admin/Createclassteacher',['classdata'=>$class,'sectiondata'=>$section,'teacherdata'=>$teacher,'departmentdata'=>$department]);
 }
}
else{
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
            $request->validate([ 'name' => 'required',
                      ]);
             if($users['user_type'] == '1' || $users['user_type'] == '2'){
          if($users['organisation_id']== 0){

 Subject::create(['subject_name' => $request->name,'organisation_id'=>$id]);

 return response()->json([
              'success' => 'Done'
          ]);


          }else{

Subject::create(['subject_name' => $request->name,'organisation_id'=>$users['organisation_id']]);

 return response()->json([
              'success' => 'Done'
          ]);

          }
            }else{
             return Inertia::render('/');
             }

}

  public function fees()
  {
    return Inertia::render('Admin/Createfees');
  }

  public function classteacherpost()
  {

  }
}
