## 2025-01-23 - Syntax Verification Strategy
**Learning:** This repository lacks a Composer-based `phpcs` setup. Verification must rely on manual inspection or custom scripts invoking `php -l`.
**Action:** In future tasks, assume no linting infrastructure exists and verify changes with `php -l` or a custom pre-commit script.

## 2025-01-23 - Inconsistent Array Syntax
**Learning:** The codebase mixed `array()` and `[]` syntax heavily. This PR standardizes on `[]` for core files, but widget files likely remain inconsistent.
**Action:** Continue standardizing array syntax to `[]` in future cleanup tasks.

## 2025-01-23 - Filters File Responsibility
**Learning:** `includes/filters.php` is misnamed; it contains admin controller logic (form handling on `admin_init`).
**Action:** Be aware that "filter" changes might actually involve admin form processing logic.

## 2025-01-23 - Widget Template Variable Usage
**Learning:** Widget templates in this codebase have inconsistent variable dependencies. Some (`Tabs`, `Team_Carousel`) rely on variables extracted from `$settings`, while others (`Video_Popup`, `Video_Playlist`) use `$settings` directly.
**Action:** When refactoring `render()` methods, inspecting the corresponding template is mandatory to determine if variables need to be explicitly defined after removing `extract()`.

## 2025-01-23 - Video Playlist Settings Retrieval
**Learning:** The `Video_Playlist` widget uses `get_settings()` (raw settings) instead of `get_settings_for_display()` in its `render()` method, unlike other widgets.
**Action:** Preserve this behavior when refactoring to avoid breaking dynamic functionality or repeater handling in that specific widget.
