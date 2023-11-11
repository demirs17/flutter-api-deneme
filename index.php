<?php
require_once "inc/Route.php";
require_once "Controller/Controller.php";
require_once "inc/config.php";



// header("Content-type: text/html");

// Route::define("GET", "/login", function(){include 'UI/login.php';});
// Route::define("GET", "/", function(){include 'UI/home.php';});
// Route::define("GET", "/create", function(){include 'UI/create.php';});



header("Content-type: application/json");

Route::define("POST", "/api/login", array("UserController", "login"));
Route::define("POST", "/api/register", array("UserController", "register"));

#////////////////////////////////////////////////////////////////////
Route::define("POST", "/api", array("PostController", "fetch_time"));
Route::define("GET", "/api/fetch-time", array());
#\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

Route::define("GET", "/api/fetch-posts-of-user", array("PostController", "fetchByUsername"));
Route::define("GET", "/api/fetch-post-by-id", array("PostController", "fetch_by_id"));
Route::define("POST", "/api/update", array("PostController", "update"));
Route::define("POST", "/api/create", array("PostController", "create"));
Route::define("POST", "/api/delete", array("PostController", "delete"));

Route::define("GET", "/api/get-comments", array("CommentController", "get"));
Route::define("POST", "/api/create-comment", array("CommentController", "create"));
Route::define("POST", "/api/delete-comment", array("CommentController", "delete"));

Route::define("GET", "/api/get-replies", array("CommentController", "get_replies"));
Route::define("POST", "/api/create-reply", array("CommentController", "create_reply"));
Route::define("POST", "/api/delete-reply", array("CommentController", "delete_reply"));


echo '
    {"status": "failure", "message": "sayfa bulunamadı '. $_SERVER["REQUEST_METHOD"] .' - '. $_SERVER["REQUEST_URI"] .'"}
';