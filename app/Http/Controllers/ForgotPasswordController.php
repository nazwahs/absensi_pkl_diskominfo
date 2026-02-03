<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
        ]);

        $token = Str::random(6);

        $user = User::where('username', $request->username)->first();

        $user->update([
            'reset_token' => $token,
            'reset_token_expires' => Carbon::now()->addMinutes(30),
        ]);

        return redirect()
            ->route('password.reset', $token)
            ->with('success', 'Token berhasil dibuat, silakan reset password');
    }
}
