<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function index(Profile $profile)
    {
        $skills = $profile->user->skills()->where('status', 1)->get(['id', 'label', 'icon', 'tooltip', 'description', 'url', 'created_at']);
        $socials = $profile->user->socials()->where('status', 1)->get(['id', 'name', 'url', 'icon', 'created_at']);
        $portfolios = $profile->user->portfolios()->where('status', 1)->get(['id', 'label', 'icon', 'tooltip', 'description', 'url', 'created_at']);

        return response()->json([
            'user' => [
                'name' => $profile->user->name,
                'email' => $profile->user->email,
                'handle' => $profile->handle,
                'bio' => $profile->bio,
                'avater' => Storage::disk('public')->url($profile->avater),
            ],
            'handles' => [
                'skill' => $skills,
                'social' => $socials,
                'portfolio' => $portfolios,
            ]
        ], 200);
    }
}
