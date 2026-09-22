# Security Audit — 2026-09-03

## Addendum - 2026-09-22

See `CLEANUP_REPORT.md` for the current local cleanup and validation results.
Seven attack artifacts remaining in the old quarantine were deleted after
recording their hashes. The Hostinger CAPTCHA block was removed from both the
active root configuration and its recovery baseline. Historical findings and
dependency advisory counts below have not been re-audited against current feeds.

## Addendum - 2026-09-04

- Found a second copy of the `sql-query.php` web shell disguised as the broken
  Git remote ref `.git/refs/remotes/origin/sql-query.php`; moved it to
  `storage/app/quarantine/compromise-2026-09-03/git-ref-sql-query.php`.
- Restored and expanded both root and `public/` Apache rules. They now reject
  `/files/discover`, common WordPress/scanner probes, dotfiles, framework and
  dependency directories, backups, and executable scripts other than the
  Laravel front controller.
- Added execution-deny `.htaccess` files to legacy `/files` and
  `storage/app/public` upload locations.
- Added a 240 requests/minute per-IP application ceiling, dual login limits
  (per IP and per account), and limits for chat polling and CAPTCHA refresh.
- Source scan found no remaining known web-shell signatures outside quarantine
  and Git metadata. This does not prove the hosting account or deployed server
  clean; credential rotation and clean redeployment remain mandatory.

## A. Executive Summary

Status: **confirmed compromise**. The source tree contained multiple active web shells, remote-code loaders, a Tiny File Manager installation with authentication disabled, and an `.htaccess` cookie bypass. All confirmed attacker artifacts were moved outside the web root to `storage/app/quarantine/compromise-2026-09-03/`. No secrets are included in this report.

The likely initial access route cannot be proven from source alone. Because the attacker had write access, rotate all credentials and investigate hosting, FTP/SFTP, control-panel, SSH, and deployment logs before redeploying.

## B. Suspicious Files

| Original path | Finding | Severity | Action |
| --- | --- | --- | --- |
| `.htaccetzt` | Tiny File Manager 2.4.3, authentication disabled, full document-root file access | CRITICAL | Quarantined |
| `public/images/berita/grock.php` | Tiny File Manager exposed in a public upload directory | CRITICAL | Quarantined |
| `app/Models/rock.php` | Obfuscated web shell with Base64 payload and `eval` | CRITICAL | Quarantined |
| `app/Models/rock.zip` | Archive containing `rock.php` shell | CRITICAL | Quarantined |
| `app/Models/wsv2.zip` | Archive containing `wsv2.php` shell | CRITICAL | Quarantined |
| `app/Models/._divitaz.php` | WordPress-themed file-manager shell; cookie/query bypass, upload, filesystem, and command execution | CRITICAL | Quarantined |
| `database/migrations/wp-admin-blog.php` | Remote PHP downloader executed with `eval` | CRITICAL | Quarantined |
| `fonts/PT_Sans/alpe.php` | Large attacker web-shell payload hidden among fonts | CRITICAL | Quarantined |
| `fonts/PT_Sans/wxvalpe.php` | Downloads remote code from GitHub and evaluates it | CRITICAL | Quarantined |
| `.htaccess` | `kasih30` query parameter set an `unlock_site` cookie bypass; contained attacker allow-list logic | CRITICAL | Replaced |

## C. Vulnerabilities Found

### Critical

- Public web shells, arbitrary upload/write capability, command execution, and remote-code execution were present.
- The root `.htaccess` included a secret query/cookie bypass and attacker-controlled routing behavior.

### High

- Composer audit reports 42 advisories across 14 locked packages. High-priority packages include `laravel/framework`, `league/commonmark`, `guzzlehttp/guzzle`, `symfony/http-kernel`, `symfony/mime`, and development tools such as `phpunit`.
- Public contact and live-chat POST endpoints did not have application rate limits.

### Medium

