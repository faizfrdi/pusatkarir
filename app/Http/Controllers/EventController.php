<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // Menampilkan daftar event
    public function index()
    {
        $events = Event::latest()->paginate(9);
        return view('community.events', compact('events'));
    }

    // Menampilkan detail event
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('community.event-detail', compact('event'));
    }
}