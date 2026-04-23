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

## 2024-05-25 - Reverse Tabnabbing and Attribute Override via Custom Attributes
**Vulnerability:**
The `spel_button_link` function generated `target="_blank"` for external links without adding `rel="noopener"`, exposing users to Reverse Tabnabbing attacks (phishing via `window.opener`).
Additionally, the function allowed `custom_attributes` to inject `target` and `rel`, potentially overriding the secure defaults or removing `nofollow`.
It also allowed `style` attribute injection, enabling CSS-based attacks.

**Learning:**
1.  **Implicit Trust in Defaults:** Developers often assume `target="_blank"` is safe or that browsers handle it, but explicit `rel="noopener"` is required for full security.
2.  **Attribute Overriding:** When merging "Custom Attributes" with standard settings, users can inadvertently (or maliciously) override critical security attributes like `rel` or `target` if they are not explicitly blocked.
3.  **Inconsistent Sanitization:** Different helper functions (`spel_el_image` vs `spel_button_link`) had different blacklists, leaving one vulnerable while the other was secure.

**Prevention:**
1.  **Enforce Noopener:** Always append `noopener` to `rel` when `target="_blank"` is used.
2.  **Strict Blocking:** In custom attribute parsers, explicitly block `target`, `rel`, and `style` in addition to XSS vectors (`on*`, `href`, `src`).
3.  **Centralize Logic:** Use a shared function for attribute generation to ensure consistent security policies across all widgets.
