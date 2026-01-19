## 2024-05-23 - Admin Classes on Frontend
**Learning:** Always check instantiation context for admin-specific classes.
**Action:** Verify if classes in `includes/Admin/` are being instantiated unconditionally in the main plugin file.
**Insight:** `Plugin_Installer` was running `get_plugins()` (filesystem scan) on every frontend request because it was instantiated globally, despite being an admin utility.
