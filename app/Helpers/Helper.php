<?php

namespace App\Helpers;

use Carbon\Carbon;
use DateInterval;
use DateTime;

class Helper
{
    public static function thisYear()
    {
        return Carbon::parse(Carbon::now())->format('Y');
    }

    public static function thisMonth()
    {
        return Carbon::parse(Carbon::now())->format('m');
    }

    public static function thisDay()
    {
        return Carbon::parse(Carbon::now())->format('d');
    }

    public static function dayToYearsMonthDay($days)
    {
        $start_date = new DateTime();
        $end_date = (new $start_date)->add(new DateInterval("P{$days}D"));
        $dd = date_diff($start_date, $end_date);
        return $dd->y . " tahun " . $dd->m . " bulan " . $dd->d . " hari";
    }

    public static function monthYear($date)
    {
        return Carbon::parse($date)->isoFormat('YYYY MMM');
    }

    public static function ymD($tahun = null, $plus = false)
    {
        !empty($tahun) ? $tahun = $tahun : $tahun = Helper::thisYear();
        if ($plus) {
            return Carbon::parse($tahun . '-01-01')->addYear(1)->format('Y-m-d');
        }
        return Carbon::parse($tahun . '-01-01')->format('Y-m-d');
    }
}
