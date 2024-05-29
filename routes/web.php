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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PDFController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});
 
Route::get('welcome', function () {
    return redirect()->route('login'); 
})->name('welcome');

Auth::routes();

Route::controller(AuthController::class)->group(function () {
    Route::middleware(['redirectIfAuthenticated'])->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('login', 'loginAction')->name('login.action');
    });

    Route::post('logout', 'logout')->middleware('auth')->name('logout');
});

/*
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginAction'])->name('login.action');
  
    Route::middleware('auth')->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });
});
*/


Route::fallback(function () {
    return redirect()->route('dashboard');
});

// Admin Routes
Route::middleware(['auth', 'user-role:admin', 'auto-logout'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');
 
    Route::get("/admin/home", [HomeController::class, 'adminHome'])->name('home.admin');

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
        Route::delete('college/{collegeID}', 'destroyForever')->name('college.destroyForever');

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
        Route::delete('research/{researchID}', 'destroyForever')->name('research.destroyForever');
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
        Route::delete('roles/{roleID}', 'destroyForever')->name('roles.destroyForever');
    });

    Route::controller(RoleResearchAssignedController::class)->prefix('roleresearchassigned')->group(function () {
        Route::get('', 'index')->name('roleresearchassigned.modal');
        Route::post('save', 'save')->name('roleresearchassigned.save');
        Route::patch('roleresearchassigned/{assignedID}/{researchID}', [RoleResearchAssignedController::class, 'update'])->name('roleresearchassigned.update');
        Route::delete('destroy/{assignedID}', 'destroy')->name('roleresearchassigned.destroy');
        Route::delete('destroyMultiple', 'destroyMultiple')->name('roleresearchassigned.destroyMultiple');
        Route::post('unarchive/{assignedID}', 'unarchive')->name('roleresearchassigned.unarchive');
        Route::post('roleresearchassigned/unarchiveMultiple', 'unarchiveMultiple')->name('roleresearchassigned.unarchiveMultiple');
        Route::delete('roleresearchassigned/{assignedID}', 'destroyForever')->name('roleresearchassigned.destroyForever');

    });

    Route::controller(ResearcherController::class)->prefix('researcher')->group(function () {
        Route::get('', 'index')->name('researcher');
        Route::get('index', 'index')->name('researcher.index');
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
        Route::delete('researcher/{researcherID}', 'destroyForever')->name('researcher.destroyForever');

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
        Route::delete('agency/{agencyID}', 'destroyForever')->name('agency.destroyForever');

    });

    Route::controller(MonitoringsController::class)->prefix('monitorings')->group(function () {
        Route::get('', 'index')->name('monitorings.modal');
        Route::post('save', 'save')->name('monitorings.save');
        Route::patch('monitorings/{monitoringID}', 'update')->name('monitorings.update');
        Route::delete('destroy/{monitoringID}', 'destroy')->name('monitorings.destroy');
        Route::delete('destroyMultiple', 'destroyMultiple')->name('monitorings.destroyMultiple');
        Route::post('unarchive/{monitoringID}', 'unarchive')->name('monitorings.unarchive');
        Route::post('monitorings/unarchiveMultiple', 'unarchiveMultiple')->name('monitorings.unarchiveMultiple');
        Route::delete('monitorings/{monitoringID}', 'destroyForever')->name('monitorings.destroyForever');

    });

    Route::controller(ExternalFundsController::class)->prefix('externalfunds')->group(function () {
        Route::get('', 'index')->name('externalfunds.modal');
        Route::post('save', 'save')->name('externalfunds.save');
        Route::patch('externalfunds/{exFundID}', 'update')->name('externalfunds.update');
        Route::delete('destroy/{exFundID}', 'destroy')->name('externalfunds.destroy');
        Route::delete('destroyMultiple', 'destroyMultiple')->name('externalfunds.destroyMultiple');
        Route::post('unarchive/{exFundID}', 'unarchive')->name('externalfunds.unarchive');
        Route::post('externalfunds/unarchiveMultiple', 'unarchiveMultiple')->name('externalfunds.unarchiveMultiple');
        Route::delete('externalfunds/{exFundID}', 'destroyForever')->name('externalfunds.destroyForever');

    });

});

Route::middleware(['auth', 'auto-logout'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/save', [ProfileController::class, 'save'])->name('profile.save');
    Route::get('generate-pdf/{id}', [PDFController::class, 'generatePDF'])->name('generate-pdf');

    Route::controller(CollegeController::class)->prefix('college')->group(function () {
        Route::get('', 'index')->name('college');
        Route::get('show/{collegeID}', 'show')->name('college.show');
        Route::get('restore', 'restore')->name('college.restore');

    });

    Route::controller(ResearchController::class)->prefix('research')->group(function () {
        Route::get('', 'index')->name('research');
        Route::get('show/{researchID}', 'show')->name('research.show');
        Route::get('restore', 'restore')->name('research.restore');

    });

    Route::controller(RolesController::class)->prefix('roles')->group(function () {
        Route::get('', 'index')->name('roles');
        Route::get('show/{roleID}', 'show')->name('roles.show');
        Route::get('restore', 'restore')->name('roles.restore');

    });

    Route::controller(ResearcherController::class)->prefix('researcher')->group(function () {
        Route::get('', 'index')->name('researcher');
        Route::get('index', 'index')->name('researcher.index');
        Route::get('show/{researcherID}', 'show')->name('researcher.show');
        Route::get('restore', 'restore')->name('researcher.restore');

    });


    Route::controller(AgencyController::class)->prefix('agency')->group(function () {
        Route::get('', 'index')->name('agency');
        Route::get('show/{agencyID}', 'show')->name('agency.show');
        Route::get('restore', 'restore')->name('agency.restore');

    });


});