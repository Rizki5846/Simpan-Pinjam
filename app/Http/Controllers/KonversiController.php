<?php

namespace App\Http\Controllers;

class KonversiController extends Controller
{
    public static function pekerjaan($value)
    {
        return match (strtolower($value)) {
            'stabil' => 0,
            'cukup stabil' => 0.5,
            'tidak stabil' => 1,
            default => 0.5
        };
    }

    public static function statusPembayaran($value)
    {
        return match (strtolower($value)) {
            'lancar' => 0,
            'belum pernah meminjam' => 0.5,
            'menunggak' => 1,
            default => 0.5
        };
    }

    public static function keanggotaan($value)
    {
        return match (strtolower($value)) {
            'lama' => 0,
            'sedang' => 0.5,
            'sebentar' => 1,
            default => 0.5
        };
    }
}
