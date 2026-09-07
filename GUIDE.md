# Alluvial redesign: mockups, theme and build guide

This covers three things: what's actually on the live site today, a redesigned set of page mockups, and a working custom WordPress theme built from those mockups, ready to install.

## Contents

- `mockups/` — eight static HTML pages (Home, My Profile, My Philosophy, My Practice, Testimonials, Insights, an article, Contact) sharing one CSS file, with original placeholder artwork already in place (see "Photography" below). Open `mockups/index.html` in a browser to click through.
- `theme/alluvial-coach/` — an installable WordPress theme implementing the same design.
- `scripts/generate-placeholder-art.py` — regenerates the placeholder artwork.
- This guide.

Two of the mockups (Home and My Philosophy) are also published as interactive previews you can open directly in a browser tab, listed at the end of this guide.

## Before anything else: two things worth fixing regardless of the redesign

I pulled the actual content off the live site from the pages you sent over (Home/My Philosophy, My Profile, Methodology, Introductory Programs, Contact). Two things stood out that are worth fixing on their own, independent of whether or when you do a full redesign.

**The footer is showing placeholder content, on every page.** Right now the site footer reads:

```
© Agard & Bolding
Oliefabriksvej 29, 43, 2770
Kastrup, Denmark
info@example.com
+1234567890
```

This is leftover demo content from the WordPress.com theme, never replaced. It's live on every page of the site right now, including Contact. This is a five-minute fix in the WordPress.com editor (Appearance → Editor → Footer, or under the theme's site identity settings), independent of anything else in this guide, and I'd fix it today.

**The Testimonials link goes nowhere.** The My Profile page has the line "Click here to a few of my clients' testimonials," but there's no testimonials page for it to link to. Either remove the line for now, or use the Testimonials page this redesign adds (see below).

## What the redesign changes

**Palette.** Deep navy (`#12213c`), warm paper (`#faf7f2`), and a muted brass accent (`#a9822f`), instead of the default black-on-white WordPress.com look. Navy and brass read as established and corporate without tipping into generic "consulting firm blue." Brass in particular is doing double duty: it reads as premium, and it echoes sediment and mineral deposits, which ties back to the Alluvial name.

**Type.** Fraunces (a serif with real character, used at a large size for headings) paired with Inter (for body text and UI). This is a deliberate move away from a single body-only font, which is what makes most WordPress.com default themes feel interchangeable.

**Fluidity.** You asked for more of this, so past the initial pass I went back and added: wavy SVG dividers between sections instead of hard horizontal lines (so a navy section flows into a paper section rather than cutting against it), an asymmetric organic border-radius on cards and the hero image (`56px 14px 56px 14px` rather than a uniform rounded rectangle), a layered "sediment band" gradient used as a section backdrop on the Philosophy page, and a wavy rule (`.river-rule`) used between sections of the long-form philosophy text instead of a plain line. All of this is intentional, not decorative: your own philosophy text is literally about sediment settling into layers rather than forcing uniformity, so the visual language borrows the same logic.

**Structure.** The real nav is Home / My Profile / Why Alluvial Coaching? (dropdown: My Philosophy, My Practice) / Testimonials / Insights / Contact Alluvial. Testimonials and Insights (the blog) are the two new additions, both of which you asked for. Everything else keeps the existing page names and URLs conceptually intact.

**Copy.** Where you sent real content (My Philosophy, My Profile, Methodology, Introductory Programs, Contact), the mockups and theme use it directly, lightly tightened for the web. Where there's no real content yet (client logos, testimonial quotes, stats, blog posts beyond the one sample article), everything is clearly marked `[Placeholder]` in the HTML and needs your real numbers, quotes and permissions before it goes live. Don't publish invented statistics or client names.

## A platform question to settle first

The current site's footer carries a "Blog at WordPress.com" badge. That means the site is very likely hosted on WordPress.com, not self-hosted WordPress.org. This matters a lot for "install a custom theme":

- **WordPress.com Business or Commerce plan**: you can upload and activate a custom PHP theme like the one in `theme/alluvial-coach/`, through Appearance → Themes → Upload Theme, or via SFTP. This is the path this guide assumes.
- **WordPress.com Personal, Premium, or free plan**: custom PHP themes aren't supported at all. You'd need to either upgrade the plan, or move the site to self-hosted WordPress (WordPress.org software on a regular host like SiteGround, Kinsta, WP Engine, or similar). Moving hosts is a bigger step, covered briefly at the end.

Check your current plan under WordPress.com → Upgrades before doing anything else in this guide. If you're not sure, the account billing page will say "Business" or "Commerce" if you already have the access you need.

