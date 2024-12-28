<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Auth;
class LoginController extends Controller
{


    public function index()
    {
      return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
    
            // Redirect based on user role
            switch ($user->role) {
                case 'admin':
                    $redirectUrl = route('admin.dashboard');
                    break;
                case 'mentor':
                    $redirectUrl = route('mentor.dashboard');
                    break;
                case 'mentee':
                    $redirectUrl = route('mentee.dashboard');
                    break;
                default:
                    Auth::logout();
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid Detail. Contact The Management',
                    ], 403);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Login successful.',
                'redirect_url' => $redirectUrl,
            ]);
        }
    
        // Invalid credentials
        return response()->json([
            'success' => false,
            'message' => 'Invalid email or password.',
        ], 401);
    }
    
    
    
      // Logout method
      public function logout(Request $request)
      {
          auth()->logout();
      
          $request->session()->invalidate();
          $request->session()->regenerateToken();
      
          return redirect('/login'); // Redirect to the home page
      }
      
}