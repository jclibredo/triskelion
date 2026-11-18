<?php

use App\Models\Chapter;
use App\Models\Council;
use App\Models\Event;
use App\Models\Member;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $events = Event::where('status', true)
        ->orderBy('eventdate', 'asc')
        ->take(3)
        ->get();

    $posts = Post::where('status', true)
        ->latest()
        ->take(3)
        ->get();

    $stats = [
        'members' => Member::count(),
        'chapters' => Chapter::where('status', true)->count(),
        'councils' => Council::where('status', true)->count(),
    ];
    return view('welcome', compact('events', 'posts', 'stats'));
});
