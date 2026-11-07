<?php

namespace App\View\Components;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class LearningActivity extends Component
{
    public function __construct(public ?\App\Models\User $user = null)
    {
        if ($user && $user->id !== Auth::id()) {
            \Illuminate\Support\Facades\Gate::authorize('view-user-progress');
        }
    }

    public function render()
    {
        $today = CarbonImmutable::today();
        $requestedMonth = request()->query('month');
        $month = is_string($requestedMonth) && preg_match('/^(20\d{2})-(0[1-9]|1[0-2])$/D', $requestedMonth)
            ? CarbonImmutable::createFromFormat('!Y-m', $requestedMonth) : $today->startOfMonth();
        if ($month->greaterThan($today)) {
            $month = $today->startOfMonth();
        }
        $dates = ($this->user ?? Auth::user())->loginHistories()->distinct()->pluck('login_date')->all();
        $loggedDays = array_fill_keys($dates, true);
        $totalLoginDays = count($loggedDays);
        $monthlyCount = count(array_filter($dates, fn ($date) => str_starts_with($date, $month->format('Y-m'))));
        return view('components.learning-activity', compact('today', 'month', 'loggedDays', 'totalLoginDays', 'monthlyCount'));
    }
}
