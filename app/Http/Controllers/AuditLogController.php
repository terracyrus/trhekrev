<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $paginate = 15;

        // Admin sieht alle Logs, Operator sieht Operator/User Logs, User sieht nur seine eigenen
        if ($user->isAdmin()) {
            $logs = AuditLog::with('user')->orderByDesc('created_at')->paginate($paginate);
        } elseif ($user->isOperator()) {
            $logs = AuditLog::with('user')
                ->whereIn('visibility', ['operator'])
                ->orderByDesc('created_at')
                ->paginate($paginate);
        } else {
            $logs = AuditLog::with('user')
                ->where('user_id', $user->id)
                ->orderByDesc('created_at')
                ->paginate($paginate);
        }

        return view('audit.index', ['logs' => $logs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AuditLog $auditLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AuditLog $auditLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AuditLog $auditLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuditLog $auditLog)
    {
        //
    }
}
