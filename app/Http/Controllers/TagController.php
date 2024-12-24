<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    // this method allowing the class to be called as a single action controller without the need to specify it in the route
    public function __invoke(Tag $tag)
    {
        // jobs associated for this tag

        return view('results', ['jobs' => $tag->jobs]);
    }
}
