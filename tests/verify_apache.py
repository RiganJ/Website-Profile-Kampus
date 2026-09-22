"""Smoke-test the actual shared-hosting rewrite rules using local XAMPP Apache."""
import json
import os
from pathlib import Path
import socket
import subprocess
import tempfile
import time
import urllib.error
import urllib.request

root = Path(__file__).resolve().parents[1]
apache = Path(os.environ.get('APACHE_HOME', 'C:/xampp/apache'))
with socket.socket() as sock:
    sock.bind(('127.0.0.1', 0))
    port = sock.getsockname()[1]

with tempfile.TemporaryDirectory(prefix='apache-audit-', dir=root / 'storage/framework') as temporary:
    directory = Path(temporary)
    config = directory / 'httpd.conf'
    modules = ['authz_core', 'authz_host', 'mime', 'dir', 'headers', 'rewrite']
    config.write_text('\n'.join([
        f'ServerRoot "{apache.as_posix()}"',
        f'Listen 127.0.0.1:{port}',
        f'ServerName localhost:{port}',
        f'PidFile "{directory.as_posix()}/httpd.pid"',
        f'ErrorLog "{directory.as_posix()}/error.log"',
        *[f'LoadModule {name}_module modules/mod_{name}.so' for name in modules],
        f'TypesConfig "{apache.as_posix()}/conf/mime.types"',
        f'DocumentRoot "{root.as_posix()}"',
        f'<Directory "{root.as_posix()}">',
        '    AllowOverride All',
        '    Require all granted',
        '</Directory>',
        # This server only tests static resources and access rules, never PHP.
        '<FilesMatch "\\.php$">',
        '    Require all denied',
        '</FilesMatch>',
    ]), encoding='utf-8')
    process = subprocess.Popen(
        [str(apache / 'bin/httpd.exe'), '-X', '-f', str(config)],
        stdout=subprocess.DEVNULL, stderr=subprocess.PIPE,
        creationflags=getattr(subprocess, 'CREATE_NO_WINDOW', 0),
    )
    try:
        for _ in range(100):
            if process.poll() is not None:
                raise RuntimeError(process.stderr.read().decode(errors='replace'))
            try:
                with socket.create_connection(('127.0.0.1', port), timeout=.2):
                    break
            except OSError:
                time.sleep(.1)
        else:
            raise RuntimeError('Apache did not start.')

        manifest = json.loads((root / 'build/manifest.json').read_text())
        checks = {
            '/vendors/css/vendor.bundle.base.css': 200,
            '/vendors/js/vendor.bundle.base.js': 200,
            '/images/ufdk-site-icon.webp': 200,
            '/build/' + manifest['resources/css/app.css']['file']: 200,
            '/build/' + manifest['resources/css/inspired-campus.css']['file']: 200,
            '/.env': 403,
            '/.git/config': 403,
            '/vendor/autoload.php': 403,
            '/storage/app/integrity-baseline/.env': 403,
            '/storage/app/quarantine/removed-artifacts-2026-09-22.json': 403,
            '/files/discover': 403,
            '/hot': 403,
        }
        for url, expected in checks.items():
            try:
                with urllib.request.urlopen(f'http://127.0.0.1:{port}{url}', timeout=5) as response:
                    status = response.status
            except urllib.error.HTTPError as error:
                status = error.code
            assert status == expected, f'{url}: expected {expected}, got {status}'
            print(f'{status} {url}')
        print(f'Passed {len(checks)} Apache checks.')
    finally:
        process.terminate()
        process.communicate(timeout=10)
