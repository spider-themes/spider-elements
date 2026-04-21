## 2025-02-18 - CSS Asset Deduplication
**Learning:** `wp_enqueue_style` allows registering styles as aliases by passing `false` as the source and providing dependencies.
**Action:** When a plugin registers multiple handles for the same physical CSS file (common in some Elementor addon patterns), use one primary handle for the file and register others as aliases (dependent on the primary). This prevents WordPress from outputting multiple `<link>` tags for the same URL, reducing DOM size and network requests.
