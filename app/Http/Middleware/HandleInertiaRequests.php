<?php

namespace App\Http\Middleware;

//use App\Models\Role;
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
//            'permissions' => [
//                'isAdmin' => $request->user() ? $request->user()->hasRole(Role::ADMIN) : false,
//                'isAdminOrManager' => $request->user() ? $request->user()->hasRole([Role::ADMIN, Role::MANAGER]) : false,
//            ],
            'flash' => [
                'message' => session('message'),
                'success' => session('success')
            ],
            'ziggy' => $ziggy->toArray()
        ]);
    }
}
