<?php

namespace App\Api\V1\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Tymon\JWTAuth\JWTManager;

class LoginController extends Controller
{
    public function login(LoginRequest $request, JWTAuth $JWTAuth)
    {
        $credentials = $request->only(['email', 'password']);
        try {
            $token = $JWTAuth->attempt($credentials);
            if(!$token) {
                throw new AccessDeniedHttpException();
            }
        } catch (JWTException $e) {
            throw new HttpException(500);
        }
        $user  = $JWTAuth->toUser($token);
        return response()
            ->json([
                'status' => 'ok',
                'token' => $token,
                'name' => $credentials,
                'nickname' => $user->name
            ]);
    }

    public function refresh(JWTAuth $JWTAuth, JWTManager $manager)
    {
        $token = $JWTAuth->getToken();
        if(!$token){
            throw new BadRequestHtttpException('Token not provided');
        }
        try{
              $token = $manager->refresh($token)->get();
        }catch(TokenInvalidException $e){
              throw new AccessDeniedHttpException('The token is invalid');
        }
        return response()->json(['token'=>$token]);
  }
}
