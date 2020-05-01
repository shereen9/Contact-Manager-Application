<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:groups"
        ]);
    }
}
