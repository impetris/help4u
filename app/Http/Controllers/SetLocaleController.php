<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetLocaleController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'locale' => 'required|in:de-CH,it-CH,fr-CH,en-GB',
        ]);

        if (Auth::user()) {
            $user = Auth::user();
            $user->locale = $request->locale;
            $user->save();
        } else {
            session(['locale' => $request->locale]);
        }
    }
}
