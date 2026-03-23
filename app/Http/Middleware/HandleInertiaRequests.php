<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
{
    return array_merge(parent::share($request), [
        'auth' => [
            'user' => $request->user() ? [
                'id' => $request->user()->id,
                'name' => $request->user()->name,
                'roles' => array_values($request->user()->getRoleNames()->toArray()), 
            ] : null,
        ],
        // Flash messages para avisar quando um livro for excluído ou criado
        'flash' => [
            'success' => $request->session()->get('success'),
        ],
    ]);
}
}