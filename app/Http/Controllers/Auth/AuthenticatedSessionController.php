<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard');
        }

        if ($user->hasRole('teacher')) {
            return redirect()->route('teacher.dashboard');
        }

        if ($user->hasRole('student')) {
            $student = Student::where('user_id', $user->id)->first();

            // যদি Student রেকর্ডই না থাকে
            if (!$student) {
                auth()->logout();  // Logout the user
                session()->flash('message', 'Your note, our students');  // Flash message
                return redirect()->route('login');
            }

            if ($student->status === 'active') {
                return redirect()->route('student.dashboard');
            } else {
                auth()->logout();  // Logout the user
                session()->flash('message', 'Your note, our students');  // Flash message
                return redirect()->route('login');
            }
        }



        return redirect('/'); // fallback

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
