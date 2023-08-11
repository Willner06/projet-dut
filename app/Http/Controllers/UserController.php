<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::get();
        $id=1;
        $roles = Role::all();
        return view('user.create', compact('users','id','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required|string',
            'prenom'=>'required|string',
            'fonction'=>'required|string',
            'email'=>'required|string|unique:users',
            'password'=>'required|string|min:4',
            'password_confirm' =>'required|same:password',
            'roles'=> 'required',
        ]);

        if (!Str::endsWith($request->email, '@jobs-conseil.com')) {
            return back()->withErrors(['email' => 'L\'adresse email doit se terminer par "@jobs-conseil.com"']);
        }

        $user = new User();
        $user->nom= $request->nom;
        $user->email= $request->email;
        $user->prenom= $request->prenom;
        $user->fonction= $request->fonction;
        $user->password= Hash::make($request->password);
        $user->save();

        $user->assignRole($request->input('roles'));

        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     $request->session()->regenerate();

        //     return redirect()->intended('home')->with('message','Bienvenue');
        // }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');

        return redirect()->back()->with('message','Utilisateur enregistré avec success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all();
        $logs=Log::orderBy('created_at','DESC')->where('user_id',$user->id)->get();
        return view('user.show', compact('user','roles','logs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, User $user)
    {
        $user->nom= $request->nom;
        $user->prenom= $request->prenom;
        $user->fonction= $request->fonction;
        $user->email= $request->email;

        // Detach a single role from the user...
$user->roles()->detach();

        $user->assignRole($request->input('roles'));
        $user->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
         $user->delete();
         return redirect()->route('user.index')->with('message','Utilisateur supprimé avec succes');
    }


    public function login(){
        return view('user.login');
    }


    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = ['email'=>$request->email,
                        'password'=>$request->password,
    ];

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            $log = new Log;
            $log->date=date('d-m-Y');
            $log->heure=date('H:i:s');
            $log->login=true;
            $log->user_id=Auth::user()->id;
            $log->save();

            return redirect()->intended('home')->with('message','bienvenue '.Auth::user()->nom." ".Auth::user()->prenom);

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');


    }

    public function logout(Request $request)
    {
        $log = new Log;
            $log->date=date('d-m-Y');
            $log->heure=date('H:i:s');
            $log->login=false;
            $log->user_id=Auth::user()->id;
            $log->save();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function infoAuthenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = ['email'=>$request->email,
                        'password'=>$request->password,
    ];

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            $log = new Log;
            $log->date=date('d-m-Y');
            $log->heure=date('H:i:s');
            $log->login=true;
            $log->user_id=Auth::user()->id;
            $log->save();

            return redirect()->back()->with('message','bienvenue '.Auth::user()->nom." ".Auth::user()->prenom);

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');


    }

    public function resetPassword(Request $request, User $user){
        $request->validate([
            'password'=>'required|string|min:4',
            'password_confirm' =>'required|same:password',
        ]);

        $user->password= Hash::make($request->password);
        $user->update();

        return redirect()->back()->with('message', 'Mot de passe modifié avec succè');
    }

}
