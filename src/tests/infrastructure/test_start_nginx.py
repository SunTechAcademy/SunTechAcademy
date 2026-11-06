"""Check readiness gating without starting nginx or touching a live FPM worker."""
import os
from pathlib import Path
import socket
import subprocess
import tempfile
import time
import unittest

SCRIPT = Path(__file__).resolve().parents[2] / '.fly/start-nginx.sh'


class NginxReadinessTest(unittest.TestCase):
    def setUp(self):
        self.temp = tempfile.TemporaryDirectory(prefix='fpm-', dir='/tmp')
        self.root = Path(self.temp.name)
        self.sock = self.root / 'php.sock'
        self.marker = self.root / 'nginx-started'
        nginx = self.root / 'nginx'
        nginx.write_text('#!/bin/sh\ntouch "$NGINX_MARKER"\n')
        nginx.chmod(0o755)
        self.env = dict(os.environ, PATH=str(self.root)+os.pathsep+os.environ['PATH'],
                        FPM_SOCKET=str(self.sock), FPM_STARTUP_TIMEOUT='3', NGINX_MARKER=str(self.marker))

    def tearDown(self):
        self.temp.cleanup()

    def test_waits_until_fpm_listens_before_starting_nginx(self):
        process = subprocess.Popen(['bash', str(SCRIPT)], env=self.env, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
        try:
            time.sleep(.5)
            self.assertIsNone(process.poll())
            self.assertFalse(self.marker.exists())
            with socket.socket(socket.AF_UNIX) as server:
                server.bind(str(self.sock))
                server.listen()
                _, stderr = process.communicate(timeout=5)
            self.assertEqual(process.returncode, 0, stderr)
            self.assertTrue(self.marker.exists())
        finally:
            if process.poll() is None:
                process.kill()
                process.communicate()

    def test_stale_socket_does_not_count_as_ready(self):
        with socket.socket(socket.AF_UNIX) as server:
            server.bind(str(self.sock))
        self.assertTrue(self.sock.exists())
        self.env['FPM_STARTUP_TIMEOUT'] = '1'
        result = subprocess.run(['bash', str(SCRIPT)], env=self.env, capture_output=True, timeout=5)
        self.assertEqual(result.returncode, 1)
        self.assertFalse(self.marker.exists())

    def test_no_socket_times_out_without_starting_nginx(self):
        self.env['FPM_STARTUP_TIMEOUT'] = '1'
        result = subprocess.run(['bash', str(SCRIPT)], env=self.env, capture_output=True, timeout=5)
        self.assertEqual(result.returncode, 1)
        self.assertIn(b'PHP-FPM did not become ready', result.stderr)
        self.assertFalse(self.marker.exists())


if __name__ == '__main__':
    unittest.main()
