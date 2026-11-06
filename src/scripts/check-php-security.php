<?php

// Minimum upstream releases fixing CVE-2026-109618 and CVE-2026-109619.
// https://www.ipa.go.jp/security/security-alert/2026/alert20261022.html
$minimumVersions = [
    '8.2' => '8.2.35',
    '8.3' => '8.3.36',
    '8.4' => '8.4.27',
    '8.5' => '8.5.12',
];
$branch = PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;
$minimum = $minimumVersions[$branch] ?? null;
if ($minimum === null || version_compare(PHP_VERSION, $minimum, '<')) {
    fwrite(STDERR, 'PHP security check failed: '.PHP_VERSION.'. Required: '.($minimum ?? 'a reviewed supported release').PHP_EOL);
    exit(1);
}
fwrite(STDOUT, 'PHP2shell version check passed: '.PHP_VERSION.PHP_EOL);
