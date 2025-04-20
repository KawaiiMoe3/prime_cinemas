<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DateController extends Controller
{
    /**
     * Dynamic Date Tabs Generated API
     * 
     * This API dynamically generates the next 12 days, including today.
     * The first date is labeled as "Today" while the rest show the day and date.
     */
    public function getDates()
    {
        $dates = [];
        $today = Carbon::today();

        for ($i = 0; $i < 12; $i++) {
            $date = $today->copy()->addDays($i);
            $dates[] = [
                'day' => $date->format('D'), 
                'date' => $date->format('d'), 
                'month' => $date->format('M'), 
                'full_date' => $date->toDateString(), 
                'is_today' => $i === 0 
            ];
        }

        return response()->json($dates);
    }
}
