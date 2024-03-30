<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\RoleResearchAssignedController;
use App\Http\Controllers\ResearcherController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\MonitoringsController;
use App\Http\Controllers\ExternalFundsController;


Route::get('/', function () {
    return view('welcome');
});
 
Route::get('welcome', function () {
    return view('welcome');
})->name('welcome');

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
  
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
  
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
  
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
 
    Route::controller(CollegeController::class)->prefix('college')->group(function () {
        Route::get('', 'index')->name('college');
        Route::get('create', 'create')->name('college.create');
        Route::post('store', 'store')->name('college.store');
        Route::get('show/{collegeID}', 'show')->name('college.show');
        Route::get('edit/{collegeID}', 'edit')->name('college.edit');
        Route::put('edit/{collegeID}', 'update')->name('college.update');
        Route::delete('destroy/{collegeID}', 'destroy')->name('college.destroy');
        Route::get('restore', 'restore')->name('college.restore');
        Route::post('unarchive/{collegeID}', 'unarchive')->name('college.unarchive');
        Route::delete('destroyMultiple', 'destroyMultiple')->name('college.destroyMultiple');
        Route::post('college/unarchiveMultiple', 'unarchiveMultiple')->name('college.unarchiveMultiple');

    });

    Route::controller(ResearchController::class)->prefix('research')->group(function () {
        Route::get('', 'index')->name('research');
        Route::get('create', 'create')->name('research.create');
        Route::post('store', 'store')->name('research.store');
        Route::get('show/{researchID}', 'show')->name('research.show');
        Route::get('edit/{researchID}', 'edit')->name('research.edit');
        Route::put('edit/{researchID}', 'update')->name('research.update');
        Route::delete('destroy/{researchID}', 'destroy')->name('research.destroy');
        Route::get('restore', 'restore')->name('research.restore');
        Route::post('unarchive/{researchID}', 'unarchive')->name('research.unarchive');
        Route::delete('destroyMultiple', 'destroyMultiple')->name('research.destroyMultiple');
        Route::post('research/unarchiveMultiple', 'unarchiveMultiple')->name('research.unarchiveMultiple');
    });

    Route::controller(RolesController::class)->prefix('roles')->group(function () {
        Route::get('', 'index')->name('roles');
        Route::get('create', 'create')->name('roles.create');
        Route::post('store', 'store')->name('roles.store');
        Route::get('show/{roleID}', 'show')->name('roles.show');
        Route::get('edit/{roleID}', 'edit')->name('roles.edit');
        Route::put('edit/{roleID}', 'update')->name('roles.update');
        Route::delete('destroy/{researchID}', 'destroy')->name('roles.destroy');
        Route::get('restore', 'restore')->name('roles.restore');
        Route::post('unarchive/{roleID}', 'unarchive')->name('roles.unarchive');
        Route::delete('destroyMultiple', 'destroyMultiple')->name('roles.destroyMultiple');
        Route::post('roles/unarchiveMultiple', 'unarchiveMultiple')->name('roles.unarchiveMultiple');
    });

    Route::controller(RoleResearchAssignedController::class)->prefix('roleresearchassigned')->group(function () {
        Route::get('', 'index')->name('roleresearchassigned.modal');
        Route::post('save', 'save')->name('roleresearchassigned.save');
        Route::patch('roleresearchassigned/{assignedID}/{researchID}', [RoleResearchAssignedController::class, 'update'])->name('roleresearchassigned.update');
        Route::delete('destroy/{assignedID}', 'destroy')->name('roleresearchassigned.destroy');
        Route::post('unarchive/{assignedID}', 'unarchive')->name('roleresearchassigned.unarchive');

    });

    Route::controller(ResearcherController::class)->prefix('researcher')->group(function () {
        Route::get('', 'index')->name('researcher');
        Route::get('create', 'create')->name('researcher.create');
        Route::post('store', 'store')->name('researcher.store');
        Route::get('show/{researcherID}', 'show')->name('researcher.show');
        Route::get('edit/{researcherID}', 'edit')->name('researcher.edit');
        Route::put('edit/{researcherID}', 'update')->name('researcher.update');
        Route::delete('destroy/{researcherID}', 'destroy')->name('researcher.destroy');
        Route::get('restore', 'restore')->name('researcher.restore');
        Route::post('unarchive/{researcherID}', 'unarchive')->name('researcher.unarchive');
        Route::delete('destroyMultiple', 'destroyMultiple')->name('researcher.destroyMultiple');
        Route::post('researcher/unarchiveMultiple', 'unarchiveMultiple')->name('researcher.unarchiveMultiple');

    });


    Route::controller(AgencyController::class)->prefix('agency')->group(function () {
        Route::get('', 'index')->name('agency');
        Route::get('create', 'create')->name('agency.create');
        Route::post('store', 'store')->name('agency.store');
        Route::get('show/{agencyID}', 'show')->name('agency.show');
        Route::get('edit/{agencyID}', 'edit')->name('agency.edit');
        Route::put('edit/{agencyID}', 'update')->name('agency.update');
        Route::delete('destroy/{agencyID}', 'destroy')->name('agency.destroy');
        Route::get('restore', 'restore')->name('agency.restore');
        Route::post('unarchive/{agencyID}', 'unarchive')->name('agency.unarchive');
        Route::delete('destroyMultiple', 'destroyMultiple')->name('agency.destroyMultiple');
        Route::post('agency/unarchiveMultiple', 'unarchiveMultiple')->name('agency.unarchiveMultiple');

    });

    Route::controller(MonitoringsController::class)->prefix('monitorings')->group(function () {
        Route::get('', 'index')->name('monitorings.modal');
        Route::post('save', 'save')->name('monitorings.save');
    });

    Route::controller(ExternalFundsController::class)->prefix('externalfunds')->group(function () {
        Route::get('', 'index')->name('externalfunds.modal');
        Route::post('save', 'save')->name('externalfunds.save');
    });

    
    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/save', [App\Http\Controllers\ProfileController::class, 'save'])->name('profile.save');

});