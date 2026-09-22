<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\AdminActivity;

class AdminActivityController extends Controller
{
    public function index()
    {
        $query = AdminActivity::latest('performed_at');

        if (! auth()->user()->isSuperAdmin()) {
            $query->where('user_id', auth()->id());
        }

        $activities = AdminTable::paginate($query, ['name', 'email', 'module', 'action', 'description'], 'activities', 10);

        return view('admin.activities.index', compact('activities'));
    }
}
