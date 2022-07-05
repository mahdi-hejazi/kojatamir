<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            User::all()
        ]);
    }
    public function show($id)
    {
        $user = user::find($id);
        if(!$user ){
            return response()->json([
                'status' => 'error',
                'message' => 'User Not Found.',
            ]);}
        else{
            return response()->json([
                $user
            ]);}
    }
    public function destroy($id)
    {
        $delete_user = User::findOrfail($id);
        $delete_user->delete();

        /*if(!$delete_user){return response()->json([
               'status' => 'error',
               'message' => 'There is an error while deleting user.'
       ]);
        } */
        return response()->json([
            'status' => 'done',
            'message' => 'User Deleted successfully.',
        ]);


    }
    public function update(Request $request , $id)
    {
        $validatedData = $request->validate([
            //'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
            'family' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $this_user = User::find($id);
        $this_user->name = $validatedData['name'];
        $this_user->family = $validatedData['family'];
        $this_user->email = $validatedData['email'];
        $this_user->phone = $validatedData['phone'];
        $this_user->password = $validatedData['password'];

        $getImage = $request->file('profile_image');
        $imageName = time().'.'.$getImage->extension();
        $imagePath = public_path(). '/images/user_profiles';
        $getImage->move($imagePath, $imageName);

        $this_user->profile_image = '/images/user_profiles/'.$imageName;
        //todo delete previous image


        $this_user->save();



        return response()->json([
            'status' => 'done',
            'message' => 'User Updated Successfully.',
        ]);


    }
}
