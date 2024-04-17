<?php

namespace App\Services;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class StoreService
{
    /**
     * Set/unset active status for store
     *
     * @param Store $store
     * @return void
     */
    public function toggleStoreIsActive(Store $store): void
    {
        if ($store->is_active) {
            $store->is_active = false;
        } else {
            $store->is_active = true;
        }

        $store->save();
    }


    /**
     * Find user who doesn't have related store
     *
     * @return Collection
     */
    public function getUsersWithoutStore(): Collection
    {
        return User::doesntHave('store')->get();
    }
}