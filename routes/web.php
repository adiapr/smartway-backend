<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentationService;
use App\Http\Controllers\Admin\DocumentationSliderController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RentController;
use App\Http\Controllers\Admin\RentDocumentationController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonyVideoController;
use App\Http\Controllers\Admin\WisataController;
use App\Http\Controllers\Admin\WisataDocumemnationController;
use App\Http\Controllers\Admin\WisataDocumentationController;
use App\Http\Controllers\Admin\WisataPriceController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PubllishController;
use App\Http\Controllers\UploadFileCkeditorController;
use App\Models\Documentation;
use App\Models\TestimonyVideo;
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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/update/publish', [PubllishController::class, 'published'])->name('update.publish');

    Route::post('/upload-file-ckeditor', UploadFileCkeditorController::class)->name('admin.upload-file-ckeditor');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // tours 
    Route::resource('/paket-wisata', WisataController::class);

    // tours schedule 
    Route::get('/paket-wisata-schedule/{uuid}', [WisataController::class, 'schedule'])->name('paket-wisata.schedule');
    Route::post('/paket-wisata-schedule/{uuid}', [WisataController::class, 'store_schedule'])->name('paket-wisata.schedule.store');
    Route::delete('/paket-wisata-schedule/{id}', [WisataController::class, 'destroy_schedule'])->name('paket-wisata.schedule.destroy');
    Route::get('/paket-wisata-schedule/{uuid}/{id}/edit', [WisataController::class, 'edit_schedule'])->name('paket-wisata.schedule.edit');
    Route::post('/paket-wisata-schedule/{id}/update', [WisataController::class, 'update_schedule'])->name('paket-wisata.schedule.update');

    // Tour price 
    Route::get('/paket-wisata-price/{uuid}', [WisataPriceController::class, 'index'])->name('paket-wisata.price');
    Route::post('/paket-wisata-price/{uuid}', [WisataPriceController::class, 'store'])->name('paket-wisata.price.store');
    Route::delete('/paket-wisata-price/{id}', [WisataPriceController::class, 'destroy'])->name('paket-wisata.price.destroy');
    Route::put('/paket-wisata-price/{id}/update', [WisataPriceController::class, 'update'])->name('paket-wisata.price.update');

    // Tour documentation 
    Route::get('/paket-wisata-documentation/{uuid}', [WisataDocumentationController::class, 'index'])->name('paket-wisata.documentation');
    Route::post('/paket-wisata-documentation/{id}', [WisataDocumentationController::class, 'store'])->name('paket-wisata.documentation.store');
    Route::delete('/paket-wisata-documentation/{id}/delete', [WisataDocumentationController::class, 'destroy'])->name('paket-wisata.documentation.destroy');

    // rent car 
    Route::resource('/rent-car', RentController::class);
    Route::get('/rent-car-documentation/{id}', [RentDocumentationController::class, 'index'])->name('rent.documentation.index');
    Route::post('/rent-car-documentation/{id}', [RentDocumentationController::class, 'store'])->name('rent.documentation.store');

    // article
    Route::resource('/article', ArticleController::class);
    Route::post('upload',[CKEditorController::class, 'uploadFile'])->name('upload');
    Route::get('article-publish/{id}', [ArticleController::class, 'publish'])->name('admin.article.publish');
    Route::get('article-reject/{id}', [ArticleController::class, 'reject'])->name('admin.article.reject');

    // content
    Route::prefix('/content')->name('content.')->group( function () {
        Route::resource('/slider', SliderController::class); 
        Route::resource('/testimony', TestimonyVideoController::class);
    });

    // Order 
    Route::resource('/order', OrderController::class);

    // FAQ 
    Route::resource('/faq', FaqController::class);

    // Documentation  service
    Route::resource('/documentation', DocumentationService::class);
    Route::get('/documentation-slider/{documentation_id}',  [DocumentationSliderController::class, 'index'])->name('documentation.slider.index');
    Route::post('/documentation-slider/{documentation_id}',  [DocumentationSliderController::class, 'store'])->name('documentation.slider.store');
    Route::get('/documentation-result/{documentation_id}',  [DocumentationSliderController::class, 'result'])->name('documentation.result.index');
    Route::post('/documentation-result/{documentation_id}',  [DocumentationSliderController::class, 'store_result'])->name('documentation.result.store');
    Route::post('/documentation-header/{documentation_id}',  [DocumentationSliderController::class, 'store_header'])->name('documentation.header.store');
    Route::get('/documentation-price/{documentation_id}',  [DocumentationSliderController::class, 'price'])->name('documentation.price.index');
    Route::post('/documentation-price/{documentation_id}',  [DocumentationSliderController::class, 'update_or_create_price'])->name('documentation.price.store');
    Route::delete('/documentation-price/{documentation_id}',  [DocumentationSliderController::class, 'delete_price'])->name('documentation.price.delete');

});

require __DIR__.'/auth.php';
