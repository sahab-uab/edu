<?php
// get media
if (!function_exists('get_media')) {
    function get_media($path = null)
    {
        $baseMediaPath = public_path('media');
        $blankPath = asset('media/placeholder_images.jpg');

        if (!$path) {
            return $blankPath;
        }

        $fullPath = $baseMediaPath . '/' . ltrim($path, '/');
        if (file_exists($fullPath)) {
            return asset('media/' . ltrim($path, '/'));
        }

        return $blankPath;
    }
}


// Convert the resultant number’s digits to Bangla.
if (!function_exists('formatToBangla')) {
    function formatToBangla($number)
    {
        if ($number >= 10000000) { // 1 Crore
            $formatted = number_format($number / 10000000, 1) . ' কোটি';
        } elseif ($number >= 100000) { // 1 Lakh
            $formatted = number_format($number / 100000, 1) . ' লক্ষ';
        } elseif ($number >= 1000) { // 1 Thousand
            $formatted = number_format($number / 1000, 1) . ' হাজার';
        } else {
            $formatted = $number;
        }

        // English to Bangla mapping
        $engDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bangDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        $bangla = str_replace($engDigits, $bangDigits, $formatted);
        return $bangla;
    }
}


// date bangla formate
if (!function_exists('date_to_bangla')) {
    function date_to_bangla($dateString)
    {
        // English to Bangla digits and months
        $bn = [
            '0' => '০',
            '1' => '১',
            '2' => '২',
            '3' => '৩',
            '4' => '৪',
            '5' => '৫',
            '6' => '৬',
            '7' => '৭',
            '8' => '৮',
            '9' => '৯',
            'Jan' => 'জানুয়ারি',
            'Feb' => 'ফেব্রুয়ারি',
            'Mar' => 'মার্চ',
            'Apr' => 'এপ্রিল',
            'May' => 'মে',
            'Jun' => 'জুন',
            'Jul' => 'জুলাই',
            'Aug' => 'আগস্ট',
            'Sep' => 'সেপ্টেম্বর',
            'Oct' => 'অক্টোবর',
            'Nov' => 'নভেম্বর',
            'Dec' => 'ডিসেম্বর',
            'Mon' => 'সোমবার',
            'Tue' => 'মঙ্গলবার',
            'Wed' => 'বুধবার',
            'Thu' => 'বৃহস্পতিবার',
            'Fri' => 'শুক্রবার',
            'Sat' => 'শনিবার',
            'Sun' => 'রবিবার',
        ];

        $formatted = date('D M, Y', strtotime($dateString));

        return strtr($formatted, $bn) . ' ইং';
    }
}