## Step-by-step: getting the theme running

### 1. Set up a local copy to test on first

Don't develop against the live site. Use a local WordPress install:

- **Local** (by WP Engine, formerly Local by Flywheel) is the easiest option on Mac or Windows: create a new site, pick PHP 8.1+ and MySQL, and you have a working WordPress install in a few minutes.
- Alternatively, `wp-env` (WordPress's own Docker-based CLI tool) works well if you're comfortable with the command line.

### 2. Install the theme

1. Zip the `theme/alluvial-coach/` folder (the zip needs `alluvial-coach/style.css` at its root once unzipped, not double-nested).
2. In your local WordPress admin: Appearance → Themes → Add New → Upload Theme, select the zip, install, then Activate.
3. Go to Settings → General and set the Tagline to something like "Executive coaching for leaders navigating genuine complexity, run by Barbara Mendler." It's used in the footer.

### 3. Create the pages

Create these pages in Pages → Add New. Slugs matter because the theme links to them directly (`/philosophy/`, `/practice/`, `/testimonials/`, `/contact/`):

| Page title | Slug | Template |
|---|---|---|
| Barbara Mendler | `/profile/` | Default template |
| The river carries what matters | `/philosophy/` | Default template |
| How do we work? | `/practice/` | Default template |
| — | `/testimonials/` | **Testimonials** |
| — | `/contact/` | **Contact** |

Set the template from the Page Attributes panel on the right of the block editor. Leave "My Profile," "My Philosophy" etc. as the **menu label** (see step 4) rather than the page title — the page title becomes the on-page `<h1>`, and "Barbara Mendler" reads better as a heading than "My Profile" does.

For Profile, Philosophy and Practice, use the **Excerpt** field (Page Attributes panel, or enable it under Screen Options if hidden) for the one-line subheading that appears under the `<h1>` — this is a normal WordPress field, not something custom.

Paste your real content into each page's block editor. For a pull quote (like "This is how transformative leadership works" on the Philosophy page), use a Quote block and add `pull-quote` under the block's Advanced panel → Additional CSS class(es). For the sediment gradient backdrop, add `sediment-band` the same way to a Group block.

Settings → Reading → set "Your homepage displays" to a static page, or just leave it on default: the theme's `front-page.php` runs automatically as the homepage regardless of this setting.

### 4. Build the navigation menu

Appearance → Menus (or the equivalent in the block-based site editor):

1. Create a menu, add it to the **Primary Menu** location.
2. Add Home, My Profile, Testimonials, Insights, Contact Alluvial as top-level items — but set each item's **Navigation Label** (not the page title) to match: "Home," "My Profile," "Testimonials," "Insights," "Contact Alluvial."
3. Add a **Custom Link** with URL `#` and label "Why Alluvial Coaching?" as another top-level item.
4. Add My Philosophy and My Practice as items, then drag each one slightly right so it nests under "Why Alluvial Coaching?" as a child item. WordPress shows this visually in the menu editor.
5. Create a second, shorter menu (Profile, Philosophy, Practice, Testimonials, Insights) and assign it to the **Footer Menu** location.

The theme's CSS and JavaScript already handle the dropdown (hover on desktop, tap on mobile) — this is standard WordPress menu nesting, no plugin needed.

### 5. Add testimonials

Testimonials is a custom post type this theme registers (visible as its own "Testimonials" item in the left admin sidebar, not under Posts). For each one:

1. Testimonials → Add New.
2. Post title = the client's name (e.g. "J. Ardin").
3. Content editor = the quote itself.
4. In the "Role & Company" box on the right, add something like "Chief Executive, Northgate & Co."
5. Featured image = a small headshot, optional.

The homepage automatically shows the three most recent testimonials; the Testimonials page shows all of them. **Get written permission before publishing anyone's name, title, company or quote.**

### 6. Set the homepage hero content

Appearance → Customize → Homepage Hero. This controls the headline, subheading, eyebrow text, button label/link, the note under the buttons, and the hero image, all without touching code. Everything else on the homepage (the "What makes this different" section, the two named programmes, the stats labels) is deliberately hardcoded in `front-page.php`, since that layout won't change often — edit it directly if the wording needs to change later.

### 7. Wire up the contact form

The theme ships with a working, dependency-free version of the current site's Name/Email/Message form (`templates/template-contact.php` + `inc/contact-handler.php`). It sanitises input, checks a nonce, has a basic honeypot against bots, and emails the site admin address via `wp_mail()`.

Two things to know:

- **Deliverability.** Most hosts don't reliably deliver `wp_mail()` out of the box, mail sent this way often lands in spam or gets dropped. Install **WP Mail SMTP** (free) and connect it to a real mail provider (Gmail, or your email host's SMTP details) so messages actually arrive.
- **If you need more than three fields** (file uploads, conditional fields, a "what are you looking for" dropdown, built-in spam scoring), swap the built-in form for **Fluent Forms** (free tier is generous) or **WPForms**. Deactivate `inc/contact-handler.php`'s hook by commenting out the `add_action` line in `functions.php`, and drop the plugin's form shortcode into the Contact page content instead.

