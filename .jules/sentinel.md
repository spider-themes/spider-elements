## 2024-05-22 - Unsafe Custom Attribute Parsing
**Vulnerability:**
Many Elementor widgets and page builder addons implement a "Custom Attributes" field that parses a string like `key|value,key2|value2`.
I found that the `spel_button_link` function blindly exploded this string and output attributes without validating the keys.
This allowed attackers to inject:
1. Event handlers (e.g., `onclick|alert(1)` -> `onclick="alert(1)"`).
2. Duplicate `href` or `src` attributes to override the intended link (e.g., `href|javascript:alert(1)`).

**Learning:**
Developers often assume that "Custom Attributes" are for harmless things like `data-wow-delay` or `aria-label`.
However, without a blacklist or whitelist, they become a vector for XSS and DOM manipulation.
Using `esc_attr()` on the key and value is NOT enough because `esc_attr('onclick')` is still `onclick`.

**Prevention:**
When parsing custom attributes from user input:
1. **Validate the Key:** Ensure the attribute name is safe.
   - Blacklist: `on*`, `action`, `formaction`, `href`, `src`, `rel`, `target`.
   - Or Whitelist: Only allow `data-*`, `aria-*`, `title`, `class`, `id`.
2. **Handle Edge Cases:** Ensure `explode` has enough parts before accessing indexes to avoid PHP notices.
3. **Defense in Depth:** Even if the input field is restricted to admins, protecting the output function guards against privilege escalation or DB compromises.

## 2024-05-23 - `extract($settings)` Pollution in Elementor Widgets
**Vulnerability:**
Extensive use of `extract($settings)` in widget `render()` methods was observed.
This PHP function imports variables from an array into the current symbol table.
Since `$settings` is derived from user input (Elementor controls), this theoretically allows variable overwriting.
While often mitigated by subsequent variable re-assignment, it introduces:
1.  **Fragility:** New controls added later might accidentally overwrite internal logic variables.
2.  **Opacity:** It is unclear where variables like `$title` or `$is_active` come from (settings or internal logic).
3.  **Security Risk:** In complex methods, it can lead to logic bypasses if internal variables are defined *before* `extract()`.

**Learning:**
Elementor widget boilerplate often includes `extract($settings)`. Developers copy this pattern without realizing it defeats the purpose of explicit variable definition and creates a "magic" scope.
It is almost always redundant because templates usually access `$settings` directly or use specific variables prepared in `render()`.

**Prevention:**
1.  **Ban `extract()`:** Do not use `extract()` on user input.
2.  **Explicit Definition:** Define variables explicitly: `$title = $settings['title'] ?? '';`.
3.  **Direct Access:** Use `$settings['key']` directly in templates for simple values.
