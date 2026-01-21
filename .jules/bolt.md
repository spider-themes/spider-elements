## 2024-05-23 - Lazy Loading Admin Heavy Classes
**Learning:** Heavy admin classes (e.g., `Plugin_Installer` which scans the filesystem) must not be instantiated unconditionally in `plugins_loaded` or `init`. They should be lazy-loaded or wrapped in `is_admin()`.
**Action:** When seeing unconditional `new ClassName()` in the main plugin file, always check what that class does. If it's admin-only or heavy, refactor to lazy load.
