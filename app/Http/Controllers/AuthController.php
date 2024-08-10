<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *   path="/auth/login",
     *   description="Login",
     *   tags={"Auth"},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="test@example.com"),
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Login successful",
     *     @OA\JsonContent(
     *       @OA\Property(property="access_token", type="string", example="eyJ0eXAiO..."),
     *       @OA\Property(property="token_type", type="string", example="bearer"),
     *       @OA\Property(property="expires_in", type="integer", example="3600"),
     *     )
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Unauthorized",
     *     @OA\JsonContent(
     *       @OA\Property(property="error", type="string", example="Unauthorized"),
     *     )
     *   ),
     *   @OA\PathItem (),
     * )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *  path="/auth/me",
     *  summary="Get user details",
     *  tags={"Auth"},
     *  @OA\Response(
     *    response=200,
     *    description="User details",
     *  ),
     * )
     */
    public function me()
    {
        return response()->json(auth()->user(), 200);
    }


    /**
     * @OA\Post(
     *  path="/auth/logout",
     *  summary="Logout",
     *  tags={"Auth"},
     *  @OA\Response(
     *    response=200,
     *    description="Logout successful",
     *  ),
     * )
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    /**
     * @OA\Post(
     *  path="/auth/refresh",
     *  summary="Refresh token",
     *  tags={"Auth"},
     *  @OA\Response(
     *    response=200,
     *    description="Token refreshed",
     *  ),
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}