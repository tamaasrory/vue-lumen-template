<?php
/**
 * author : tama asrory
 * email : tamaasrory@gmail.com
 */

namespace App\Models\Base;


class KeyGen
{
    /**
     * Generate random key for simple way wehehe
     *
     * @param string $prefix
     * @param string $suffix
     * @return string
     */
    public static function randomKey($prefix = '', $suffix = '', $intOnly = true, $length = 5)
    {
        $collection = '';
        if ($intOnly) {
            $collection = collect([
                1, 2, 3, 4, 5, 6, 7, 8, 9,
                9, 8, 7, 6, 5, 4, 3, 2, 1,
                1, 2, 3, 4, 5, 6, 7, 8, 9,
                9, 8, 7, 6, 5, 4, 3, 2, 1,
                1, 2, 3, 4, 5, 6, 7, 8, 9,
                9, 8, 7, 6, 5, 4, 3, 2, 1,
            ]);
        } else {
            $collection = collect([
                1, 2, 3, 4, 5, 6, 7, 8, 9,
                'A', 'B', 'C', 'D', 'E', 'F',
                'G', 'H', 'I', 'J', 'K', 'L', 'M',
                'N', 'O', 'P', 'Q', 'R', 'S', 'T',
                'U', 'V', 'W', 'X', 'Y', 'Z',
                1, 2, 3, 4, 5, 6, 7, 8, 9,
            ]);
        }

        $randomKey = implode('', $collection->random($length)->all());
        if (!$prefix) {
            $prefix = date('ymdHi');
        }
        return $prefix . $randomKey . $suffix;
    }
}
