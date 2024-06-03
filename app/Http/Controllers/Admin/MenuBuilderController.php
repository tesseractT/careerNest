<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuBuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:menu builder']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.menu-builder.index');
    }
}
