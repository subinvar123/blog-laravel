<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

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
    public function storeroute(LoginRequest $request)
    {
       
        $request->authenticate();

      $request->session()->regenerate();
        $request->user();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
       
        $request->authenticate();

       // $request->session()->regenerate();
        $user=$request->user();
       $user->tokens()->delete();
       $token = $user->createToken('api-token');
       $subscription = $user->subscription;
       return response()->json([
           'user'=>$user,
           'user_id' => $user->id,
           'token' => $token->plainTextToken,
           'subscription' => $subscription

       ]);
        //return redirect()->intended(RouteServiceProvider::HOME);
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



/**
     * Destroy an authenticated session.
     */
    public function destroyroute(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}