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

## 2024-05-22 - Misuse of wp_kses_post on Attribute Strings
**Vulnerability:**
The function `spel_el_image` constructed a string of HTML attributes (e.g., ` class="..." onclick="..."`) and attempted to sanitize it using `wp_kses_post($atts_str)`.
Since `wp_kses` parses HTML tags, passing a string of attributes without enclosing tags causes it to return the string as plain text, bypassing the filter.
This allowed attribute injection (XSS) because the dangerous attributes (e.g., `onclick`) were not stripped.

**Learning:**
`wp_kses_post` (and `wp_kses`) is designed for **full HTML fragments**, not for isolated attribute strings.
If you need to output a list of dynamic attributes, you must sanitize each key and value individually before concatenation, or construct the full HTML tag and pass the *entire* tag to `wp_kses` with an allowed attribute list.

**Prevention:**
1. **Sanitize Individual Attributes:** Validate keys against a strict regex (e.g., `/[^a-zA-Z0-9_\-]/`) and block dangerous prefixes (`on*`). Escape values with `esc_attr()`.
2. **Sanitize Full HTML:** Alternatively, build the full HTML string (e.g., `<img ... />`) and run `wp_kses($html, $allowed_tags)` where `$allowed_tags` explicitly defines which attributes are permitted for that tag.
