<?php


namespace App\Service;


use Hyperf\Di\Annotation\Inject;
use Hyperf\Redis\Redis;

/**
 * Class TokenService
 *
 * @author  linnzh
 * @created 2023/3/8 13:52
 */
class TokenService
{
    public const USER_LOGIN_ACCESS_TOKEN_PREFIX = 'user:login_access_token:';

    #[Inject]
    private Redis $redis;

    public function generateAccessToken(array $data, int $expire = 43200)
    {
        $userInfo = $this->getUserInfo($data['username'], $data['password']);

        $key = uuid();

        $this->redis->set(self::USER_LOGIN_ACCESS_TOKEN_PREFIX . $key, json_encode($userInfo), $expire);

        return ['access_token' => $key, 'expires_in' => $expire];
    }

    private function getUserInfo(string $username, string $password)
    {
        // TODO 获取用户信息
        return [
            'username' => $username,
        ];
    }

    public function refresh(?string $accessToken)
    {
        $this->redis->setTimeout(self::USER_LOGIN_ACCESS_TOKEN_PREFIX . $accessToken, 43200);
    }

    public function logout(?string $accessToken)
    {
        $this->redis->del(self::USER_LOGIN_ACCESS_TOKEN_PREFIX . $accessToken);
    }
}