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

## 2024-10-24 - Missing 'style' in Attribute Blacklist
**Vulnerability:**
While blocking `on*` events and `href` prevents direct XSS and link hijacking, omitting `style` from the blacklist allows for UI Redressing (Clickjacking) and Defacement.
An attacker could inject `style="position:fixed;top:0;left:0;width:100%;height:100%;z-index:9999;opacity:0;"` to create an invisible overlay that intercepts clicks.

**Learning:**
Attribute blacklists must be comprehensive. `style` is often overlooked because it's "just CSS", but inline styles are powerful enough to break site usability or facilitate phishing attacks via overlays.
Consistency across helper functions (e.g., `spel_el_image` blocked `style` but `spel_button_link` did not) is key to a secure codebase.

**Prevention:**
Always include `style` in attribute blacklists unless inline styling is a desired feature for the end user (which is rare for "Custom Attributes" fields intended for metadata).
