<?php

namespace App\Http\Middleware;

//use App\Models\Role;
use App\Enums\Roles;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        $ziggy = new Ziggy($group = null, $request->url());

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'isSuperAdmin' => (auth()->check() ? auth()->user()->hasRole(Roles::SuperAdmin->value) : false),
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
            'ziggy' => $ziggy->toArray()
        ]);
    }
}
