<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private string $admin_slug ;
    private array $role_ids;
    private $user_roles;

    public function __construct()
    {   $this->admin_slug = env('ADMINISTRATOR', 'admin');
        $this->user_roles = UserRole::where('role', '!=', $this->admin_slug)->get();
        $this->role_ids = $this->user_roles->pluck('id')->all();

    }
     /*
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Get all users except current admin. ! Add test users to the user table!!!
         */

        // $users  = User::where('id', '!=', Auth::user()->id)
        //                 ->whereHas('userRole', function ($query) use ($admin_slug) {
        //                            $query->where('role', '!=', $admin_slug);
        //                             })
        //                 ->with('userRole')
        //                 ->get();
        $users = User::where('id', '!=', Auth::user()->id)
        ->with('userRole')
        ->get();

         $roles = $this->user_roles ;

        return view('users.index', compact('users', 'roles'));

    }

    public function update(Request $request, User $user)
    {
        if (is_null($request->role))
        {
            $user->update(['user_role_id'=>Null]);
        } else {

             // Validate and update user data here
            $data = $request->validate([
                'role' =>
                          ['required',
                            Rule::in($this->role_ids),
                          ]
                  ]) ;


            //$user->user_role_id = $data['role']; $user->save();
            $user->update(['user_role_id'=> $data['role']??Null]);
        }
            return redirect()->back()->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( User $user)
    {
        $user->delete();

        return redirect()->back()->with(
            'success',
            'User removed.'
        );
    }
}
