## 2024-05-22 - Unconditional Filesystem Scans on Frontend
**Learning:** Found `get_plugins()` being triggered on every frontend page load via an unconditionally instantiated `Plugin_Installer` class. This is a heavy operation as it scans the filesystem.
**Action:** Always check where admin-related classes are instantiated. If they are in a global `init` hook, ensure they are wrapped in `is_admin()`, or better yet, lazy-load them only when their specific functionality is requested (e.g., via a singleton `instance()` call on the specific admin page).

## 2024-10-25 - Unconditional Admin Class Loading
**Learning:** The `Plugin_Installer` class, which performs a heavy `get_plugins()` filesystem scan, was being loaded on every request (including frontend) via `spider-elements.php`.
**Action:** Always check main plugin file includes and wrap admin-specific classes (especially those in `includes/Admin/`) with `is_admin()` checks, verifying they aren't needed on the frontend.

## 2024-10-24 - Unnecessary Admin File Loading
**Learning:** `includes/Admin/Module_Settings.php` and `includes/Admin/Plugin_Installer.php` were loaded unconditionally. Even without instantiation, parsing these files adds overhead.
**Action:** Wrapped the `require_once` calls in `if ( is_admin() )` to ensure they are only loaded when needed.

## 2024-10-25 - Early Theme Initialization
**Learning:** `wp_get_theme()` was called in the plugin's `__construct` (via `core_includes`), forcing theme initialization before `plugins_loaded`. This is premature and adds overhead on every request.
**Action:** Moved the logic dependent on `wp_get_theme()` to the `init_plugin` method (hooked to `plugins_loaded`) and lazy-loaded the dependent classes (`Heading_Highlighted`, `Features_Badge`) only when their specific features are enabled.
