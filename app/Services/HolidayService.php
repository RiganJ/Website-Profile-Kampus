<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HolidayService
{
    public function isHoliday(Carbon $date): bool
    {
        $year = $date->year;

        $holidays = Cache::remember(
            "holidays_{$year}",
            now()->addDays(7),
            function () use ($year) {

                $response = Http::timeout(10)
                    ->get("https://date.nager.at/api/v3/PublicHolidays/{$year}/ID");

                if (!$response->successful()) {
                    return [];
                }

                return $response->json();
            }
        );

        return collect($holidays)
            ->pluck('date')
            ->contains($date->format('Y-m-d'));
    }

    public function isCampusOpen(): bool
    {
        $today = Carbon::today();

        if ($today->isSunday()) {
            return false;
        }

        return !$this->isHoliday($today);
    }
}