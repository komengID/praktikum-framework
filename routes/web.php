<?php

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
    return view('welcome');
});

//BASIC ROUTING
Route::get("/hello", function () {
    return "Hello World";
});

Route::get("/about", function () {
    return "NIM : 2020520026 <br> Nama : Moh. Qoming Zaki";
});

//dependency injection
Route::get("/profile/{name}", function ($name) {
    return $name;
});

Route::get("/profile/{name}/{nrp}", function ($name, $nrp) {
    return $name . " " . $nrp;
});

//redirect route
Route::redirect("/here", "/there");

Route::get("/there", function () {
    return "You're in there";
});

//view route
Route::view("/hello", "hello");

Route::view("/about", "about");

//required parameter
Route::get("/user/{name}", function ($name) {
    return $name;
});

Route::get("/user/{name}/profile", function ($name) {
    return $name . "'s profile";
});

//optional parameter
Route::get("/user/{name?}", function ($name = "John Doe") {
    return $name;
});

Route::get("/user/{name?}/profile", function ($name = "John Doe") {
    return $name . "'s profile";
});

//regular expression constraint
Route::get("/user/{name}", function ($name) {
    return $name;
})->where("name", "[A-Za-z]+");

Route::get("/user/{id}", function ($id) {
    return $id;
})->where("id", "[0-9]+");

//named route
Route::get("/user/profile", function () {
    return "This is profile page";
})->name("profile");

Route::get("/user/{id}/profile", function ($id) {
    return "This is profile page of user with id " . $id;
})->name("profile");

//route group
Route::prefix("admin")->group(function () {
    Route::get("/home", function () {
        return "This is admin home";
    });

    Route::get("/profile", function () {
        return "This is admin profile";
    });
});

Route::namespace("Admin")->group(function () {
    Route::get("/home", "HomeController@index");
    Route::get("/profile", "ProfileController@index");
});

//middleware
Route::get("/admin/home", function () {
    return "This is admin home";
})->middleware("auth");

Route::get("/admin/profile", function () {
    return "This is admin profile";
})->middleware("auth");

//controller
Route::get("/hello", "HelloController@index");

Route::get("/hello/{name}", "HelloController@show");

//route prefixes
Route::prefix("admin")->group(function () {
    Route::get("/home", function () {
        return "This is admin home";
    });

    Route::get("/profile", function () {
        return "This is admin profile";
    });
});

Route::prefix("user")->group(function () {
    Route::get("/home", function () {
        return "This is user home";
    });

    Route::get("/profile", function () {
        return "This is user profile";
    });
});

//route name prefixes
Route::name("admin.")->group(function () {
    Route::get("/home", function () {
        return "This is admin home";
    })->name("home");

    Route::get("/profile", function () {
        return "This is admin profile";
    })->name("profile");
});

Route::name("user.")->group(function () {
    Route::get("/home", function () {
        return "This is user home";
    })->name("home");

    Route::get("/profile", function () {
        return "This is user profile";
    })->name("profile");
});

//url generation
Route::get("/user/{id}/profile", function ($id) {
    return "This is profile page of user with id " . $id;
})->name("profile");

Route::get("/test", function () {
    return route("profile", ["id" => 1]);
});