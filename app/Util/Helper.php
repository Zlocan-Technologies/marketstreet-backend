<?php

namespace App\Util;

use App\Models\ReferralCode;

class Helper
{
    public static function generate_random_str(
        $length, 
        $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'
    )
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }

    public static function generateReferral($name)
    {
        $suffix = self::generate_random_str(3);
        $prefix = substr($name, 0, 3);
        $referralCode = strtoupper($prefix . $suffix);

        $refExist = ReferralCode::where('code', $referralCode)->get();
        if ($refExist->count() > 0) {
            $numExist = $refExist->count() + 1;
            self::generateReferral("{$numExist}{$name}");
        }

        return $referralCode;
    }

    public static function getDistance($latA, $lngA, $latB, $lngB)
    {
        $R = 6371000;
        $radiansLAT_A = deg2rad($latA);
        $radiansLAT_B = deg2rad($latB);
        $variationLAT = deg2rad($latB - $latA);
        $variationLNG = deg2rad($lngB - $lngA);

        $a = sin($variationLAT / 2) * sin($variationLAT / 2)
            + cos($radiansLAT_A) * cos($radiansLAT_B) * sin($variationLNG / 2) * sin($variationLNG / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $d = $R * $c;

        return $d / 1000;
    }

    public static function generateReference($id)
    {
        $token = "";
        $codeAlphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codeAlphabet .= 'abcdefghijklmnopqrstuvwxyz';
        $codeAlphabet .= '0123456789';
        $max = strlen($codeAlphabet) - 1;
        for($i=0; $i<14; $i++):
            $token .= $codeAlphabet[mt_rand(0, $max)]; 
        endfor; 
        return $id.strtolower($token);
    }
}
