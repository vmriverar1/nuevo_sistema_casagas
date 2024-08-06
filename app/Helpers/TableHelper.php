<?php

namespace App\Helpers;

class TableHelper
{
    public static function formatStatus($module, $status, $id)
    {
        switch ($status) {
            case 'activo':
                return '<button class="btn btn-success change_'. $module .'" data="'. $id .'">Activo</button>';
            case 'mantenimiento':
                return '<button class="btn btn-warning" data="'. $id .'">Mantenimiento</button>';
            default:
                return '<button class="btn btn-danger change_'. $module .'" data="'. $id .'">Inactivo</button>';
        }
    }
}
