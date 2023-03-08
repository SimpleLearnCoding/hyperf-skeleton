<?php

declare(strict_types=1);

namespace App\Controller;

use App\Annotation\Demo\DemoAnnotation;
use Hyperf\HttpServer\Annotation\Controller;


#[Controller(prefix: "")]
class IndexController extends AbstractController
{
    #[DemoAnnotation('index')]
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf Skeleton');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }
}
