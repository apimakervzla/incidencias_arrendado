<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Audit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RedirectsUsers;

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/usersall';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {        
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'string', 'integer'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        //
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->roles()
        ->attach(Role::where('id', $data['role_id'])->first());

            // dd($user->id);
        $rolename=Role::where('id', $data['role_id'])->first();

        $auditoria = new Audit();
        $auditoria->role_user_id = Auth::id();        
        $auditoria->action = "Se creó el Usuario:".$user->name.", con el Rol:".$rolename->description;
        
        $auditoria->save();

        return $user;
    }

    public function form()
    {
        $roles = Role::get();
 
        return view('usuarios.register',['roles'=>$roles]);
    }

    public function edit($user_id)
    {
        $user = User::select(DB::raw('users.id, email, users.name, users.created_at, roles.description, role_user.role_id'))
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->where('users.id',$user_id)
                    ->first();
        $roles = Role::get();        
        // dd($user->role_id);        

        return view('usuarios.edit',['user'=>$user,'roles'=>$roles]);
    }

    public function update(Request $request,$user_id)
    {

        $user = User::where('id', $user_id)->first();

        if (!$user){
            return view('index.users');
        }
        else{
            $user = User::find($user_id)
            ->fill($request->input());
            $user->save();
            $user_up = DB::table('role_user')
                    ->where('user_id', $user_id)
                    ->update(['role_id'=>$request["role_id"]]);

            $rolename=Role::where('id', $data['role_id'])->first();        

            $auditoria = new Audit();
            $auditoria->role_user_id = Auth::id();            
            $auditoria->action = "Se editó el Usuario:".$user->name.", Rol:".$rolename->description;

            $auditoria->save();

            return redirect()->route("index.users");
        }
    }

    public function index()
    {
        $usuarios = User::select(DB::raw('users.id, email, users.name, users.created_at, roles.description, users.status'))
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->orderBy('users.created_at','desc')
                    ->get();       

        // dd($usuarios);
        return view('usuarios.index',['usuarios'=>$usuarios]);        
    }

    public function destroy($user_id)
    {
        
        // $user = User::find($user_id);
        // $user->delete();

        // return redirect()->route("index.users");
    }

    public function status($user_id, $status)
    {
        switch ($status) {
            case 1:
                $user = User::where('id', $user_id)
                        ->update(['status'=>0]);  
                $statusname="Activo";
                         
                break;
            case 0:
                $user = User::where('id', $user_id)
                        ->update(['status'=>1]);   
                $statusname="Inactivo";
                break;
            
            default:
                # code...
                break;                
        }     

        $username=User::where('id', $user_id)->first();        

        $auditoria = new Audit();
        $auditoria->role_user_id = Auth::id();        
        $auditoria->action = "Se cambió el estatus del Usuario:".$username->name.", con el Estatus:".$statusname;

        $auditoria->save();

        return redirect()->route("index.users");
    }
}
