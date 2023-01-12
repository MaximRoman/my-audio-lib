<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminsController extends Controller 
{
    public function getAdminInfo() {
        $userId = null;
        $admin = false;

        if (Auth::user()) {
            $userId = Auth::user()->id;
            if (DB::table('admin')->where('user_id', $userId)->get()->first()) {
                $admin = true;
            }
        }
        return [
            'admin' => $admin
        ];
    }
}
