<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
// use Illuminate\Support\Facade\Hash;
use Hash;

class UserController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('isAdmin');
        if(\Gate::allows('isAdmin') || \Gate::allows('isAuthor')){
            return User::latest()->paginate(10);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|string|max:191',
            'email'     =>  'required|string|email|max:191|unique:users',
            'password'  =>  'required|string|min:8',
        ]);
        return User::create([
            'name'  =>  $request['name'],
            'email'  =>  $request['email'],
            'type'  =>  $request['type'],
            'bio'  =>  $request['bio'],
            'photo'  =>  $request['photo'],
            'password'  =>  Hash::make($request['password']),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // check if the user with the returned ID exists
        $user = User::findOrFail($id);

        // sanitize the data
        $this->validate($request, [
            'name'      =>  'required|string|max:191',
            'email'     =>  'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'  =>  'sometimes|min:8',
        ]);

        // if last request is true, update user details.
        $user->update($request->all());

        return ['message' => 'User info updated successfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');

        // Pass user ID from view to Model 
        $user = User::findOrFail($id);

        // delete user
        $user->delete();
        
        // If process was successful, send message to view
        return ['message' => 'User Deleted'];
    }

    // fetch logged in user details to populate profile.
    public function profile()
    {
        return auth('api')->user();
       
    }

    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
        $this->authorize('isAdmin');

        // sanitize the data
        $this->validate($request, [
            'name'      =>  'required|string|max:191',
            'email'     =>  'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'  =>  'sometimes|required|min:8',
        ]);        
        $currentPhoto = $user->photo;
        if($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);
        }

        $userPhoto = public_path('img/profile/').$currentPhoto;

        if (file_exists($userPhoto)) {
            @unlink($userPhoto);
        }

        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());
        return ['message' => "Success"];
    }

}
