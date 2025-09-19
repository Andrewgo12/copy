<?php

namespace App\Policies;

use App\Models\SolicitudReferencia;
use App\Models\User;

class SolicitudReferenciaPolicy
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
    public function view(User $user, SolicitudReferencia $solicitud): bool
    {
        if (!$user->is_active) {
            return false;
        }

        // Administradores pueden ver todas las solicitudes
        if ($user->role === 'admin') {
            return true;
        }

        // Médicos pueden ver solicitudes asignadas a ellos o solicitudes nuevas
        if ($user->role === 'medico') {
            return $solicitud->medico_evaluador_id === $user->id || 
                   $solicitud->estado_solicitud === 'nueva';
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'medico']) && $user->is_active;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SolicitudReferencia $solicitud): bool
    {
        if (!$user->is_active) {
            return false;
        }

        // Administradores pueden actualizar cualquier solicitud
        if ($user->role === 'admin') {
            return true;
        }

        // Médicos pueden actualizar solicitudes asignadas a ellos
        if ($user->role === 'medico') {
            return $solicitud->medico_evaluador_id === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SolicitudReferencia $solicitud): bool
    {
        return $user->role === 'admin' && $user->is_active;
    }

    /**
     * Determine whether the user can decide on the solicitud.
     */
    public function decide(User $user, SolicitudReferencia $solicitud): bool
    {
        if (!$user->is_active) {
            return false;
        }

        // Solo médicos pueden tomar decisiones
        if ($user->role !== 'medico') {
            return false;
        }

        // La solicitud debe estar asignada al médico o ser nueva
        if ($solicitud->medico_evaluador_id && $solicitud->medico_evaluador_id !== $user->id) {
            return false;
        }

        // No se puede decidir sobre solicitudes ya decididas
        return in_array($solicitud->estado_solicitud, ['nueva', 'en_revision', 'pendiente_info']);
    }

    /**
     * Determine whether the user can assign a medico to the solicitud.
     */
    public function assign(User $user, SolicitudReferencia $solicitud): bool
    {
        // Solo administradores pueden asignar médicos
        return $user->role === 'admin' && $user->is_active;
    }

    /**
     * Determine whether the user can view the history of the solicitud.
     */
    public function viewHistory(User $user, SolicitudReferencia $solicitud): bool
    {
        return $this->view($user, $solicitud);
    }

    /**
     * Determine whether the user can request additional information.
     */
    public function requestInfo(User $user, SolicitudReferencia $solicitud): bool
    {
        if (!$user->is_active) {
            return false;
        }

        // Solo médicos pueden solicitar información adicional
        if ($user->role !== 'medico') {
            return false;
        }

        // La solicitud debe estar asignada al médico
        return $solicitud->medico_evaluador_id === $user->id;
    }

    /**
     * Determine whether the user can view notifications related to the solicitud.
     */
    public function viewNotifications(User $user, SolicitudReferencia $solicitud): bool
    {
        return $this->view($user, $solicitud);
    }

    /**
     * Determine whether the user can export solicitud data.
     */
    public function export(User $user): bool
    {
        return $user->role === 'admin' && $user->is_active;
    }

    /**
     * Determine whether the user can view statistics.
     */
    public function viewStats(User $user): bool
    {
        return in_array($user->role, ['admin', 'medico']) && $user->is_active;
    }
}
