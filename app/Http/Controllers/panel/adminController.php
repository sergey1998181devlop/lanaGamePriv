<?php

namespace  App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('rule:1');
    }

    public function index()
    {
        return view('admin.home');
    }
}
