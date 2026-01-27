## 2026-01-22 - WPCS & Logic Fixes
**Learning:** Found misuse of `wp_kses_post` for attribute escaping which potentially breaks `class` attributes containing spaces or special characters when constructed as a string. Also found broken logic in file size conversion.
**Action:** Use `esc_attr()` for attributes and verify logic of helper functions during review.
