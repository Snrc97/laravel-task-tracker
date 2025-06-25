<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class DashboardController extends WebControllerBase
{

    public function index(Request $request, ...$params = [])
    {
        return view('vendor.Snrc97.pages.dashboard.index', compact('params'));
    }

    public function register(Request $request, ...$params = [])
    {
        return view('vendor.Snrc97.pages.register.index');
    }

    public function login(Request $request, ...$params = [])
    {
        return view('vendor.Snrc97.pages.login.index');
    }

    public function projects(Request $request, ...$params = [])
    {
        return view('vendor.Snrc97.pages.projects.index', compact('params'));
    }

    public function tasks(Request $request, ...$params = [])
    {
        return view('vendor.Snrc97.pages.tasks.index', compact('params'));
    }
}
