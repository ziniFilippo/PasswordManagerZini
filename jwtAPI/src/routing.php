<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Controllers\UserController;

// Get all users
$app->get('api/utenti', [\App\Controllers\UserController::class, 'getAllUsers']);

// Get a specific user
$app->get('api/utenti/{id}', [\App\Controllers\UserController::class, 'getUser']);

// Create a new user
$app->post('api/utenti', [\App\Controllers\UserController::class, 'createUser']);

// Update a user
$app->put('api/utenti/{id}', [\App\Controllers\UserController::class, 'updateUser']);

// Delete a user
$app->delete('api/utenti/{id}', [\App\Controllers\UserController::class, 'deleteUser']);
// Add a route to verify the token
$app->get('api/verify/{token}', [\App\Controllers\AuthController::class, 'verify']);

?>