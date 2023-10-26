<?php

if (!function_exists('convert_arabic_to_english')) {
    function convert_arabic_to_english($arabicNumber)
    {
        $persianNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($persianNumbers, $englishNumbers, $arabicNumber);
    }
}
