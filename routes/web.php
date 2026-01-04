<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\PostShow;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Posts\Index as PostsIndex;
use App\Livewire\Admin\Posts\Create as PostsCreate;
use App\Livewire\Admin\Posts\Edit as PostsEdit;
use App\Livewire\Admin\Categories\Index as CategoriesIndex;
use App\Livewire\Admin\Tags\Index as TagsIndex;

use App\Livewire\TestLivewire;

Route::get('/test-livewire', TestLivewire::class);

// Public routes
Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/posts/{slug}', PostShow::class)->name('posts.show');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', Dashboard::class)->name('admin.dashboard');
    
    // Posts
    Route::get('/posts', PostsIndex::class)->name('admin.posts.index');
    Route::get('/posts/create', PostsCreate::class)->name('admin.posts.create');
    Route::get('/posts/{id}/edit', PostsEdit::class)->name('admin.posts.edit');
    
    // Categories
    Route::get('/categories', CategoriesIndex::class)->name('admin.categories.index');
    
    // // Tags
    Route::get('/tags', TagsIndex::class)->name('admin.tags.index');
    
    // // Contacts
    // Route::get('/contacts', ContactsIndex::class)->name('admin.contacts.index');
    
    // // Subscribers
    // Route::get('/subscribers', SubscribersIndex::class)->name('admin.subscribers.index');
});

require __DIR__.'/auth.php';