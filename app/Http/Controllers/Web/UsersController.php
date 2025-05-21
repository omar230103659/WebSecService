<?php
namespace App\Http\Controllers\Web;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use DB;
use Artisan;
use Carbon\Carbon;


use App\Mail\VerificationEmail;
use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller {

	use ValidatesRequests;

    public function list(Request $request) {
        if(!auth()->user()->hasPermissionTo('show_users'))abort(401);
        $query = User::select('*');
        $query->when($request->keywords, 
        fn($q)=> $q->where("name", "like", "%$request->keywords%"));
        $users = $query->get();
        return view('users.list', compact('users'));
    }

	public function register(Request $request) {
        return view('users.register');
    }

    public function doRegister(Request $request) {

    	try {
    		$this->validate($request, [
	        'name' => ['required', 'string'],
	        'email' => ['required', 'email', 'unique:users'],
	        'password' => ['required'],
	    	]);
    	}
    	catch(\Exception $e) {
    		return redirect()->back()->withInput($request->only('name', 'email'))->withErrors($e->getMessage());
    	}

    	
    	$user =  new User();
	    $user->name = $request->name;
	    $user->email = $request->email;
	    $user->password = bcrypt($request->password); //Secure
	    $user->save();

        $title = "Verification Link";
        $token = Crypt::encryptString(json_encode(['id' => $user->id, 'email' => $user->email]));
        $link = route("verify", ['token' => $token]);
        try {
            \Log::info('Attempting to send verification email to: ' . $user->email);
            Mail::to($user->email)->send(new VerificationEmail($link, $user->name));
            \Log::info('Successfully sent verification email');
        } catch (\Exception $e) {
            \Log::error('Failed to send verification email: ' . $e->getMessage());
            return redirect('/')->with('message', 'Registration complete. If you did not receive an email, please check your spam folder or contact support.');
        }
        return redirect('/');

    }

    public function login(Request $request) {
        return view('users.login');
    }

    public function doLogin(Request $request) {
    	
    	if(!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            return redirect()->back()->withInput($request->only('email'))->withErrors('Invalid login information.');

        $user = User::where('email', $request->email)->first();
        Auth::setUser($user);

        if(!$user->email_verified_at) {
            Auth::logout();
            $encodedEmail = rawurlencode($request->email);
            return redirect()->back()
                ->withInput(['email' => $request->email])
                ->withErrors('Your email is not verified. <a href="' . route('resend.verification', ['email' => $encodedEmail]) . '">Click here to resend verification email</a>');
        }

        return redirect('/');
    }

    public function doLogout(Request $request) {
    	
    	Auth::logout();

        return redirect('/');
    }

    public function profile(Request $request, User $user = null) {

        $user = $user??auth()->user();
        if(auth()->id()!=$user->id) {
            if(!auth()->user()->hasPermissionTo('show_users')) abort(401);
        }

        $permissions = [];
        foreach($user->permissions as $permission) {
            $permissions[] = $permission;
        }
        foreach($user->roles as $role) {
            foreach($role->permissions as $permission) {
                $permissions[] = $permission;
            }
        }

        return view('users.profile', compact('user', 'permissions'));
    }

    public function edit(Request $request, User $user = null) {
   
        $user = $user??auth()->user();
        if(auth()->id()!=$user?->id) {
            if(!auth()->user()->hasPermissionTo('edit_users')) abort(401);
        }
    
        $roles = [];
        foreach(Role::all() as $role) {
            $role->taken = ($user->hasRole($role->name));
            $roles[] = $role;
        }

        $permissions = [];
        $directPermissionsIds = $user->permissions()->pluck('id')->toArray();
        foreach(Permission::all() as $permission) {
            $permission->taken = in_array($permission->id, $directPermissionsIds);
            $permissions[] = $permission;
        }      

        return view('users.edit', compact('user', 'roles', 'permissions'));
    }

    public function save(Request $request, User $user) {

        if(auth()->id()!=$user->id) {
            if(!auth()->user()->hasPermissionTo('show_users')) abort(401);
        }

        $user->name = $request->name;
        $user->save();

        if(auth()->user()->hasPermissionTo('admin_users')) {

            $user->syncRoles($request->roles);
            $user->syncPermissions($request->permissions);

            Artisan::call('cache:clear');
        }

        //$user->syncRoles([1]);
        //Artisan::call('cache:clear');

        return redirect(route('profile', ['user'=>$user->id]));
    }

    public function delete(Request $request, User $user) {

        if(!auth()->user()->hasPermissionTo('delete_users')) abort(401);

        //$user->delete();

        return redirect()->route('users');
    }

    public function editPassword(Request $request, User $user = null) {

        $user = $user??auth()->user();
        if(auth()->id()!=$user?->id) {
            if(!auth()->user()->hasPermissionTo('edit_users')) abort(401);
        }

        return view('users.edit_password', compact('user'));
    }

    public function savePassword(Request $request, User $user) {

        if(auth()->id()==$user?->id) {
            
            $this->validate($request, [
                'password' => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()->symbols()],
            ]);

            if(!Auth::attempt(['email' => $user->email, 'password' => $request->old_password])) {
                
                Auth::logout();
                return redirect('/');
            }
        }
        else if(!auth()->user()->hasPermissionTo('edit_users')) {

            abort(401);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect(route('profile', ['user'=>$user->id]));
    }

    public function verify(Request $request) {
   
        $decryptedData = json_decode(Crypt::decryptString($request->token), true);
        $user = User::find($decryptedData['id']);
        if(!$user) abort(401);
        $user->email_verified_at = Carbon::now();
        $user->save();

        return view('users.verified', compact('user'));
    }

    public function redirectToGoogle()
    {
        \Log::info('Google redirect URL: ' . config('services.google.redirect'));
        
        return Socialite::driver('google')
            ->stateless()
            ->redirectUrl(config('services.google.redirect'))
            ->redirect();
    }

    public function handleGoogleCallback() {
        try {
            \Log::info('Entering Google callback method');
            
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();
            
            \Log::info('Google login successful: ' . $googleUser->email);
            
            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);
            
            Auth::login($user);
            return redirect('/');
        } catch (\Exception $e) {
            \Log::error('Google login failed: ' . $e->getMessage());
            \Log::error('Google login failure trace: ' . $e->getTraceAsString());
            return redirect('/login')->with('error', 'Google login failed: ' . $e->getMessage());
        }
    }

    public function resendVerification(Request $request) {
        $email = urldecode($request->query('email'));
        
        if (!$email) {
            return redirect()->route('login')
                ->withErrors('Email parameter is missing. Please try logging in again.');
        }
        
        \Log::info('Attempting to find user with email: ' . $email);
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            \Log::info('No user found with email: ' . $email);
            return redirect()->route('login')
                ->withErrors('User not found with email: ' . $email)
                ->withInput(['email' => $email]); 
        }
        
        $token = Crypt::encryptString(json_encode(['id' => $user->id, 'email' => $user->email]));
        $link = route("verify", ['token' => $token]);
        
        try {
            \Log::info('Attempting to send verification email to: ' . $user->email);
            Mail::to($user->email)->send(new VerificationEmail($link, $user->name));
            \Log::info('Successfully sent verification email');
        } catch (\Exception $e) {
            \Log::error('Failed to send verification email: ' . $e->getMessage());
            return redirect('/')->with('message', 'Registration complete. If you did not receive an email, please check your spam folder or contact support.');
        }
        
        return redirect()->route('login')
            ->with('success', 'Verification email has been resent to ' . $email . '. Please check your inbox.')
            ->withInput(['email' => $email]);
    }

    public function someMethod(Request $request) {
        \Log::info('Starting method execution');
        

        
        \Log::info('Method completed');
        return view('your.view');
    }

} 