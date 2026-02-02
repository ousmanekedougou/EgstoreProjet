<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function document(){
        return view('user.document');
    }

    public function conditions(){
        return view('user.conditions');
    }

    public function privacy(){
        return view('user.privacy');
    }
}
