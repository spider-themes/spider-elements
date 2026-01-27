## 2024-05-23 - Legacy Array Syntax & Docblock Gaps
**Learning:** The codebase frequently mixes `array()` and `[]` syntax, sometimes within the same file. Also, many utility functions in `includes/functions.php` lack Docblocks.
**Action:** When touching legacy files, enforce `[]` syntax for consistency and add missing Docblocks to functions in the immediate scope of changes.

## 2024-05-23 - Logic Error in spel_readable_number
**Learning:** The unit conversion logic in `spel_readable_number` incorrectly multiplies by 1024 regardless of the suffix (e.g., treating '1M' as 1024 bytes instead of 1024*1024).
**Action:** Do not "fix" this in a formatting/quality PR as it constitutes a behavioral change. This requires a dedicated bugfix PR.
## 2025-01-23 - Syntax Verification Strategy
**Learning:** This repository lacks a Composer-based `phpcs` setup. Verification must rely on manual inspection or custom scripts invoking `php -l`.
**Action:** In future tasks, assume no linting infrastructure exists and verify changes with `php -l` or a custom pre-commit script.

## 2025-01-23 - Inconsistent Array Syntax
**Learning:** The codebase mixed `array()` and `[]` syntax heavily. This PR standardizes on `[]` for core files, but widget files likely remain inconsistent.
**Action:** Continue standardizing array syntax to `[]` in future cleanup tasks.

## 2025-01-23 - Filters File Responsibility
**Learning:** `includes/filters.php` is misnamed; it contains admin controller logic (form handling on `admin_init`).
**Action:** Be aware that "filter" changes might actually involve admin form processing logic.
