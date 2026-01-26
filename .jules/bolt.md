## 2024-05-22 - Unconditional Filesystem Scans on Frontend
**Learning:** Found `get_plugins()` being triggered on every frontend page load via an unconditionally instantiated `Plugin_Installer` class. This is a heavy operation as it scans the filesystem.
**Action:** Always check where admin-related classes are instantiated. If they are in a global `init` hook, ensure they are wrapped in `is_admin()`, or better yet, lazy-load them only when their specific functionality is requested (e.g., via a singleton `instance()` call on the specific admin page).

## 2024-05-23 - Specific Plugin Check Optimization
**Learning:** `get_plugins()` scans and parses all plugin headers, which is O(N) and I/O heavy. When checking if a specific plugin is installed (e.g., for cross-promotion or dependency checks), `file_exists( WP_PLUGIN_DIR . '/path/to/plugin.php' )` is O(1) and significantly faster.
**Action:** Replace `get_plugins()` usage with `file_exists()` when verifying the existence of known plugins.
