<?php

namespace App\Http\Controllers\Api\Teachers\Session;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class AuthTeachersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teachers', ['except' => ['login']]);
    }

    public function login()
    {


        $teacher = Teacher::whereEmail(request()->email)->first();

        if ($teacher) {

            if (Hash::check(request()->password, $teacher->password)) {
                $credentials = request(['email', 'password']);

                if (!$token = auth("teachers")->attempt($credentials)) {
                    return response()->json(['error' => 'Unauthorized'], 401);
                }

                return response()->json(array(
                    "success" => [
                        "techer" => $teacher,
                        "access_token" => $token,
                        "session" => "teacher",
                    ],
                ));
            }
        }

        return response()->json(["error" => ["msg" => "No esiste el usuario."]], 404);

    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
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
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
