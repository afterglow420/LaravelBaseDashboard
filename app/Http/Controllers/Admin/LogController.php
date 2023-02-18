<?php

namespace App\Http\Controllers\Admin;

use App\Models\Logs\LogModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index()
    {
        return view('Admin.Logs.LogsIndex_View', ['logs' => LogModel::all()]);
    }

    public static function logManager($action, $model)
    {
        $userId = Auth::id() ? Auth::id() : 0;

        LogModel::logAction($userId, $action, $model);
    }
}