- Rich HTML is intentionally rendered for leadership profiles and news. Current `strip_tags` is not a robust HTML sanitizer; use an allowlist sanitizer before accepting rich text.
- The frontend uses `innerHTML` in several templates. Live-chat output is escaped before rendering; other instances should retain this discipline and only interpolate trusted/static values.
- Uploads use extension/MIME validation and generated names, but several legacy media locations are inside the document root. The new Apache rule provides defense in depth; moving media fully outside the document root is recommended.

### Low

- Test configuration uses SQLite in memory while a migration uses MySQL-only `ALTER TABLE ... MODIFY`; this prevents a full automated test run and must be fixed before adding/running database-backed security feature tests.

## D. Changes Performed

- Replaced root `.htaccess` with Laravel routing, disabled directory listings, blocked PHP-like files except `index.php`, blocked secrets/backups/VCS metadata, and added compatible baseline security headers.
- Removed all user-agent, Googlebot, query-string, cookie, and WordPress bypass behavior from active configuration.
- Added named Laravel rate limits for login, password reset, contact, chat start, and chat messages.
- Tightened Contact and Live Chat server-side validation and message lengths; contact responses no longer echo submitted content.
- Set explicit production session cookie settings: secure, HTTP-only, and SameSite=Lax.

## E. Files Deleted/Quarantined

No confirmed malware was permanently deleted. The files listed in section B were moved to `storage/app/quarantine/compromise-2026-09-03/`, which must remain outside any public symlink and be removed only after an evidence-retention decision.

## F. Security Hardening Added

- Apache denies executable PHP/PHTML/PHAR files other than the Laravel front controller.
- Apache blocks `.env`, `.git`, lock/manifest files, logs, backup/database dumps, and framework cache paths.
- Security headers: `X-Content-Type-Options`, `Referrer-Policy`, `X-Frame-Options`, and `Permissions-Policy`.
- CSRF remains enabled through Laravel's web middleware; all reviewed public writes are web routes.
- Admin routes require authentication, role middleware, and module-access authorization.

## G. Dependency Vulnerabilities

`composer audit` completed and found 42 advisories affecting 14 packages. Upgrade within compatible Laravel 12 constraints, regenerate `composer.lock`, rerun the audit, and regression-test before deployment. `npm audit --omit=dev` found **0 production JavaScript vulnerabilities**.

## H. Not Verifiable from Source

- Hosting-panel/FTP/SFTP/SSH accounts, permissions, access logs, and server process history.
- System cron jobs, web-server vhost configuration, global PHP configuration, and other sites sharing the same account.
- Integrity of deployed `vendor/` files versus a clean `composer install` from the lockfile.
- Database content, including whether attacker-created users or injected content remain.

## I. Manual Server-Side Actions Required

1. Put the site in maintenance mode during cleanup and preserve an offline forensic copy.
2. Rotate hosting-panel, SSH, FTP/SFTP, database, mail, API, and Laravel `APP_KEY` credentials; invalidate sessions after rotating `APP_KEY`.
3. Inspect/remove server cron jobs, `crontab`, `.user.ini`, `php.ini`, Apache/Nginx vhosts, `auto_prepend_file`, and scheduled tasks.
4. Deploy a clean build from trusted source; delete and reinstall `vendor/` and frontend dependencies from lockfiles on the server.
5. Set the web-server document root to Laravel `public/` only. Do not serve the repository root.
6. Ensure web-server write permission is limited to `storage/` and `bootstrap/cache/`; application source and public assets must be deployment-owned/read-only.
7. Check database users/admin accounts and scan stored HTML/content for injected scripts or spam.

## J. Post-Deployment Recommendations

- Apply compatible dependency patches immediately, then re-run Composer and npm audits.
- Add a strict Content-Security-Policy in report-only mode first, because the site currently depends on multiple inline scripts and external CDNs.
- Replace `strip_tags` with a maintained allowlist HTML sanitizer for rich-text fields.
- Add database-backed feature tests for CSRF, throttling, authorization, rejected PHP/double extensions, invalid MIME/oversize uploads, path traversal, and chat/contact XSS payloads.
- Monitor 404s for the quarantined names and suspicious PHP requests; alert on source-file changes and unexpected PHP files in writable paths.
