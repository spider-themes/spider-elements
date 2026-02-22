## 2025-01-23 - Syntax Verification Strategy
**Learning:** This repository lacks a Composer-based `phpcs` setup. Verification must rely on manual inspection or custom scripts invoking `php -l`.
**Action:** In future tasks, assume no linting infrastructure exists and verify changes with `php -l` or a custom pre-commit script.

## 2025-01-23 - Inconsistent Array Syntax
**Learning:** The codebase mixed `array()` and `[]` syntax heavily. This PR standardizes on `[]` for core files, but widget files likely remain inconsistent.
**Action:** Continue standardizing array syntax to `[]` in future cleanup tasks.

## 2025-01-23 - Filters File Responsibility
**Learning:** `includes/filters.php` is misnamed; it contains admin controller logic (form handling on `admin_init`).
**Action:** Be aware that "filter" changes might actually involve admin form processing logic.

## 2025-01-23 - Widget Rendering Pattern
**Learning:** Widgets heavily relied on `extract( $settings )`, polluting the symbol table and obscuring variable origins. Render methods have been refactored to use direct array access (e.g., `$settings['key']`).
**Action:** When adding or modifying widgets, avoid `extract()`. Explicitly define variables derived from settings to maintain clarity and security.
