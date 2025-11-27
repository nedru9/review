<?php

namespace App\Helpers;

class BaseHelper
{
    /**
     * Получение слова "отметка" в падежах
     *
     * @param int $count
     *
     * @return string
     */
    public static function countEvaluationsWord(int $count): string
    {
        $countPre = abs($count) % 100;
        $lastDigit = $count % 10;

        if ($countPre > 10 && $countPre < 20) {
            return 'отметок';
        }

        switch ($lastDigit) {
            case 1:
                return "$count отметка";
            case 2:
            case 3:
            case 4:
                return "$count отметки";
            default:
                return "$count отметок";
        }
    }

}
