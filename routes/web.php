<?php
/**
 * Menu Status
 */
Route::patch('gallery-status/{id}', 'GalleryController@status')->name('gallery-status');
/**
 * Menu itens
 */
Route::patch('gallery-order/{id}', 'GalleryController@reOrder')->name('gallery-order');
/**
 * Menu Crud
 */
Route::resource('gallery', 'GalleryController');
/**
 * Templates
 */
Route::resource('gallery-template', 'GalleryTemplateController');