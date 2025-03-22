<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $students = [
            [
                'name' => 'Samantha William',
                'class' => 'Class VII A',
                'avatar' => 'SW'
            ],
            [
                'name' => 'Tony Soap',
                'class' => 'Class VII A',
                'avatar' => 'TS'
            ],
            [
                'name' => 'Karen Hope',
                'class' => 'Class VII A',
                'avatar' => 'KH'
            ],
            [
                'name' => 'Jordan Nico',
                'class' => 'Class VII B',
                'avatar' => 'JN'
            ],
            [
                'name' => 'Nadila Adja',
                'class' => 'Class VII B',
                'avatar' => 'NA'
            ],
        ];

        return view('dashboard', compact('students'));
    }
}
