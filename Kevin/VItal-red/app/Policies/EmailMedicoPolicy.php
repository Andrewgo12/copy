<?php

namespace App\Policies;

use App\Models\EmailMedico;
use App\Models\User;

class EmailMedicoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'medico']) && $user->is_active;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EmailMedico $emailMedico): bool
    {
        return in_array($user->role, ['admin', 'medico']) && $user->is_active;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' && $user->is_active;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EmailMedico $emailMedico): bool
    {
        return in_array($user->role, ['admin', 'medico']) && $user->is_active;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EmailMedico $emailMedico): bool
    {
        return $user->role === 'admin' && $user->is_active;
    }

    /**
     * Determine whether the user can validate the email.
     */
    public function validate(User $user, EmailMedico $emailMedico): bool
    {
        return in_array($user->role, ['admin', 'medico']) && $user->is_active;
    }

    /**
     * Determine whether the user can create a registro medico from the email.
     */
    public function createRegistro(User $user, EmailMedico $emailMedico): bool
    {
        return in_array($user->role, ['admin', 'medico']) && 
               $user->is_active && 
               $emailMedico->validation_status === 'valid' &&
               !$emailMedico->imported_to_registro;
    }

    /**
     * Determine whether the user can import emails from IA system.
     */
    public function import(User $user): bool
    {
        return $user->role === 'admin' && $user->is_active;
    }

    /**
     * Determine whether the user can process pending emails.
     */
    public function processPending(User $user): bool
    {
        return $user->role === 'admin' && $user->is_active;
    }
}
