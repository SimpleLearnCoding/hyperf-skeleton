<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\TokenService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\PostMapping;

#[Controller]
class TokenController extends AbstractController
{
    #[Inject]
    private TokenService $tokenService;

    #[PostMapping(path: "/login")]
    public function login()
    {
        $data = (array) $this->request->inputs(['username', 'password']);

        $result = $this->tokenService->generateAccessToken($data, 43200);

        return $this->response->json(['code' => 200, 'data' => $result]);
    }

    #[PostMapping(path: "/refresh")]
    public function refresh()
    {
        $accessToken = $this->request->header('Authorization');

        $this->tokenService->refresh($accessToken);

        return $this->response->json(['code' => 200]);
    }
}
