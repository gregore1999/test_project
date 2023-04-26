<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user()) {
            abort(401, 'Unauthorized');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
     
        if (Auth::attempt($credentials)) {
            
            $user = Auth::user();
            $token = $user->createToken('MyApp')->plainTextToken;
            auth()->login($user);
            return view('dashboard')->with('token', $token);
        }
       
        return redirect()->route('login')->with('error', 'Invalid email or password');
    }
    public function test(Request $request){
        return 'ohhhh yeah';
    }
    public function register(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
      
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        


        $response['message'] = "registration was successful";
    return response($response,200);;
    }


  public function getEvents(Request $request)
    {    
      $user = Auth::user();
      return $user->events;
    }


    public function getAllInformation(Request $request)
    {    
      $user = Auth::user();
      $events = $user->events;
      
    foreach( $events as $event){
        $response['data']['events'][]= $event;
      foreach ($event->topics as $topic) {
        $response['data']['events']['topics']= $topic;
    }
    
    foreach ($event->lessons as $lesson) {
        $response['data']['events']['topics']= $lesson;
    }
    
    foreach ($event->instructors as $instructor) {
        $response['data']['events']['topics']= $instructor;
    }
  
    }
    $response['message'] = 'OK';
    return response($response,200);
}
}
