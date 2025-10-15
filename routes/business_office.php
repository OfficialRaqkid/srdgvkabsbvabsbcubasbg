<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessOffice\BusinessOfficeDashboardController;
use App\Http\Controllers\BusinessOffice\ClearanceController;
use App\Http\Controllers\Office\ClearanceApprovalController; // 👈 Add this line

// ✅ All Business Office routes grouped together
Route::prefix('business-office')
    ->middleware(['auth', 'verified'])
    ->name('business_office.')
    ->group(function () {

        // 🏠 Dashboard
        Route::get('/dashboard', [BusinessOfficeDashboardController::class, 'index'])
            ->name('dashboard');

        Route::post('logout', [BusinessOfficeDashboardController::class, 'logout'])
            ->name('logout');

        // 📋 Clearances
        Route::get('/clearances', [ClearanceController::class, 'index'])
            ->name('clearances.index');

        // ✅ Activate published clearance (visible to students)
        Route::post('/clearances/{clearance}/activate', [ClearanceController::class, 'activate'])
            ->name('clearances.activate');

        // 🧾 Clearance Requests Approval (Accounting Flow)
        Route::get('/clearance-requests', [ClearanceApprovalController::class, 'accountingIndex'])
            ->name('clearances.requests.index');

        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'accountingAccept'])
            ->name('clearances.requests.accept');

        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'accountingHold'])
            ->name('clearances.requests.hold');
    });