### 8. Photography

Real stock photo sites weren't reachable from the environment that built this (blocked by network policy, not a licensing choice), so instead of leaving empty grey boxes, every image slot in both the mockups and the theme is filled with original placeholder artwork: a branching river-delta illustration in navy and brass (`hero-delta.svg`) for the hero and article covers, a monogram portrait for Barbara Mendler (`portrait-barbara.svg`), three abstract sediment-wave tiles cycled across blog thumbnails (`thumb-a/b/c.svg`), and small monogram avatars for each placeholder testimonial. All of it is generated, original SVG — no copyright or licensing question, and no visual "stock photo" gap while the rest of the redesign is being reviewed.

None of it is meant to ship. You already have strong real material to swap in: the aerial river delta photograph at sunset from the current Philosophy page fits this palette closely and would work well as the homepage hero image, and Barbara's existing headshot from My Profile should replace the monogram there. Replace placeholders via the Customizer (hero image) or the block editor's featured image / image block (everywhere else).

The generator that made this artwork is included at `scripts/generate-placeholder-art.py` (pure Python, no dependencies) if you want to regenerate variations before real photography is ready — see the file's header for usage.

### 9. Recommended plugins

Beyond WP Mail SMTP:

- **A caching plugin** (WP Rocket, paid, or W3 Total Cache, free) — a coaching site's traffic is low-volume but every visitor is a prospective client; a slow site costs more than it saves.
- **Yoast SEO** or **Rank Math** — meta descriptions, sitemap, basic on-page SEO. Not optional for a site that depends on being found.
- **UpdraftPlus** — automated backups, non-negotiable before you go live.
- Skip page builders (Elementor, Divi). The theme is coded directly; adding a page builder on top fights the theme's own styling and slows the site down for no benefit here.

### 10. Testing checklist before launch

- Every internal link in the nav, footer, and page content resolves (no `#` placeholders left over).
- The contact form actually delivers an email to your inbox (send yourself a real test).
- Test on an actual phone, not just a resized desktop browser window: the nav dropdown behaves differently on touch.
- Run the homepage through Google PageSpeed Insights or [web.dev/measure](https://web.dev/measure) once real images are in place.
- Check every `[Placeholder]` marker in the mockups has been replaced or deliberately removed.
- Add a privacy policy page (Settings → Privacy in WordPress can scaffold one) — the contact form collects personal data, so this isn't optional under UK GDPR.

## If you do need to move off WordPress.com

Only relevant if your current plan doesn't support custom themes (see the platform section above). Rough shape of the move:

1. Export content from WordPress.com: Tools → Export → "All content."
2. Set up self-hosted WordPress on a host (SiteGround, Kinsta, and WP Engine are all reasonable choices for a small business site).
3. Install this theme, then Tools → Import → WordPress, and import the export file from step 1.
4. Re-check every page against this guide (templates, menu, testimonials, hero settings) since import doesn't carry over template assignments or Customizer settings.
5. Point the domain's DNS at the new host once you've verified everything on a temporary URL, not before.

This is a bigger job than the rest of this guide and worth doing as its own piece of work, ideally with a short window where the old site stays live as a fallback.

## Extending the theme later

- **New static page**: create the page, leave it on the default template (`page.php`), write content in the block editor. No code needed.
- **New page layout** (something structurally different, like a case-studies grid): copy `templates/template-testimonials.php` as a starting point, add `Template Name: Your Name` at the top, and build the loop.
- **Reusing the fluid design elements** anywhere: a wave divider is one line of SVG (copy the `<svg class="wave-divider ...">` block from any template and adjust the `on-X-to-Y` class to match the two section backgrounds either side of it), a pull quote is a Quote block with `pull-quote` as its Additional CSS class, and a sediment backdrop is `sediment-band` on a Group block.

## The published previews

Two of the mockups are also live as interactive pages you can click through in a browser (private to your account, from this session):

- **Homepage** — the real positioning and copy, full page.
- **My Philosophy** — the long-form article treatment, with the wave dividers and pull quotes in place.

Ask me for the links again if you don't have them handy, or open the equivalent files directly from `mockups/index.html` and `mockups/philosophy.html` in this repository, which look identical.
