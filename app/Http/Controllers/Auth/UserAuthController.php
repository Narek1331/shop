<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserSignup;
use App\Services\UserService;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\UserSignin;

class UserAuthController extends Controller
{
    private $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
     /**
     * @OA\POST(
     *     path="/api/auth/login",
     *     @OA\Response(
     *         response="200",
     *         description="login"
     *     )
     * )
     */
    public function login(UserSignin $request){
        $response = Http::asForm()->post( env('APP_URL') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
          ]);
        $data = $response->json();

        if(isset($data['error'])){
            return response()->json([
                'status'=>false,
                'message'=>'invalid email or password'
            ],422);
        }
        return $data;
    }

    /**
     * @OA\POST(
     *     path="/api/auth/signup",
     *     @OA\Response(
     *         response="200",
     *         description="login"
     *     )
     * )
     */
    public function signup(UserSignup $request){
        $user = $this->userService->store(
            $request->name,
            $request->surname,
            $request->email,
            $request->password,
        );

        return response()->json([
            'status' => true,
            'message' => 'user created successfuly'
        ],201);


    }
}
