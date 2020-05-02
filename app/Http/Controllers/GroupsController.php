<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class GroupsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:groups"
        ]);

       return Group::create($request->all());
    }
}
