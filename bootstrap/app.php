<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
        ]);
        $middleware->api(prepend: [SetLocale::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->expectsJson()) {

                // 401 - Authentication (Sanctum)
                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'success' => false,
                        'message' => __('api.unauthenticated')
                    ], 401);
                }

                // 403 - Authorization (Policy)
                if ($e instanceof AccessDeniedHttpException) {
                    return response()->json([
                        'success' => false,
                        'message' => __('api.unauthorized')
                    ], 403);
                }

                // 403 - Spatie Permissions
                if ($e instanceof UnauthorizedException) {
                    return response()->json([
                        'success' => false,
                        'message' => __('api.unauthorized')
                    ], 403);
                }

                // 404 - Not Found
                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'success' => false,
                        'message' => __('api.not_found')
                    ], 404);
                }

                // 429 - Rate Limiting
                if ($e instanceof ThrottleRequestsException) {
                    $seconds = $e->getHeaders()['Retry-After'] ?? 60;
                    return response()->json([
                        'success' => false,
                        'message' => __('api.too_many_requests', ['seconds' => $seconds])
                    ], 429);
                }

                // 500 - Server Error (Others)
                return response()->json([
                    'success' => false,
                    'message' => __('api.server_error')
                ], 500);
            }
        });
    })->create();
