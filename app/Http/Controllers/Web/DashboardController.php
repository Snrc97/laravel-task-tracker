<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class DashboardController extends WebControllerBase
{

    public function index(Request $request)
    {
        return view('vendor.Snrc97.pages.dashboard.index');
    }

    public function register(Request $request, $params = null)
    {

        return view('vendor.Snrc97.pages.register.index');
    }

    public function login(Request $request, $params = null)
    {

        return view('vendor.Snrc97.pages.login.index');
    }

    public function projects(Request $request, $params = null )
    {
        return view('vendor.Snrc97.pages.dashboard.projects.index', ['params' => $params]);
    }

    public function tasks(Request $request, $params = null)
    {
        return view('vendor.Snrc97.pages.dashboard.tasks.index', ['params' => $params]);
    }
}
