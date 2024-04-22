<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::latest()->paginate(9);
        return view('notes.index', [
            'notes' => $notes,
        ]);
    }
}
