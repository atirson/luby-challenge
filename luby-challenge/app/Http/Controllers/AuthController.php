<?php
namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if ($request->input('remember')) {
            $token_ttl = env('JWT_TTL_REMEMBER_ME', 1);
            Auth::factory()->setTTL($token_ttl * 10080);
        }

        $token = Auth::attempt([
            'email' => $request->input('user_name'),
            'password' => $request->input('password')
        ]);

        if (!$token) {
            return response()->json(['success' => false, 'code' => 401, 'message' => 'Usuário não autorizado.'], 401);
        }

        return $this->respondWithToken($token);
    }


    /**
     * @param $token
     * @return JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        $ttl = (int)Auth::factory()->getTTL();

        return response()->json(['success' => true, 'code' => 200, 'resData' => [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in_minutes' => $ttl,
            'expires_in_date' => Carbon::now()->addMinute($ttl)->format('d-m-Y H:i:s'),
        ]], 200);
    }

    /**
     * @return JsonResponse
     */
    public function me()
    {
        $user = Auth::user();

        $me = [
            $user
        ];

        return response()->json(['success' => true, 'code' => 200, 'data' => $me], 200);
    }

    /**
     * @return JsonResponse
     */
    public function payoad()
    {
        $payload = Auth::payload();

        $dates = [
            'emitido_em' => Carbon::createFromTimestamp($payload('iat'))->format('d-m-Y H:i:s'),
            'expira_em' => Carbon::createFromTimestamp($payload('exp'))->format('d-m-Y H:i:s'),
            'nao_antes_de' => Carbon::createFromTimestamp($payload('nbf'))->format('d-m-Y H:i:s')
        ];

        return response()->json(['success' => true, 'code' => 200, 'data' => ['payload' => $payload, 'datas' => $dates]], 200);
    }

    /**
     * @return JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['success' => true, 'code' => 200, 'message' => 'Deslogado com Sucesso!!'], 200);
    }

    /**
     * @return JsonResponse
     */
    public function refresh()
    {
        try {
            $newToken = Auth::refresh();
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

        return $this->respondWithToken($newToken);
    }
}
