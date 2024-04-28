<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\IngredientStockController;

class IngredientStockMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Call the method from IngredientStockController
        $controller = new IngredientStockController();
        $controller->deleteExpiredIngredients(); // Call the desired method
        $controller->checkAndNotifyExpiredIngredients(); // Call the desired method

        return $next($request);
    }
}
