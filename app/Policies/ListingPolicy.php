<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingPolicy
{
    use HandlesAuthorization;

		public function before(?User $user, $ability) {
			// override all actions if user is admin
			// allow 'update' for admin
			// if($user && $user->is_admin) // old php
			if ($user?->is_admin) // && $ability === 'update') {
			{
				return true;
			}
		}

    public function viewAny(?User $user)
    {
        //
				return true;
    }

    public function view(?User $user, Listing $listing)
    {
        //
				return true;
    }

    public function create(User $user)
    {
        //
				return true;
    }

    public function update(User $user, Listing $listing)
    {
        //
				return $user->id === $listing->by_user_id;
    }

    public function delete(User $user, Listing $listing)
    {
        //
				return $user->id === $listing->by_user_id;
    }

    public function restore(User $user, Listing $listing)
    {
        //
				return $user->id === $listing->by_user_id;
    }

    public function forceDelete(User $user, Listing $listing)
    {
        //
				return $user->id === $listing->by_user_id;
    }
}
