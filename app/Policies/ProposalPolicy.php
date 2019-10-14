<?php

namespace App\Policies;

use App\User;
use App\Proposal;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProposalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the proposal.
     *
     * @param  \App\User  $user
     * @param  \App\Proposal  $proposal
     * @return mixed
     */
    public function update(User $user, Proposal $proposal)
    {
        return $user->id === $proposal->user_id;
    }
}
