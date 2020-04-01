<?php

namespace App\Policies;

use App\Inquiry;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InquiryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any inquiries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the inquiry.
     *
     * @param  \App\User  $user
     * @param  \App\Inquiry  $inquiry
     * @return mixed
     */
    public function view(User $user, Inquiry $inquiry)
    {
        //
    }

    /**
     * Determine whether the user can create inquiries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the inquiry.
     *
     * @param  \App\User  $user
     * @param  \App\Inquiry  $inquiry
     * @return mixed
     */
    public function update(User $user, Inquiry $inquiry)
    {
        return $user->person->id === $inquiry->person_id;
    }

    /**
     * Determine whether the user can delete the inquiry.
     *
     * @param  \App\User  $user
     * @param  \App\Inquiry  $inquiry
     * @return mixed
     */
    public function delete(User $user, Inquiry $inquiry)
    {
        //
    }

    /**
     * Determine whether the user can restore the inquiry.
     *
     * @param  \App\User  $user
     * @param  \App\Inquiry  $inquiry
     * @return mixed
     */
    public function restore(User $user, Inquiry $inquiry)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the inquiry.
     *
     * @param  \App\User  $user
     * @param  \App\Inquiry  $inquiry
     * @return mixed
     */
    public function forceDelete(User $user, Inquiry $inquiry)
    {
        //
    }
}
