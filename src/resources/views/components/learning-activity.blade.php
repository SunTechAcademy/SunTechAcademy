<section class="learning-activity" id="login-calendar" aria-labelledby="activity-title">
    <div class="activity-summary">
        <p class="course-eyebrow">YOUR LEARNING RHYTHM</p>
        <h2 id="activity-title">積み重ねが、力になる。</h2>
        <p class="activity-total"><strong>{{ $totalLoginDays }}</strong> 日 <span>累計ログイン日数</span></p>
        <p class="course-muted">{{ $totalLoginDays > 0 ? 'これまでの一歩が、着実に積み重なっています。' : '今日から、また新しい一歩を始めよう。' }}</p>
        <div class="activity-month-count">表示月のログイン <strong>{{ $monthlyCount }} 日</strong></div>
    </div>
    <div class="activity-calendar">
        <div class="calendar-heading">
            <h3>{{ $month->format('Y年n月') }}</h3>
            <div>
                <a href="{{ request()->fullUrlWithQuery(['month' => $month->subMonth()->format('Y-m')]) }}#login-calendar" aria-label="前の月">‹</a>
                <a href="{{ request()->fullUrlWithQuery(['month' => $today->format('Y-m')]) }}#login-calendar">今月</a>
                @if($month->format('Y-m') < $today->format('Y-m'))
                    <a href="{{ request()->fullUrlWithQuery(['month' => $month->addMonth()->format('Y-m')]) }}#login-calendar" aria-label="次の月">›</a>
                @else
                    <span class="calendar-disabled" aria-hidden="true">›</span>
                @endif
            </div>
        </div>
        <div class="calendar-grid">
            @foreach(['日', '月', '火', '水', '木', '金', '土'] as $weekday)<span class="calendar-weekday">{{ $weekday }}</span>@endforeach
            @for($blank = 0; $blank < $month->dayOfWeek; $blank++)<span aria-hidden="true"></span>@endfor
            @for($day = 1; $day <= $month->daysInMonth; $day++)
                @php
                    $date = $month->day($day);
                    $logged = isset($loggedDays[$date->toDateString()]);
                    $isToday = $date->isSameDay($today);
                @endphp
                <span class="calendar-day {{ $logged ? 'is-logged' : '' }} {{ $isToday ? 'is-today' : '' }} {{ $date->greaterThan($today) ? 'is-future' : '' }}" title="{{ $date->format('Y/m/d') }}：{{ $logged ? 'ログインあり' : ($date->greaterThan($today) ? 'これから' : 'ログイン記録なし') }}" aria-label="{{ $date->format('n月j日') }} {{ $isToday ? '今日 ' : '' }}{{ $logged ? 'ログインあり' : ($date->greaterThan($today) ? 'これから' : 'ログイン記録なし') }}">{{ $day }}<small aria-hidden="true">{{ $logged ? '✓' : '' }}</small></span>
            @endfor
        </div>
        <p class="calendar-legend"><span>✓ ログインした日</span><span>枠線：今日</span><span>記録基準：{{ config('app.timezone') }}</span></p>
    </div>
</section>
