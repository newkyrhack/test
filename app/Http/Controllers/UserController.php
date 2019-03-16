<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Storage;
use Image;

class UserController extends Controller
{
    public function showUsers(Request $request){
        return view('index');
    }

    public function getUser(Request $request){
        $user = User::find($request->id);
        return response()->json($user,200);
    }

    public function addUser(UserRequest $request){
        try{
            $user = new User();
            $user->nombre = $request->nombre;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->roll = $request->roll;
            if($request->file('foto')){
                $imagePath = $request->file('foto')->store('users');
                $image = Image::make(Storage::get($imagePath))->widen(300, function ($constraint) {
                    $constraint->upsize();
                })->encode(null,50);
                Storage::put($imagePath,$image);
                $user->foto = $imagePath;
            }
            $user->save();
            return 1;
        }
        catch(Exception $e){
            return 0;
        }
    }

    public function editUser(UserEditRequest $request){
        try{
            $user = User::find($request->id);
            $user->nombre = $request->nombre;
            $user->email = $request->email;
            if($request->password!=""){
                $user->password = bcrypt($request->password);
            }
            $user->roll = $request->roll;
            if($request->file('foto')){
                $imagePath = $request->file('foto')->store('users');
                $image = Image::make(Storage::get($imagePath))->widen(300, function ($constraint) {
                    $constraint->upsize();
                })->encode(null,50);
                Storage::put($imagePath,$image);
                $user->foto = $imagePath;
            }
            $user->save();
            return 1;
        }
        catch(Exception $e){
            return 0;
        }
    }

    public function deleteUser(Request $request){
        try{
            User::find($request->id)->delete();
            return 1;
        }
        catch(Exception $e){
            return 0;
        }
    }

    public function getUsers(Request $request){
        $nombre = $request->header('nombre');
        $roll = $request->header('roll');
        if($nombre!='' && $roll!=''){
            $users = User::where(['nombre'=>$nombre,'roll'=>$roll])->paginate(2);
        }
        else if($nombre!=''){
            $users = User::where('nombre',$nombre)->paginate(2);
        }
        else if($roll!=''){
            $users = User::where('roll',$roll)->paginate(2);
        }
        else{
            $users = User::paginate(2);
        }
        return $users;
    }

    public function rollUsers(Request $request){
        $users = User::where('roll',$request->roll)->get();
        return $users;
    }
}
