<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProfieUpdate;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;

class ProfileController extends Controller
{
    private $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    /**
     * @OA\PUT(
     *     path="/api/profile",
     *     @OA\Response(
     *         response="200",
     *         description="update profile"
     *     )
     * )
     */
    public function update(ProfieUpdate $request){

        $user = $this->userService->update(Auth::user()->id,$request->all());

        return response()->json([
            'status' => true,
            'message' => 'user updated successfuly'
        ],200);
    }

    /**
     * @OA\GET(
     *     path="/api/profile",
     *     @OA\Response(
     *         response="200",
     *         description="get profile"
     *     )
     * )
     */
    public function index(ProfieUpdate $request){

        return response()->json([
            'status' => true,
            'data' => Auth::user()
        ],200);
    }
}
