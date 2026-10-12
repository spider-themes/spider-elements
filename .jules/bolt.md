## 2024-05-22 - Unconditional Filesystem Scans on Frontend
**Learning:** Found `get_plugins()` being triggered on every frontend page load via an unconditionally instantiated `Plugin_Installer` class. This is a heavy operation as it scans the filesystem.
**Action:** Always check where admin-related classes are instantiated. If they are in a global `init` hook, ensure they are wrapped in `is_admin()`, or better yet, lazy-load them only when their specific functionality is requested (e.g., via a singleton `instance()` call on the specific admin page).

## 2024-10-25 - Unconditional Admin Class Loading
**Learning:** The `Plugin_Installer` class, which performs a heavy `get_plugins()` filesystem scan, was being loaded on every request (including frontend) via `spider-elements.php`.
**Action:** Always check main plugin file includes and wrap admin-specific classes (especially those in `includes/Admin/`) with `is_admin()` checks, verifying they aren't needed on the frontend.

## 2024-10-24 - Unnecessary Admin File Loading
**Learning:** `includes/Admin/Module_Settings.php` and `includes/Admin/Plugin_Installer.php` were loaded unconditionally. Even without instantiation, parsing these files adds overhead.
**Action:** Wrapped the `require_once` calls in `if ( is_admin() )` to ensure they are only loaded when needed.

## 2024-10-25 - Efficient WP_Query for Lists
**Learning:** `WP_Query` defaults to `SQL_CALC_FOUND_ROWS` and priming meta/term caches, which is wasteful for simple ID/Title dropdown lists. This is especially impactful when querying all posts (`posts_per_page => -1`).
**Action:** Use `'no_found_rows' => true`, `'update_post_meta_cache' => false`, and `'update_post_term_cache' => false` when only IDs and titles are needed. Also iterate `$query->posts` directly to avoid `the_post()` global state overhead.
