<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function user(): JsonResponse
    {
        return response()->json([
            'user' => Auth::user(),
        ]);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateInfo(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'email|unique:users',
        ]);

        $user = Auth::user();

        $user->update($request->only('first_name', 'last_name', 'email', 'image'));

        return response()->json([
            'user' => $user,
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePassword(Request $request): JsonResponse
    {
        $this->validate($request, [
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request['password']),
        ]);

        return response()->json([
            'user' => $user,
        ], Response::HTTP_ACCEPTED);
    }
}
