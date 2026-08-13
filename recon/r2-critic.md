# R2 — Critic: adversarial stress-test of the emerging framing

**Date:** 2026-08-12 · **Round 2**

## 1. What breaks under `dir=rtl` in this stack
- **Popper.js dropdowns/tooltips/popovers**: known viewport miscalculation in RTL (#32578) → clipped/misaligned menus.
- **TomSelect**: caret, clear-button, and option-list positioning detach from the input when direction flips.
- **Alertify.js**: toasts hardcode `top-right`/`bottom-left` anchors → slide in from the wrong edge.
- **Tiptap toolbar**: flex/float groups lose alignment unless logical.
- **Sortable tree + lucide icons**: drag-handle hitboxes break on physical offsets; chevrons/arrows need `[dir=rtl] { transform: scaleX(-1) }` — carefully, only directional glyphs.

## 2. RTLCSS pipe vs targeted overrides
- A **parallel RTL stylesheet** piped over composer-vendor CSS (typicms/core) is a long-term maintenance trap: upstream updates silently reintroduce physical-property regressions.
- Modern alternative: **CSS logical properties** (`margin-inline-start`, `inset-inline`, `text-align: start`) — near-universal browser support.
- **Verdict (R2):** no wholesale RTLCSS compilation pipe; logical props for new code + minimal targeted `[dir=rtl]` scoping for legacy vendor components.

## 3. Mixed-language editing reality
- Consensus (Gutenberg, Strapi, Contentful): **keep the admin shell LTR/neutral**, or provide per-field `dir="auto"`. Bilingual editors (EN references, JSON, slugs, URLs, IDs) lose productivity in a fully mirrored shell.
- Editors prefer localized labels + right-aligned Arabic fields **inside a stable workspace** over a mirrored dashboard.

## 4. Top regression vectors
1. Upstream `typicms/core` composer updates overwriting RTL patches.
2. New devs writing physical properties instead of logical ones.
3. Bootstrap minor bumps shifting Popper behavior.
4. Arabic slugs/route binding encoding issues in mixed environments.

## 5. Cheaper 80/20 path
**Public-site RTL only + LTR admin with Arabic labels**: eliminates most component breakage (Popper, TomSelect, Tiptap toolbar, toasts) while delivering value to readers; editorial teams keep a stable dashboard with translated labels and `dir="auto"` inputs.

**This directly clashes with r2-explorer-precedents.md (Arabic editors expect a flipped admin) — the central tension of the session.**
