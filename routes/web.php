<?php

use App\Livewire\Pages\Home;
use App\Livewire\Pages\PostShow;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/posts/{slug}', PostShow::class)->name('posts.show');

Route::get('/about', function() {
    return "about";
})->name('about');
Route::get('/contact', function () {
    return "contact";
})->name('contact');
Route::get('/blog', function () {
    return "blog";
})->name('blog');

Route::get('/login', function () {
    return "login";
})->name('login');

Route::get('/register', function () {
    return "register";
})->name('register');
