## 2025-10-26 - CRLF Line Endings in Core Files
**Learning:** Core files like `spider-elements.php` and `includes/functions.php` use CRLF line endings, which causes `replace_with_git_merge_diff` to fail or behave unpredictably.
**Action:** Always check file line endings using `cat -A` or run `dos2unix` on files before attempting modifications with line-sensitive tools.

## 2025-10-26 - Inconsistent Array Syntax
**Learning:** The codebase has mixed `array()` and `[]` syntax.
**Action:** Enforce short array syntax `[]` for consistency and modernization, especially since PHP 7.4+ is required.

## 2025-10-26 - Yoda Conditions
**Learning:** Older parts of the codebase do not follow Yoda conditions (`$var == 'value'`).
**Action:** Enforce Yoda conditions (`'value' === $var`) during refactors to align with WPCS.
