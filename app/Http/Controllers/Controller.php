<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function shortenText($text, $len)
    {
        $words = explode(' ', $text);
        if (count($words) > $len) {
            $words = array_slice($words, 0, $len);
            $text = join(" ", $words) . " ...";
        }
        return $text;
    }

    public function fixClassInformation($i3class)
    {
        if (json_decode($i3class->weekdays, true)) {
            $i3class->weekdays = join(" . ", json_decode($i3class->weekdays, true));
        } else {
            $i3class->weekdays = '';
        }
        $i3class->capacity = tr_num($i3class->capacity, 'fa');
        $i3class->start_date = tr_num($i3class->start_date, 'fa');
        $i3class->start_time = tr_num(date("H:i", strtotime($i3class->start_time)), 'fa');
        $i3class->end_time = tr_num(date("H:i", strtotime($i3class->end_time)), 'fa');
        $i3class->time = tr_num($i3class->time, "fa");

        if(!is_null($i3class->price)) $i3class->price = tr_num(number_format($i3class->price), "fa");

        return $i3class;
    }
}
