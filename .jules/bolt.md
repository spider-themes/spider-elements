## 2024-05-22 - Unconditional Filesystem Scans on Frontend
**Learning:** Found `get_plugins()` being triggered on every frontend page load via an unconditionally instantiated `Plugin_Installer` class. This is a heavy operation as it scans the filesystem.
**Action:** Always check where admin-related classes are instantiated. If they are in a global `init` hook, ensure they are wrapped in `is_admin()`, or better yet, lazy-load them only when their specific functionality is requested (e.g., via a singleton `instance()` call on the specific admin page).

## 2024-10-24 - Unnecessary Admin File Loading
**Learning:** `includes/Admin/Module_Settings.php` and `includes/Admin/Plugin_Installer.php` were loaded unconditionally. Even without instantiation, parsing these files adds overhead.
**Action:** Wrapped the `require_once` calls in `if ( is_admin() )` to ensure they are only loaded when needed.
