## 2024-05-22 - Optimizing Plugin Installer Loading
**Learning:** The `Plugin_Installer` class was being instantiated on every request (including frontend) but is only used in the Admin Dashboard. This caused unnecessary filesystem I/O (`get_plugins()` scanning the plugins directory) and memory usage on every page load.
**Action:** Wrapped the inclusion and instantiation of `Plugin_Installer` in `is_admin()` check to ensure it only runs when needed.
