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

## 2024-10-24 - Unsafe Link Attributes & Missing Noopener
**Vulnerability:**
While `spel_button_link` had some protections, it failed to block `style`, `target`, and `rel` attributes in custom attributes.
This allowed:
1.  **CSS Injection:** via `style|...`.
2.  **Tabnabbing:** `target="_blank"` was used without `rel="noopener"`, allowing the opened page to control the parent window.
3.  **Attribute Override:** Users could override the secure `target="_blank"` with `target="_self"` or vice versa via custom attributes.

**Learning:**
Blocklists must be comprehensive. If you control `target` and `rel` via checkboxes (e.g., "Open in new window"), you must explicitly block them in custom attribute parsing to prevent overrides.
Also, any time `target="_blank"` is output, `rel="noopener"` (and ideally `noreferrer`) must be included to prevent reverse tabnabbing attacks.

**Prevention:**
1.  **Strict Blocklist:** Added `style`, `target`, `rel` to the blocked regex.
2.  **Secure Defaults:** Automatically append `noopener` to `rel` when `is_external` is true.
