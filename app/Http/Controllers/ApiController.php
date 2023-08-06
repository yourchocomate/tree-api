<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function index(Profile $profile)
    {
        return response()->json([
            'user' => [
                'name' => $profile->user->name,
                'email' => $profile->user->email,
                'handle' => $profile->handle,
                'bio' => $profile->bio,
                'avater' => Storage::disk('public')->url($profile->avater),
            ],
            'handles' => [
                'social' => $profile->user->socials,
                'portfolio' => $profile->user->portfolios,
            ]
        ], 200);
    }
}
