<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveRequestController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'login');
/* Begin Employee Routes */
Route::group(['middleware'=>'auth'], function(){
    Route::get('/home', DashboardController::class)->name('dashboard');
    
    Route::get('employees/list', [EmployeeController::class, 'getEmployees'])->name('employees.list');
    // Route::get('employees/trashed-list', [EmployeeController::class, 'getTrashedEmployees'])->name('employees.trashed-list');
    // Route::get('employees/trash', [EmployeeController::class, 'trash'])->name('employees.trash');
    // Route::put('employees/{employee}/restore', [EmployeeController::class, 'restore'])->name('employees.restore');
    // Route::delete('employees/{employee}/force-delete', [EmployeeController::class, 'forceDelete'])->name('employees.force-delete');
    Route::get('employees/leave-requests/list/{employee?}', [LeaveRequestController::class, 'getEmployeeRequest'])->name('employee.leaveRequests.list');
    Route::get('employee/leave-requests/{employee?}', [LeaveRequestController::class, 'show'])->name('employee.leaveRequests.show');
    Route::post('employee/leave-request/store', [LeaveRequestController::class, 'store'])->name('employee.leaveRequests.store');
    Route::post('employee/leave-request/change-leave-request-status', [LeaveRequestController::class, 'changeLeaveRequestStatus'])->name('employee.leaveRequests.changeLeaveRequestStatus');
    Route::resource('employees', EmployeeController::class);
    Route::resource('employee.leave-request', LeaveRequestController::class)->except(['show','store']);
    
    /* End Employee Routes */
});