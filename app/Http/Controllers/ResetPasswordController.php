<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function show($token)
    {
        $user = User::where('reset_token', $token)
            ->where('reset_token_expires', '>', Carbon::now())
            ->first();

        if (!$user) {
            abort(404, 'Token tidak valid atau kadaluarsa');
        }

        return view('auth.reset_password', compact('token'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('username', $request->username)
            ->where('reset_token', $request->token)
            ->where('reset_token_expires', '>', Carbon::now())
            ->first();

        if (!$user) {
            return back()->withErrors(['Token atau username tidak valid']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'reset_token' => null,
            'reset_token_expires' => null,
        ]);

        return redirect()->route('login')
            ->with('success', 'Password berhasil direset');
    }
}
