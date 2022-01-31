<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\City;
use App\Models\Person;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register', [
            'cities' => City::orderBy('name')->get()
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'identification' => ['required', 'string', 'max:10',Rule::unique('persons','identification')],
            'telephone' =>['required', 'string','max:10'],
            'address' => ['required','string'],
            'email' => ['sometimes', 'email',  Rule::unique('admin_users', 'email'), 'string'],//'unique:users'
            'birthday'=> ['required', 'date'],
            'gender'=> ['required','string'],
            'id_cities' => ['required','string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // $user = User::create([//AdminUser
        $user = array(//AdminUser
            // 'name' => $request->name,
            // 'email' => $request->email,
            // 'password' => Hash::make($request->password),
            "first_name"=> $request->first_name,
            "last_name"=> $request->last_name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "forbidden" => false,
            "language" =>  "es",
            "activated" => true,
            "roles"=>['paciente'],
        );
        // $table->string('identification',10)->unique();
        //     $table->string('telephone');
        //     $table->string('address');
        //     $table->string('gender');
        $person = array(
            "firt_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email, 
            "birthday" => $request->birthday,
            "identification" => $request->identification,
            "telephone" => $request->telephone,
            "address" => $request->address,
            "birthday" => $request->birthday,
            "gender" => $request->gender,
            "id_cities" => $request->id_cities,
        );
        
        $adminUser =AdminUser::create($user);
        $personSave =Person::create($person);
        $adminUser->roles()->sync(collect($request->input('roles', []))->map->id->toArray());
        
        // event(new Registered($user));
        event(new Registered($adminUser));
        //Auth::login($user);
        Auth::login($adminUser);

        return redirect(RouteServiceProvider::HOME);
    }
}
