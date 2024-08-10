<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="Database Reader API Documentation",
 *     version="0.1",
 *      @OA\Contact(
 *          email="danniel.tetelof@gmail.com"
 *      ),
 * ),
 *  @OA\Server(
 *      description="localhost",
 *      url="http://localhost/api/"
 *  ),
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the authentication token",
 *     name="Token based Based",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="apiAuth",
 * )
 */
abstract class Controller
{
    //
}
