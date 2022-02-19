<?php
/**
 * @author pfinal南丞
 * @date 2021年07月14日 下午3:27
 */
declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 */
class HomeController
{
    public function index(RequestInterface $request): string
    {
        // 从请求中获得 id 参数
        print_r($request->all());
        return '注释路由';
    }
}