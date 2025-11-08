<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\EnrichAuthResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo('/auth/login');
        // $middleware->append(EnrichAuthResponse::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (AuthenticationException $e, $request) {
            return sendApiError('User is not logged in.', 401);
        });

        $exceptions->render(function (ValidationException $e, $request) {
            return sendApiError('Validation failed.', 422, $e->errors());
        });

        $exceptions->render(function (NotFoundHttpException $e, $request) {
            $previous = $e->getPrevious();

            if ($previous instanceof ModelNotFoundException) {
                $model = class_basename($previous->getModel());
                $modelName = trim(preg_replace('/(?<!^)([A-Z])/', ' $1', $model));
                return sendApiError("{$modelName} not found.", 404);
            }

            return sendApiError('Not found.', 404);
        });
    })->create();
