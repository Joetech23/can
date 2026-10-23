# Eaglescroft Socials

The working studio for Eaglescroft's social presence on **LinkedIn, Facebook and X**.
Content documents what we actually build, the problems we solve, and how AI is helping us
at Eaglescroft, and turns that into practical AI education for professionals, founders and
businesses.

> **We Help Businesses Fly Online.** Eaglescroft doesn't just talk about AI: we run the business on it.
> The socials show that work, honestly and in plain language.

---

## Accounts

| Account | Role | Voice |
| --- | --- | --- |
| **Eaglescroft (company page / brand handle)** | Primary. Every post is published here first. | "We": the agency, partner-minded |
| **Joshua Obaje (personal)** | Amplifier. Reshares and adds a founder's take on selected posts. | "I": hands-on founder, no hype |

## How it works

```
 capture  ─▶  shape  ─▶  design  ─▶  approve  ─▶  publish  ─▶  learn
 ideas.md     brief      templates    Joshua       LinkedIn     metrics in
 (raw wins,   (pillar,   → PNG/PDF    signs off    Facebook     tracker.csv,
  chats,      hook,                                X            next month's
  builds)     angle)                                            plan
```

1. **Capture**: anything worth sharing goes into [`pipeline/ideas.md`](pipeline/ideas.md): a build
   milestone, a problem we solved, a useful exchange with an AI chat, a question a client asked.
   A rough line is enough.
2. **Shape**: pick a pillar ([`strategy/content-pillars.md`](strategy/content-pillars.md)) and fill a
   brief from [`templates/`](templates/). Run it through the privacy check in
   [`strategy/brand-voice.md`](strategy/brand-voice.md#the-privacy-line).
3. **Design**: copy a graphic template from [`design/templates/`](design/templates/) into the post's
   folder, edit the copy, render with `design/render.sh`.
4. **Approve**: Joshua reviews. Nothing goes out unapproved.
5. **Publish**: post natively (or through the scheduler once one is connected, see
   [Publishing](#publishing)). Log it in [`pipeline/tracker.csv`](pipeline/tracker.csv).
6. **Learn**: monthly review of what landed, which feeds the next month's
   [`research/`](research/) note and calendar.

## Folder map

| Path | What lives there |
| --- | --- |
| `strategy/brand-voice.md` | Social voice, content rules, the privacy line, hashtag sets |
| `strategy/content-pillars.md` | The five recurring series and what goes in each |
| `strategy/platforms.md` | LinkedIn / Facebook / X playbooks: formats, length, sizes, timing |
| `strategy/posting-calendar.md` | Weekly rhythm and the first four-week launch plan |
| `profiles/profile-setup.md` | Page names, handles, bios, cover/avatar specs for all three platforms |
| `research/` | Dated trend notes (`YYYY-MM-trends.md`) with sources |
| `pipeline/ideas.md` | Raw idea backlog, sorted by pillar |
| `pipeline/tracker.csv` | Every post: status, platform, date, link, metrics |
| `templates/` | Copy briefs: case story, build log, AI chat insight, explainer, X thread |
| `design/brand/` | Logo + eagle marks: `*-mark.png` are tightly cropped, `logo-navy/white.png` are transparent lockups |
| `design/templates/` | HTML graphic templates: square, portrait, chat card, carousel, covers, avatar |
| `design/render.sh` | Renders any template to PNG/PDF at the right size |
| `design/exports/` | Rendered profile covers and template previews |
| `posts/YYYY-MM/<slug>/` | One folder per post: `copy.md` + its graphic source and exports |

## Rendering graphics

Needs Chromium plus the brand fonts (Poppins, Raleway, JetBrains Mono). See
`design/render.sh` for the font install line.

```bash
# PNG at the template's native size (2x for crispness)
design/render.sh design/templates/post-square.html            # → same folder, .png
design/render.sh posts/2026-10/launch/graphic.html out.png     # explicit output
# Carousel → multi-page PDF (upload to LinkedIn as a document)
design/render.sh design/templates/carousel.html carousel.pdf
```

## Publishing

No social account is connected to this workspace yet, so posts are published manually from the
copy and graphics here. To have content go **straight to the Eaglescroft accounts**, connect a
scheduler in claude.ai → Settings → Connectors:

- **Metricool** (recommended): one connector covers LinkedIn, Facebook **and** X, with scheduling
  and best-time-to-post analytics.
- **Typefully**: excellent for LinkedIn + X writing; no Facebook.

Once connected, approved posts can be scheduled directly from here.
