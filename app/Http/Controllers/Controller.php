<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\User;

class Controller extends BaseController
{
    public function apiResponse($status, $message, $result=null)
    {
        if ($result) {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'result' => $result
            ]);
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }

    public function getUserProfile($user)
    {
        try {
            $userProfile = "User ini belum mengisi profil";
            if ($user->mahasiswa()->exists()) {
                $userProfile = $user->mahasiswa;
                unset($user->mahasiswa);
            } elseif ($user->konselor()->exists()) {
                $userProfile = $user->konselor;
                unset($user->konselor);
            } elseif ($user->pembantuDirektur()->exists()) {
                $userProfile = $user->pembantuDirektur;
                unset($user->pembantuDirektur);
            } elseif ($user->admin()->exists()) {
                $userProfile = $user->admin;
                unset($user->admin);
            }
            return $userProfile;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getUserRole($user)
    {
        try {
            $userRoles = "User ini belum memiliki role";
            if ($user->roles()->exists()) {
                $roles = $user->roles;
                $userRoles = [];
                foreach ($roles as $key => $role) {
                    unset($role->pivot);
                    unset($role->created_at);
                    unset($role->updated_at);
                    array_push($userRoles, $role);
                }
            }
            unset($user->roles);
            return $userRoles;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
