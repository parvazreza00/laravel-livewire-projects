<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::livewire('/', 'post-list')->name('posts');
Route::livewire('/create/post', 'post-form')->name('create-post');
Route::livewire('/post/{post}/view', 'post-form')->name('post.view');
Route::livewire('/post/{post}/edit', 'post-form')->name('post.edit');
