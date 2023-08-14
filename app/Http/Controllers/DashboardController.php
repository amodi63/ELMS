<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke() {
        $employees = User::employees()->count();
        $data = [
            'employees_count' => $employees
        ];
        return view("dashboard.index", $data);
    }
}
