#!/usr/bin/env bash
set -euo pipefail

# Supervisor priority controls launch order, not readiness. A fixed sleep can
# expose nginx before PHP-FPM binds its socket on an autostarted Machine.
fpm_socket="${FPM_SOCKET:-/var/run/php/php-fpm.sock}"
startup_timeout="${FPM_STARTUP_TIMEOUT:-30}"
deadline=$((SECONDS + startup_timeout))

until php -r '
    $connection = @stream_socket_client("unix://".$argv[1], $errno, $error, 0.2);
    if ($connection === false) { exit(1); }
    fclose($connection);
' "$fpm_socket"; do
    if (( SECONDS >= deadline )); then
        echo "PHP-FPM did not become ready within ${startup_timeout}s; nginx will not accept requests." >&2
        exit 1
    fi
    sleep 0.1
done

echo "PHP-FPM socket is ready; starting nginx." >&2
exec nginx
