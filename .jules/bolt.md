## 2024-05-22 - Unconditional Filesystem Scans on Frontend
**Learning:** Found `get_plugins()` being triggered on every frontend page load via an unconditionally instantiated `Plugin_Installer` class. This is a heavy operation as it scans the filesystem.
**Action:** Always check where admin-related classes are instantiated. If they are in a global `init` hook, ensure they are wrapped in `is_admin()`, or better yet, lazy-load them only when their specific functionality is requested (e.g., via a singleton `instance()` call on the specific admin page).

## 2024-05-24 - Large Configuration Arrays on Frontend
**Learning:** `Module_Settings.php` contained large configuration arrays used only for the Admin Dashboard UI but was being loaded on every frontend request.
**Action:** Identify classes that serve purely configuration purposes for the Admin UI and conditionally load them using `is_admin()`, verifying they are not required for frontend rendering (e.g., via `get_option` vs class constants).
