<style>
.course-page { --course-accent: #6974ad; --course-wash: #eff1fa; padding: 40px 24px 64px; background: #f7f8fc; color: #3c465f; }
.course-page.is-intermediate { --course-accent: #3e8574; --course-wash: #edf6f1; }
.course-container { max-width: 1180px; margin: auto; }
.course-hero { display: flex; align-items: center; justify-content: space-between; gap: 24px; margin-bottom: 28px; }
.course-eyebrow { font-size: 10px; letter-spacing: .16em; font-weight: 800; color: var(--course-accent); margin-bottom: 10px; }
.course-hero h1 { font-size: 28px; font-weight: 700; letter-spacing: -.035em; margin-bottom: 12px; }
.course-muted { color: #848c9e; font-size: 12px; line-height: 1.9; }
.course-button { display: inline-flex; justify-content: center; align-items: center; gap: 12px; border-radius: 12px; padding: 13px 18px; background: var(--course-accent); color: white; font-size: 12px; font-weight: 700; white-space: nowrap; transition: box-shadow .2s, transform .2s; }
.course-button:hover { transform: translateY(-2px); box-shadow: 0 6px 16px #343b6520; }
.course-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; margin-bottom: 24px; }
.course-stat { padding: 24px; background: white; border: 1px solid #e7eaf2; border-radius: 18px; }
.course-stat > p { color: #8790a4; font-size: 12px; margin-bottom: 12px; }
.course-stat strong { font-size: 30px; font-weight: 700; color: var(--course-accent); }
.course-stat small { font-size: 12px; color: #9097a8; margin-left: 5px; }
.course-progress { display: block; width: 100%; height: 7px; margin-top: 14px; border: 0; border-radius: 99px; overflow: hidden; background: #eff1f7; }
.course-progress::-webkit-progress-bar { background: #eff1f7; }
.course-progress::-webkit-progress-value { background: var(--course-accent); border-radius: 99px; }
.course-progress::-moz-progress-bar { background: var(--course-accent); }
.learning-activity { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; background: white; border: 1px solid #e7eaf2; border-radius: 22px; padding: 28px 32px; margin-bottom: 36px; scroll-margin-top: 20px; }
.activity-summary { align-self: center; }
.activity-summary h2 { font-size: 21px; font-weight: 700; }
.activity-total { color: var(--course-accent); margin: 14px 0 8px; font-size: 14px; }
.activity-total strong { font-size: 48px; font-weight: 700; }
.activity-total span { margin-left: 12px; font-size: 12px; color: #8a93a6; }
.activity-month-count { margin-top: 20px; display: flex; gap: 20px; font-size: 12px; color: #8790a2; }
.activity-month-count strong { color: var(--course-accent); }
.calendar-heading { display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; }
.calendar-heading h3 { font-size: 14px; font-weight: 700; }
.calendar-heading > div { display: flex; align-items: center; gap: 6px; }
.calendar-heading a, .calendar-disabled { display: grid; place-items: center; min-width: 32px; height: 32px; border-radius: 8px; font-size: 12px; color: var(--course-accent); }
.calendar-heading a:hover { background: var(--course-wash); }
.calendar-disabled { opacity: .25; }
.calendar-grid { display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 4px; }
.calendar-weekday { font-size: 10px; text-align: center; color: #9ba2b1; padding: 4px; }
.calendar-day { display: flex; align-items: center; justify-content: center; gap: 3px; min-height: 31px; border: 1px solid transparent; border-radius: 7px; font-size: 11px; color: #9198aa; }
.calendar-day small { font-size: 8px; }
.calendar-day.is-logged { background: var(--course-wash); color: var(--course-accent); font-weight: 700; }
.calendar-day.is-today { border-color: var(--course-accent); }
.calendar-day.is-future { opacity: .4; }
.calendar-legend { display: flex; flex-wrap: wrap; gap: 14px; font-size: 9px; color: #8d96a9; margin-top: 12px; }
.course-section-title { font-size: 20px; font-weight: 700; margin: 30px 0 18px; }
.lesson-card { border-radius: 20px; background: white; border: 1px solid #e7eaf2; padding: 26px; margin-bottom: 20px; }
.lesson-card-heading { display: flex; align-items: start; justify-content: space-between; gap: 20px; margin-bottom: 20px; }
.lesson-card h3 { font-size: 18px; font-weight: 700; }
.lesson-meta { flex-shrink: 0; text-align: right; font-size: 11px; line-height: 1.9; color: #929aac; }
.lesson-meta strong { display: block; color: var(--course-accent); }
.chapter-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 10px; }
.chapter-link { display: flex; align-items: center; gap: 12px; padding: 15px; border: 1px solid #eff0f6; border-radius: 12px; transition: background .2s, border-color .2s; }
.chapter-link:hover { background: var(--course-wash); border-color: #d9deef; }
.chapter-link-text { min-width: 0; flex: 1; font-size: 12px; line-height: 1.7; }
.chapter-link-text small { display: block; color: #8e97b4; font-size: 9px; margin-bottom: 3px; }
.chapter-state { font-size: 10px; color: #a3abbb; flex-shrink: 0; }
.chapter-state.done { color: var(--course-accent); background: var(--course-wash); border-radius: 7px; padding: 5px; }
.course-resource-grid, .course-phase-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
.course-resource, .course-phase { display: flex; flex-direction: column; padding: 24px; background: white; border: 1px solid #e5ece8; border-radius: 18px; transition: transform .2s, box-shadow .2s; }
.course-resource:hover, .course-phase:hover { transform: translateY(-3px); box-shadow: 0 10px 24px #3159490a; }
.course-resource h3, .course-phase h3 { font-size: 15px; font-weight: 700; margin-bottom: 12px; }
.course-card-action { margin-top: auto; padding-top: 20px; font-size: 11px; font-weight: 700; color: var(--course-accent); }
.course-quota { padding: 26px; margin: 28px 0; border-radius: 20px; background: var(--course-wash); }
.course-quota-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
.course-notice { padding: 16px; margin-bottom: 20px; border-radius: 12px; background: #fff0f3; color: #a24f68; font-size: 13px; }
.course-page a:focus-visible { outline: 3px solid var(--course-accent); outline-offset: 3px; }
@media (max-width: 900px) { .chapter-grid, .course-resource-grid, .course-phase-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 600px) { .course-page { padding: 28px 16px 40px; } .course-hero { align-items: start; flex-direction: column; } .course-hero h1 { font-size: 24px; } .course-stats { gap: 8px; } .course-stat { padding: 16px 12px; } .course-stat strong { font-size: 24px; } .learning-activity { grid-template-columns: 1fr; padding: 24px; gap: 24px; } .chapter-grid, .course-resource-grid, .course-phase-grid, .course-quota-grid { grid-template-columns: 1fr; } .lesson-card { padding: 20px; } .lesson-card-heading { flex-direction: column; gap: 8px; } .lesson-meta { text-align: left; } }
@media (prefers-reduced-motion: reduce) { .course-page * { transition: none !important; } .course-page a:hover { transform: none; } }
:is(.beginner-layout, .intermediate-layout) { display: grid; grid-template-columns: minmax(0, 1fr) 340px; align-items: start; gap: 24px; }
:is(.beginner-lessons, .intermediate-main) { min-width: 0; }
:is(.beginner-lessons, .intermediate-main) > .course-section-title:first-child { margin-top: 0; }
.intermediate-preparation + .course-section-title { margin-top: 40px; }
.beginner-lessons .chapter-grid, .intermediate-main .course-resource-grid, .intermediate-main .course-phase-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
:is(.beginner-sidebar, .intermediate-sidebar) { min-width: 0; }
:is(.beginner-sidebar, .intermediate-sidebar):focus-visible { outline: 3px solid var(--course-accent); outline-offset: 3px; border-radius: 18px; }
@media (min-width: 1024px) {
    :is(.beginner-sidebar, .intermediate-sidebar) { position: sticky; top: 24px; max-height: calc(100vh - 48px); max-height: calc(100dvh - 48px); overflow-y: auto; overscroll-behavior-y: contain; scrollbar-gutter: stable; scrollbar-width: thin; scrollbar-color: #c3c9df transparent; padding: 4px; scroll-padding-block: 12px; }
}
:is(.beginner-sidebar, .intermediate-sidebar) .course-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; margin-bottom: 16px; }
:is(.beginner-sidebar, .intermediate-sidebar) .course-stat { padding: 20px; }
:is(.beginner-sidebar, .intermediate-sidebar) .course-stat:first-child { grid-column: 1 / -1; }
:is(.beginner-sidebar, .intermediate-sidebar) .learning-activity { grid-template-columns: 1fr; padding: 24px; gap: 24px; margin-bottom: 0; }
:is(.beginner-sidebar, .intermediate-sidebar) .activity-summary h2 { font-size: 18px; }
.intermediate-sidebar .course-quota { padding: 20px; margin: 0 0 16px; }
.intermediate-sidebar .course-quota .course-section-title { font-size: 18px; }
.intermediate-sidebar .course-quota-grid { grid-template-columns: minmax(0, 1fr); gap: 12px; }
@media (max-width: 1023px) { :is(.beginner-layout, .intermediate-layout) { grid-template-columns: 1fr; } :is(.beginner-sidebar, .intermediate-sidebar) { grid-row: 1; } :is(.beginner-sidebar, .intermediate-sidebar) .course-stats { grid-template-columns: repeat(3, minmax(0, 1fr)); } :is(.beginner-sidebar, .intermediate-sidebar) .course-stat:first-child { grid-column: auto; } :is(.beginner-sidebar, .intermediate-sidebar) .learning-activity { grid-template-columns: 1fr 1fr; } }
@media (max-width: 600px) { :is(.beginner-sidebar, .intermediate-sidebar) .course-stat { padding: 16px 12px; } :is(.beginner-sidebar, .intermediate-sidebar) .learning-activity, .beginner-lessons .chapter-grid, .intermediate-main .course-resource-grid, .intermediate-main .course-phase-grid { grid-template-columns: 1fr; } }
.lesson-card-completed {
    border: 2px solid transparent;
    background: linear-gradient(115deg, #fff5fb, #f9f6ff 35%, #f0fbff 67%, #f4fff4) padding-box,
        linear-gradient(115deg, #f18fbe, #b29bf0 28%, #79bdf1 52%, #74d6bd 75%, #efcf75) border-box;
    box-shadow: 0 8px 26px #a58cd61a;
}
.lesson-achievement { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; padding-bottom: 18px; margin-bottom: 20px; border-bottom: 1px solid #dcdaf05c; }
.lesson-achievement-badge { display: inline-flex; align-items: center; gap: 7px; padding: 7px 12px; border-radius: 99px; color: #534678; background: linear-gradient(110deg, #fad8e9, #e4dafa, #cceaf9, #d9f3e2, #fff0ce); font-size: 11px; font-weight: 800; box-shadow: 0 2px 8px #a58cd612; }
.lesson-achievement-message { font-size: 11px; color: #87749f; }
.lesson-achievement-message > span { color: #b28bcd; margin-right: 4px; }
.lesson-card-completed .chapter-link { background: #ffffffb8; border-color: #ffffff; }
.lesson-card-completed .chapter-link:hover { background: #fff; border-color: #cfc7ef; }
.lesson-card-completed .chapter-state.done { background: #ede7fa; color: #76609d; }
.course-stat-achieved { border: 1px solid transparent; background: linear-gradient(120deg, #fff3fa, #f5f2ff 40%, #effbff 70%, #f4fff3) padding-box, linear-gradient(115deg, #f18fbe, #b29bf0, #79bdf1, #74d6bd, #efcf75) border-box; box-shadow: 0 6px 20px #a58cd615; }
.course-stat-achieved strong { color: #7760a5; }
.stat-achievement { display: inline-block; margin-bottom: 12px; padding: 5px 8px; border-radius: 8px; background: linear-gradient(110deg, #fad8e9, #e4dafa, #cceaf9, #d9f3e2); color: #594979; font-size: 10px; font-weight: 800; }
.course-stat-achieved .course-progress::-webkit-progress-value { background: linear-gradient(90deg, #ed9ac1, #b29bf0, #79bdf1, #74d6bd, #efcf75); }
.course-stat-achieved .course-progress::-moz-progress-bar { background: linear-gradient(90deg, #ed9ac1, #b29bf0, #79bdf1, #74d6bd, #efcf75); }
.intermediate-preparation { display: flex; flex-direction: column; background: #fff; border: 1px solid #e6ece9; border-radius: 20px; padding: 8px 24px; }
.intermediate-preparation .course-resource { display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 6px 20px; padding: 20px 0; border: 0; border-bottom: 1px solid #edf1ee; border-radius: 0; box-shadow: none; background: transparent; }
.intermediate-preparation .course-resource:last-child { border-bottom: 0; }
.intermediate-preparation .course-eyebrow { grid-column: 1; margin: 0; }
.intermediate-preparation h3 { grid-column: 1; margin: 0; }
.intermediate-preparation .course-muted { grid-column: 1; margin: 0; }
.intermediate-preparation .course-card-action { grid-column: 2; grid-row: 1 / 4; align-self: center; margin: 0; font-size: 12px; }
@media(max-width:600px) { .intermediate-preparation { padding: 4px 18px; } .intermediate-preparation .course-resource { grid-template-columns: minmax(0, 1fr); } .intermediate-preparation .course-card-action { grid-column: 1; grid-row: auto; margin-top: 8px; } }
.intermediate-sidebar .course-stats > .course-stat:only-child { grid-column: 1 / -1; }
</style>
