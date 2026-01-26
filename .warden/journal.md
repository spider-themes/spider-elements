## 2025-02-12 - Strict Boolean Checks in Loose Contexts
**Learning:** In legacy WordPress/Elementor codebases, helper functions often receive loosely typed arguments (e.g., `'yes'`, `1`, `true` for boolean flags). Enforcing strict type checks (e.g., `true === $arg`) can break backward compatibility.
**Action:** Use loose comparisons (`if ( $arg )`) for boolean flags in public helper functions unless strict typing is explicitly required and verified.

## 2025-02-12 - WPCS Brace Style
**Learning:** WPCS mandates that function opening braces be on the **same line** as the function declaration, not the next line. This differs from some PSR standards but matches WordPress Core.
**Action:** Ensure `function foo() {` style is used.
