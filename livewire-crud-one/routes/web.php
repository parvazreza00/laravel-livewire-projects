<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::livewire('/', 'post-list')->name('posts');
Route::livewire('/create/post', 'post-form')->name('create-post');
Route::livewire('/post/{post}/view', 'post-form')->name('post.view');
Route::livewire('/post/{post}/edit', 'post-form')->name('post.edit');

Route::livewire('/all-employee', 'employee-list')->name('employees');
Route::livewire('/add-employee', 'employee-form')->name('add.employee');
Route::livewire('/employee/{employee}/edit', 'employee-form')->name('edit.employee');
