<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Auth;

class AdminnewController extends Controller
{
 public function allsubadmin()
  {
     $id = Auth::user()->organisation_id;
      $sub_admins = User::where('organisation_id', '=', $id)
          ->where('user_type', '=', 5)
          ->with('permission')
          ->get(['id', 'first_name', 'last_name', 'email']);

      //loop through the sub admin and check if permission is set
        foreach ($sub_admins as $sub_admin) {
            if ($sub_admin->permission === null) {
                $sub_admin->permission()->create([
                    'user_id' => $sub_admin->id,
                    'organisation_id' => $id,
                ]);
            }
        }


     return Inertia::render('Admin/Allsubadmin',compact('sub_admins'));
  }

    public function updateSubAdmin(Request $request,User $user)
    {
        $data = $request->data;
        $user->update($data);

        return Redirect::back()->with('success', 'Permission updated successfully');

    }

  public function updateSubAdminPermission(Request $request,User $user)
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



}
