## 2024-05-23 - WPCS Baseline & Strict Comparisons
**Learning:** This codebase had inconsistent array syntax (`array()` vs `[]`) and used loose `in_array` checks for theme validation.
**Action:** Enforce `[]` array syntax, `__DIR__` over `dirname(__FILE__)`, and strict `in_array` checks (3rd param `true`) in all future PRs to maintain consistency and prevent loose comparison bugs.
