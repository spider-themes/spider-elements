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

## 2024-05-24 - CSS Injection and Reverse Tabnabbing
**Vulnerability:**
The `spel_button_link` function allowed `style` attributes in custom attributes, enabling potential site defacement. It also failed to add `rel="noopener"` to links with `target="_blank"`, exposing users to reverse tabnabbing attacks.

**Learning:**
1. `style` attributes can be used for defacement (e.g., covering the screen) even if XSS is blocked.
2. `target="_blank"` requires `rel="noopener"` (or `noreferrer`) to prevent the new page from accessing the `window.opener` object. WordPress `esc_url` and `wp_kses` do not automatically enforce this context-dependent relationship.

**Prevention:**
1. Explicitly blacklist `style` in custom attribute parsers.
2. Automatically inject `rel="noopener"` whenever `target="_blank"` is generated.
