<?php

namespace App\Http\Controllers\Inbox;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('inbox.index');
    }
}
