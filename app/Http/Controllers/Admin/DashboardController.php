<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;

class DashboardController extends Controller
{
    public function index(){
        $movies=Movie::orderBy('featured','DESC')->orderBy('created_at','DESC')->get();
        
        return view('admin.dashboard',['movies'=>$movies]);
    }
}
