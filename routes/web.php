<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('roles')->name('roles/')->group(static function() {
            Route::get('/',                                             'RolesController@index')->name('index');
            Route::get('/create',                                       'RolesController@create')->name('create');
            Route::post('/',                                            'RolesController@store')->name('store');
            Route::get('/{role}/edit',                                  'RolesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RolesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{role}',                                      'RolesController@update')->name('update');
            Route::delete('/{role}',                                    'RolesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('cities')->name('cities/')->group(static function() {
            Route::get('/',                                             'CitiesController@index')->name('index');
            Route::get('/create',                                       'CitiesController@create')->name('create');
            Route::post('/',                                            'CitiesController@store')->name('store');
            Route::get('/{city}/edit',                                  'CitiesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'CitiesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{city}',                                      'CitiesController@update')->name('update');
            Route::delete('/{city}',                                    'CitiesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('specialties')->name('specialties/')->group(static function() {
            Route::get('/',                                             'SpecialtiesController@index')->name('index');
            Route::get('/create',                                       'SpecialtiesController@create')->name('create');
            Route::post('/',                                            'SpecialtiesController@store')->name('store');
            Route::get('/{specialty}/edit',                             'SpecialtiesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'SpecialtiesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{specialty}',                                 'SpecialtiesController@update')->name('update');
            Route::delete('/{specialty}',                               'SpecialtiesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('exams')->name('exams/')->group(static function() {
            Route::get('/',                                             'ExamsController@index')->name('index');
            Route::get('/create',                                       'ExamsController@create')->name('create');
            Route::post('/',                                            'ExamsController@store')->name('store');
            Route::get('/{exam}/edit',                                  'ExamsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ExamsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{exam}',                                      'ExamsController@update')->name('update');
            Route::delete('/{exam}',                                    'ExamsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('people')->name('people/')->group(static function() {
            Route::get('/',                                             'PersonsController@index')->name('index');
            Route::get('/create',                                       'PersonsController@create')->name('create');
            Route::post('/',                                            'PersonsController@store')->name('store');
            Route::get('/{person}/edit',                                'PersonsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'PersonsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{person}',                                    'PersonsController@update')->name('update');
            Route::delete('/{person}',                                  'PersonsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('type-person-has-people')->name('type-person-has-people/')->group(static function() {
            Route::get('/',                                             'TypePersonHasPersonController@index')->name('index');
            Route::get('/create',                                       'TypePersonHasPersonController@create')->name('create');
            Route::post('/',                                            'TypePersonHasPersonController@store')->name('store');
            Route::get('/{typePersonHasPerson}/edit',                   'TypePersonHasPersonController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TypePersonHasPersonController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{typePersonHasPerson}',                       'TypePersonHasPersonController@update')->name('update');
            Route::delete('/{typePersonHasPerson}',                     'TypePersonHasPersonController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('schedules')->name('schedules/')->group(static function() {
            Route::get('/',                                             'ScheduleController@index')->name('index');
            Route::get('/create',                                       'ScheduleController@create')->name('create');
            Route::post('/',                                            'ScheduleController@store')->name('store');
            Route::get('/{schedule}/edit',                              'ScheduleController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ScheduleController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{schedule}',                                  'ScheduleController@update')->name('update');
            Route::delete('/{schedule}',                                'ScheduleController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('appointments')->name('appointments/')->group(static function() {
            Route::get('/',                                             'AppointmentsController@index')->name('index');
            Route::get('/create',                                       'AppointmentsController@create')->name('create');
            Route::post('/',                                            'AppointmentsController@store')->name('store');
            Route::get('/{appointment}/edit',                           'AppointmentsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'AppointmentsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{appointment}',                               'AppointmentsController@update')->name('update');
            Route::delete('/{appointment}',                             'AppointmentsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('types-of-people')->name('types-of-people/')->group(static function() {
            Route::get('/',                                             'TypesOfPeopleController@index')->name('index');
            Route::get('/create',                                       'TypesOfPeopleController@create')->name('create');
            Route::post('/',                                            'TypesOfPeopleController@store')->name('store');
            Route::get('/{typesOfPerson}/edit',                         'TypesOfPeopleController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TypesOfPeopleController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{typesOfPerson}',                             'TypesOfPeopleController@update')->name('update');
            Route::delete('/{typesOfPerson}',                           'TypesOfPeopleController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('specialists')->name('specialists/')->group(static function() {
            Route::get('/',                                             'SpecialistsController@index')->name('index');
            Route::get('/create',                                       'SpecialistsController@create')->name('create');
            Route::post('/',                                            'SpecialistsController@store')->name('store');
            Route::get('/{specialist}/edit',                            'SpecialistsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'SpecialistsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{specialist}',                                'SpecialistsController@update')->name('update');
            Route::delete('/{specialist}',                              'SpecialistsController@destroy')->name('destroy');
        });
    });
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('store');