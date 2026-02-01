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

## 2024-10-24 - Reverse Tabnabbing via External Links
**Vulnerability:**
External links opening in a new tab (`target="_blank"`) without `rel="noopener"` allow the target page to control the parent page via `window.opener`.
This can be used for phishing attacks where the parent page is redirected to a fake login page.
The `spel_button_link` function relied on user input (custom attributes) or purely on `nofollow` to set the `rel` attribute, often leaving `target="_blank"` exposed.

**Learning:**
Always pair `target="_blank"` with `rel="noopener"` (or `noreferrer`).
Do not assume `nofollow` implies `noopener`.
When constructing attributes programmatically, use an array to collect values (e.g. `['nofollow', 'noopener']`) and implode them to ensure no conflicts or duplicates.

**Prevention:**
Enforce `rel="noopener"` automatically whenever `is_external` is detected.
Block users from overriding critical attributes like `target` and `rel` via custom attribute fields to prevent bypassing security controls.
