<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class DashboardController extends WebControllerBase
{

    public function index()
    {
        return view('vendor.Snrc97.pages.dashboard.index');
    }

    public function register()
    {
        return view('vendor.Snrc97.pages.register.index');
    }

    public function login()
    {
        return view('vendor.Snrc97.pages.login.index');
    }

    public function projects()
    {
        return view('vendor.Snrc97.pages.projects.index');
    }

    public function tasks()
    {
        return view('vendor.Snrc97.pages.tasks.index');
    }
}
