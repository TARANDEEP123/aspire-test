<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

/**
 * Class UserMiddleware
 * @package App\Http\Middleware
 */
class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle (Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        try {
            if (empty($token)) {
                return new Exception('Unauthorized');
            }

            $user = JWTAuth::parseToken()->authenticate();
            if (empty($user)) {
                return response()->json(['user_not_found'], 404);
            }
            if($user->user_type_id != 2) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], 400);

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], 400);

        } catch (JWTException $e) {

            return response()->json(['token_absent'], 400);
        }

        return $next($request);
    }
}
