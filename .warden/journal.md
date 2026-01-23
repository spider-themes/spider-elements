## 2025-01-23 - Syntax Verification Strategy
**Learning:** This repository lacks a Composer-based `phpcs` setup. Verification must rely on manual inspection or custom scripts invoking `php -l`.
**Action:** In future tasks, assume no linting infrastructure exists and verify changes with `php -l` or a custom pre-commit script.

## 2025-01-23 - Inconsistent Array Syntax
**Learning:** The codebase mixed `array()` and `[]` syntax heavily. This PR standardizes on `[]` for core files, but widget files likely remain inconsistent.
**Action:** Continue standardizing array syntax to `[]` in future cleanup tasks.

## 2025-01-23 - Filters File Responsibility
**Learning:** `includes/filters.php` is misnamed; it contains admin controller logic (form handling on `admin_init`).
**Action:** Be aware that "filter" changes might actually involve admin form processing logic.
