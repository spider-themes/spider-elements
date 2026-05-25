## 2025-01-23 - Syntax Verification Strategy
**Learning:** This repository lacks a Composer-based `phpcs` setup. Verification must rely on manual inspection or custom scripts invoking `php -l`.
**Action:** In future tasks, assume no linting infrastructure exists and verify changes with `php -l` or a custom pre-commit script.

## 2025-01-23 - Inconsistent Array Syntax
**Learning:** The codebase mixed `array()` and `[]` syntax heavily. This PR standardizes on `[]` for core files, but widget files likely remain inconsistent.
**Action:** Continue standardizing array syntax to `[]` in future cleanup tasks.

## 2025-01-23 - Filters File Responsibility
**Learning:** `includes/filters.php` is misnamed; it contains admin controller logic (form handling on `admin_init`).
**Action:** Be aware that "filter" changes might actually involve admin form processing logic.

## 2025-02-18 - Legacy Array Syntax & Freemius Mocking
**Learning:** The codebase contains a mix of `array()` and `[]` syntax, with `spider-elements.php` and `includes/Admin/Plugin_Installer.php` being key locations for legacy `array()` usage. The rest of the codebase generally adheres to `[]`.
**Action:** When working in older files, check for `array()` usage and convert to `[]` for consistency, but ensure to test thoroughly as some arrays are large configuration blocks.
**Learning:** `spider-elements.php` heavily relies on `spel_fs()` for Freemius integration and will try to load the full SDK if the function is not defined.
**Action:** When writing standalone verification scripts for `spider-elements.php`, always define a mock `spel_fs()` function *before* including the file to prevent the SDK from loading and causing fatal errors (e.g., missing dependencies or path issues).
