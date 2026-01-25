## 2024-05-23 - Legacy Array Syntax & Docblock Gaps
**Learning:** The codebase frequently mixes `array()` and `[]` syntax, sometimes within the same file. Also, many utility functions in `includes/functions.php` lack Docblocks.
**Action:** When touching legacy files, enforce `[]` syntax for consistency and add missing Docblocks to functions in the immediate scope of changes.

## 2024-05-23 - Logic Error in spel_readable_number
**Learning:** The unit conversion logic in `spel_readable_number` incorrectly multiplies by 1024 regardless of the suffix (e.g., treating '1M' as 1024 bytes instead of 1024*1024).
**Action:** Do not "fix" this in a formatting/quality PR as it constitutes a behavioral change. This requires a dedicated bugfix PR.
