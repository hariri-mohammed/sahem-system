<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ActivityController;
use App\Http\Controllers\Manager\OrganizationController;
use App\Http\Middleware\CheckManagerAuth;
use App\Http\Controllers\Auth\ManagerAuthController;
use App\Http\Controllers\Manager\ManagerProfileController;

// Auth routes (outside middleware)
Route::get('/manager/login', [ManagerAuthController::class, 'showLogin'])->name('manager.login');
Route::post('/manager/login', [ManagerAuthController::class, 'login'])->name('manager.login.post');
Route::get('/manager/logout', [ManagerAuthController::class, 'logout'])->name('manager.logout');

Route::middleware([CheckManagerAuth::class])->prefix('manager')->name('manager.')->group(function () {
    // لوحة تحكم المدير
    Route::get('/dashboard', [ActivityController::class, 'dashboard'])->name('dashboard');



    // الملف الشخصي للمدير
    Route::get('/profile', [ManagerProfileController::class, 'profile'])->name('profile');
    // تعديل الملف الشخصي للمدير
    Route::get('/profile/edit', [ManagerProfileController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/edit', [ManagerProfileController::class, 'updateProfile'])->name('profile.update');



    // الفعاليات ادارة
    Route::get('/activities', [ActivityController::class, 'getActivities'])->name('activities.index');
    // عرض تفاصيل الفعالية
    Route::get('/activities/view/{id}', [ActivityController::class, 'viewActivity'])->name('activities.view');
    // إضافة فعاليات جديدة
    Route::get('/activities/add', [ActivityController::class, 'addActivity'])->name('activities.add');
    Route::post('/activities/add', [ActivityController::class, 'storeActivity'])->name('activities.store');
    // تعديل الفعاليات
    Route::get('/activities/edit/{id}', [ActivityController::class, 'editActivity'])->name('activities.edit');
    Route::put('/activities/edit/{id}', [ActivityController::class, 'updateActivity'])->name('activities.update');
    // حذف الفعاليات
    Route::delete('/activities/{id}', [ActivityController::class, 'destroyActivity'])->name('activities.destroy');
    // عملية النشر والإلغاء
    Route::post('/activities/toggle-publish/{id}', [ActivityController::class, 'togglePublish'])->name('activities.togglePublish');



    // الجمعيات
    Route::get('/organizations', [OrganizationController::class, 'getOrganizations'])->name('organizations.index');
    //عرض تفاصيل الجمعية
    Route::get('/organizations/view/{id}', [OrganizationController::class, 'viewOrganization'])->name('organizations.show');
    // إضافة جمعيات جديدة
    Route::get('/organizations/create', [OrganizationController::class, 'addOrganization'])->name('organizations.add');
    Route::post('/organizations/create', [OrganizationController::class, 'storeOrganization'])->name('organizations.store');
    // تعديل بيانات الجمعية
    Route::get('/organizations/{id}/edit', [OrganizationController::class, 'editOrganization'])->name('organizations.edit');
    Route::put('/organizations/{id}', [OrganizationController::class, 'updateOrganization'])->name('organizations.update');
    // حذف الجمعية
    Route::delete('/organizations/{id}', [OrganizationController::class, 'destroyOrganization'])->name('organizations.destroy');


    // الفعاليات الخاصة بالجمعيات
    Route::get('/organizations/{orgId}/events', [OrganizationController::class, 'getEvents'])->name('organizations.events.index');
    // اضافة فعالية جديدة للجمعية
    Route::get('/organizations/{orgId}/events/create', [OrganizationController::class, 'createEvent'])->name('organizations.events.create');
    Route::post('/organizations/{orgId}/events', [OrganizationController::class, 'storeEvent'])->name('organizations.events.store');
    // عرض تفاصيل الفعالية للجمعية
    Route::get('/events/{id}', [OrganizationController::class, 'viewEvent'])->name('organizations.events.show');
    // تعديل فعالية الجمعية للجمعية
    Route::get('/events/{id}/edit', [OrganizationController::class, 'editEvent'])->name('organizations.events.edit');
    Route::put('/events/{id}', [OrganizationController::class, 'updateEvent'])->name('organizations.events.update');
    // حذف فعالية الجمعية للجمعية
    Route::delete('/events/{id}', [OrganizationController::class, 'destroyEvent'])->name('organizations.events.destroy');
});
