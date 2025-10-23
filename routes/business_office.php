<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessOffice\BusinessOfficeDashboardController;
use App\Http\Controllers\BusinessOffice\ClearanceController;
use App\Http\Controllers\Office\ClearanceApprovalController;

// ✅ All Business Office routes grouped together
Route::prefix('business-office')
    ->middleware(['auth', 'verified'])
    ->name('business_office.')
    ->group(function () {

        /**
         * 🏠 Dashboard
         */
        Route::get('/dashboard', [BusinessOfficeDashboardController::class, 'index'])
            ->name('dashboard');

        // 🚪 Logout
        Route::post('/logout', [BusinessOfficeDashboardController::class, 'logout'])
            ->name('logout');

        /**
         * 📋 Clearance Management (Posting / Activating)
         */
        Route::get('/clearances', [ClearanceController::class, 'index'])
            ->name('clearances.index');

        // ✅ Activate a published clearance (visible to students)
        Route::post('/clearances/{clearance}/activate', [ClearanceController::class, 'activate'])
            ->name('clearances.activate');

        /**
         * 🧾 Clearance Requests Approval (Signing / Holding)
         * — This is where the Business Office signs student requests.
         */
        Route::get('/clearance-requests', [ClearanceApprovalController::class, 'businessOfficeIndex'])
            ->name('clearance_requests.index');

        Route::post('/clearance-requests/{id}/accept', [ClearanceApprovalController::class, 'businessOfficeAccept'])
            ->name('clearance_requests.accept');

        Route::post('/clearance-requests/{id}/hold', [ClearanceApprovalController::class, 'businessOfficeHold'])
            ->name('clearance_requests.hold');
    });
