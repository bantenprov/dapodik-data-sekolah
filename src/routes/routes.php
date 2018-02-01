<?php

Route::group(['prefix' => 'dd-sekolah', 'middleware' => ['web']], function() {

    $controllers = (object) [
        'index'     => 'Bantenprov\DDSekolah\Http\Controllers\DDSekolahController@index',
        'create'     => 'Bantenprov\DDSekolah\Http\Controllers\DDSekolahController@create',
        'store'     => 'Bantenprov\DDSekolah\Http\Controllers\DDSekolahController@store',
        'show'      => 'Bantenprov\DDSekolah\Http\Controllers\DDSekolahController@show',
        'update'    => 'Bantenprov\DDSekolah\Http\Controllers\DDSekolahController@update',
        'destroy'   => 'Bantenprov\DDSekolah\Http\Controllers\DDSekolahController@destroy',
    ];

    Route::get('/',$controllers->index)->name('dd-sekolah.index');
    Route::get('/create',$controllers->create)->name('dd-sekolah.create');
    Route::post('/store',$controllers->store)->name('dd-sekolah.store');
    Route::get('/{id}',$controllers->show)->name('dd-sekolah.show');
    Route::put('/{id}/update',$controllers->update)->name('dd-sekolah.update');
    Route::post('/{id}/delete',$controllers->destroy)->name('dd-sekolah.destroy');

});

