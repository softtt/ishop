<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use App\Services\StoreService;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $stores = StoreResource::collection(Store::with('user')->get());

        return Inertia::render('Admin/Store/List', [
            'stores' => $stores,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param StoreService $service
     * @return Response|RedirectResponse
     */
    public function create(StoreService $service): Response|RedirectResponse
    {
        $usersWithoutStore = $service->getUsersWithoutStore();

        if (empty($usersWithoutStore)) {
            return redirect()->route('stores.index')->with('message', 'All users already has stores');
        }

        return Inertia::render(
            'Admin/Store/Create', [
                'users' => $usersWithoutStore
            ]
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreStoreRequest $request): RedirectResponse
    {
        $request->validated();

        Store::create([
            'id' => $request->user,
            'name' => $request->name,
            'short_description' => $request->short_description,
            'user_id' => $request->user,
            'is_active' => true
        ]);

        return redirect()->route('stores.index')->with('message', 'Store Created Successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Store $store
     * @return Response
     */
    public function edit(Store $store): Response
    {
        return Inertia::render('Admin/Store/Edit', ['store' => $store->toArray()]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStoreRequest $request
     * @param Store $store
     * @return RedirectResponse
     */
    public function update(UpdateStoreRequest $request, Store $store): RedirectResponse
    {
        $request->validated();

        $store->name = $request->name;
        $store->short_description = $request->short_description;
        $store->save();

        return redirect()->route('stores.index')->with('message', 'Store Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Store $store
     * @return RedirectResponse
     */
    public function destroy(Store $store): RedirectResponse
    {
        $store->delete();

        return redirect()->route('stores.index')->with('message', 'Store Deleted Successfully');
    }

    /**
     * Make store active/inactive admin access to user
     *
     * @param StoreService $service
     * @param Store $store
     * @return RedirectResponse
     */
    public function toggleActiveStatus(StoreService $service, Store $store): RedirectResponse
    {
        $service->toggleStoreIsActive($store);

        return redirect()->route('stores.index')->with('message', 'Store status changed');
    }
}
