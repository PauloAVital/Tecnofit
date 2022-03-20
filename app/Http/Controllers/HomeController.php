<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PersonalController;
use DataTables;
use App\User;

class HomeController extends Controller
{
    private $objuser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->objuser = new User();
        $this->middleware('auth');
        $this->personal = new PersonalController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {    
        $ranking =  $this->personal->ranking();
        return view('home', compact('ranking'));
    }
    
}
