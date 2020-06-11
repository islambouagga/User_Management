<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

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
        if (\Gate::allows('isAdmin')  || \Gate::allows('isAuthor')) {
//            return User::latest()->paginate(5);

            $users= User::all()->map(function ($user) {
                $user->isOnline = $user->isOnline();
                return $user;
            });
//            $users = json_decode(json_encode($users));
            return $users;
//            return $userso = (object) $users;
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
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6'
        ]);
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'bio' => $request['bio'],
            'photo' => $request['photo'],
            'password' => Hash::make($request['password'])

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
        $user =  User::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:6'
        ]);

        $user->update($request->all());
        return ['message' => 'Updated the user info'];
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

        $user =  User::findOrFail($id);
        $user->delete();
    }


    public function profile(){
        return auth('api')->user();
    }
    public function updateProfile(Request $request){
        $user =  auth('api')->user();

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:6'
        ]);

        $currentPhoto = $user->photo;


        if($request->photo != $currentPhoto){
         $name = time().'.' . explode('/', explode(':',
                 substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
         \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
//            return ['message',$userPhoto];
            if ($userPhoto!= public_path('img/profile/avatar.png')){
                if(file_exists($userPhoto)){

                    @unlink($userPhoto);
                }
            }

     }
        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());
    }

    public function search(){

        if ($search = \Request::get('q')) {
            $users = index()->where(function($text) use ($search){
                $text->where('name','LIKE',"%$search%")
                    ->orWhere('email','LIKE',"%$search%")
                    ->orWhere('type','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $users= User::all()->map(function ($user) {
                $user->isOnline = $user->isOnline();
                return $user;
            });
            return $users;
        }

        return $users;

    }

}
