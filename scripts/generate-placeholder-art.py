"""
Generates the placeholder artwork used across mockups/ and theme/alluvial-coach/
(hero-delta.svg, portrait-barbara.svg, thumb-a/b/c.svg, avatar-*.svg).

All original SVG, no external images or fonts — safe to regenerate or vary.
Usage: python3 generate-placeholder-art.py mockups/assets/img theme/alluvial-coach/assets/img
Change the `seed` arguments in the __main__ block below for different variations.
"""
import random, math

INK = "#12213c"
INK2 = "#1c3160"
BRASS = "#a9822f"
BRASS_DARK = "#8a6a24"
BRASS_LIGHT = "#e0c27a"
PAPER = "#faf7f2"


def branch(x, y, angle, length, width, depth, segs, rng, spread=20, shrink=0.85, min_width=1.6, max_depth=9, max_segs=140, nodes=None):
    """Recursively build a tapering, gently forking channel — long sweeping
    curves with shallow fork angles, like a river distributary fan rather
    than a tree: fewer, wider, longer strokes read as flow, not twigs."""
    if nodes is None:
        nodes = []
    if width < min_width or depth > max_depth or len(segs) >= max_segs:
        return
    # a gentle drift partway through the stroke, then a smooth curve to the end
    drift = angle + rng.uniform(-10, 10)
    xm = x + (length * 0.55) * math.cos(math.radians(drift))
    ym = y + (length * 0.55) * math.sin(math.radians(drift))
    x2 = xm + (length * 0.55) * math.cos(math.radians(drift + rng.uniform(-6, 6)))
    y2 = ym + (length * 0.55) * math.sin(math.radians(drift + rng.uniform(-6, 6)))
    is_leaf = width < min_width * 1.5 or depth == max_depth
    segs.append((x, y, xm, ym, x2, y2, width, depth, is_leaf))

    if is_leaf:
        return

    n_children = 2 if rng.random() > 0.15 else 3
    if n_children > 1:
        nodes.append((x2, y2, width))
    for i in range(n_children):
        off = (i - (n_children - 1) / 2) * spread * rng.uniform(0.85, 1.15)
        branch(
            x2, y2,
            angle + off,
            length * rng.uniform(0.88, 0.98),
            width * shrink,
            depth + 1,
            segs, rng,
            spread=spread * 1.06,
            shrink=shrink,
            max_depth=max_depth,
            max_segs=max_segs,
            nodes=nodes,
        )


def build_delta_svg(path, seed, W=1200, H=900):
    rng = random.Random(seed)
    segs = []
    nodes = []
    base_y = H * 1.04
    root_fracs = [0.14, 0.50, 0.87]
    for frac in root_fracs:
        bx = W * frac + rng.uniform(-15, 15)
        root_segs = []
        branch(
            bx, base_y, -90 + rng.uniform(-6, 6),
            H * 0.24, W * 0.046, 0,
            root_segs, rng,
            spread=19, shrink=0.85, max_depth=6, max_segs=48,
            nodes=nodes,
        )
        segs.extend(root_segs)

    max_gen = max(s[7] for s in segs)

    parts = []
    parts.append(f'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {W} {H}" preserveAspectRatio="xMidYMax slice" role="img" aria-label="Abstract branching river delta illustration in navy and brass">')
    parts.append('<defs>')
    parts.append(f'''<radialGradient id="sky" cx="50%" cy="18%" r="85%">
      <stop offset="0%" stop-color="{BRASS_LIGHT}" stop-opacity="0.55"/>
      <stop offset="35%" stop-color="{BRASS}" stop-opacity="0.28"/>
      <stop offset="100%" stop-color="{INK}" stop-opacity="0"/>
    </radialGradient>''')
    parts.append(f'''<linearGradient id="ground" x1="0" y1="0" x2="0" y2="1">
      <stop offset="0%" stop-color="{INK2}"/>
      <stop offset="100%" stop-color="{INK}"/>
    </linearGradient>''')
    parts.append(f'''<linearGradient id="waterFlow" x1="0" y1="1" x2="0" y2="0">
      <stop offset="0%" stop-color="{BRASS_DARK}"/>
      <stop offset="55%" stop-color="{BRASS}"/>
      <stop offset="100%" stop-color="{BRASS_LIGHT}"/>
    </linearGradient>''')
    parts.append('</defs>')

    parts.append(f'<rect width="{W}" height="{H}" fill="url(#ground)"/>')
    parts.append(f'<rect width="{W}" height="{H}" fill="url(#sky)"/>')

    # sediment texture: soft translucent ellipses scattered near the base
    for _ in range(26):
        ex = rng.uniform(0, W)
        ey = rng.uniform(H * 0.45, H)
        er = rng.uniform(18, 70)
        op = rng.uniform(0.03, 0.09)
        parts.append(f'<ellipse cx="{ex:.0f}" cy="{ey:.0f}" rx="{er:.0f}" ry="{er*0.5:.0f}" fill="{BRASS_LIGHT}" opacity="{op:.2f}"/>')

    # draw thickest (lowest generation) first so thin tributaries layer on top.
    # Internal joints use a butt cap so a thinner child doesn't leave a ring
    # of its wider parent showing around the join; only true tips are round.
    for s in sorted(segs, key=lambda s: s[7]):
        x, y, cx, cy, x2, y2, w, gen, is_leaf = s
        t = gen / max_gen
        opacity = 0.94 - t * 0.12
        cap = 'round' if is_leaf else 'butt'
        parts.append(
            f'<path d="M{x:.1f},{y:.1f} Q{cx:.1f},{cy:.1f} {x2:.1f},{y2:.1f}" '
            f'stroke="url(#waterFlow)" stroke-width="{max(w,1.4):.2f}" '
            f'stroke-linecap="{cap}" fill="none" opacity="{opacity:.2f}"/>'
        )

    # confluence nodes: small deposits where channels meet, tying the join
    # points back to the brand's own "sediment collects where currents
    # converge" idea, rather than leaving a bare seam.
    for nx, ny, nw in nodes:
        r = max(nw * 0.42, 2)
        parts.append(f'<circle cx="{nx:.1f}" cy="{ny:.1f}" r="{r:.2f}" fill="{BRASS_LIGHT}" opacity="0.9"/>')

    parts.append('</svg>')
    svg = "\n".join(parts)
    with open(path, "w") as f:
        f.write(svg)
    print("wrote", path)


def build_monogram_svg(path, initials, seed=7, W=480, H=480):
    rng = random.Random(seed)
    parts = []
    parts.append(f'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {W} {H}" role="img" aria-label="Placeholder portrait monogram">')
    parts.append('<defs>')
    parts.append(f'''<linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="{INK2}"/>
      <stop offset="100%" stop-color="{INK}"/>
    </linearGradient>''')
    parts.append('</defs>')
    parts.append(f'<rect width="{W}" height="{H}" fill="url(#bg)"/>')

    # a few soft branching hairline flourishes, low opacity, echoing the delta motif
    segs = []
    branch(W * 0.5, H * 1.02, -90, H * 0.22, 10, 0, segs, rng, spread=22, shrink=0.8, max_depth=4, max_segs=24)
    for s in segs:
        x, y, cx, cy, x2, y2, w, gen, is_leaf = s
        cap = 'round' if is_leaf else 'butt'
        parts.append(f'<path d="M{x:.1f},{y:.1f} Q{cx:.1f},{cy:.1f} {x2:.1f},{y2:.1f}" stroke="{BRASS}" stroke-width="{max(w*0.35,1):.2f}" stroke-linecap="{cap}" fill="none" opacity="0.16"/>')

    parts.append(
        f'<text x="50%" y="53%" text-anchor="middle" dominant-baseline="middle" '
        f'font-family="Georgia, \'Times New Roman\', serif" font-size="{W*0.32:.0f}" '
        f'fill="{BRASS_LIGHT}" opacity="0.92">{initials}</text>'
    )
    parts.append('</svg>')
    with open(path, "w") as f:
        f.write("\n".join(parts))
    print("wrote", path)


def build_avatar_svg(path, initials, seed, W=120, H=120):
    rng = random.Random(seed)
    angle = rng.uniform(0, 360)
    x1, y1 = 50 + 50 * math.cos(math.radians(angle)), 50 + 50 * math.sin(math.radians(angle))
    x2, y2 = 50 - 50 * math.cos(math.radians(angle)), 50 - 50 * math.sin(math.radians(angle))
    parts = []
    parts.append(f'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {W} {H}" role="img" aria-label="Placeholder avatar for {initials}">')
    parts.append('<defs>')
    parts.append(f'''<linearGradient id="g" x1="{x1:.0f}%" y1="{y1:.0f}%" x2="{x2:.0f}%" y2="{y2:.0f}%">
      <stop offset="0%" stop-color="{INK2}"/>
      <stop offset="100%" stop-color="{BRASS_DARK}"/>
    </linearGradient>''')
    parts.append('</defs>')
    parts.append(f'<rect width="{W}" height="{H}" fill="url(#g)"/>')
    parts.append(
        f'<text x="50%" y="53%" text-anchor="middle" dominant-baseline="middle" '
        f'font-family="Georgia, \'Times New Roman\', serif" font-size="{W*0.34:.0f}" '
        f'fill="{PAPER}" opacity="0.95">{initials}</text>'
    )
    parts.append('</svg>')
    with open(path, "w") as f:
        f.write("\n".join(parts))
    print("wrote", path)


def build_thumb_svg(path, seed, W=640, H=400):
    rng = random.Random(seed)
    hue_sets = [
        [(0, BRASS_LIGHT), (1, INK)],
        [(0, BRASS), (1, INK2)],
        [(0, "#c9a35c"), (1, "#12213c")],
    ]
    stops = hue_sets[seed % len(hue_sets)]
    parts = []
    parts.append(f'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {W} {H}" preserveAspectRatio="xMidYMid slice" role="img" aria-label="Abstract sediment-layer illustration">')
    parts.append('<defs>')
    parts.append(f'''<linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
      <stop offset="{stops[0][0]}" stop-color="{stops[0][1]}"/>
      <stop offset="{stops[1][0]}" stop-color="{stops[1][1]}"/>
    </linearGradient>''')
    parts.append('</defs>')
    parts.append(f'<rect width="{W}" height="{H}" fill="url(#g)"/>')

    # layered wave bands, evoking sediment strata — smooth curves, not zigzags
    n_bands = 4
    for i in range(n_bands):
        base_y = H * (0.32 + i * 0.17) + rng.uniform(-10, 10)
        amp = rng.uniform(14, 30)
        n_waves = 3
        pts = []
        for s in range(n_waves + 1):
            px = W * s / n_waves
            py = base_y + (amp if s % 2 == 0 else -amp) + rng.uniform(-6, 6)
            pts.append((px, py))
        d = f'M0,{H} L0,{pts[0][1]:.0f} '
        for j in range(len(pts) - 1):
            x0, y0 = pts[j]
            x1, y1 = pts[j + 1]
            cx1, cy1 = x0 + (x1 - x0) * 0.5, y0
            cx2, cy2 = x0 + (x1 - x0) * 0.5, y1
            d += f'C{cx1:.0f},{cy1:.0f} {cx2:.0f},{cy2:.0f} {x1:.0f},{y1:.0f} '
        d += f'L{W},{H} Z'
        op = 0.10 + i * 0.05
        parts.append(f'<path d="{d}" fill="{PAPER}" opacity="{op:.2f}"/>')

    parts.append('</svg>')
    with open(path, "w") as f:
        f.write("\n".join(parts))
    print("wrote", path)


if __name__ == "__main__":
    import sys
    out_dirs = sys.argv[1:]
    for d in out_dirs:
        build_delta_svg(f"{d}/hero-delta.svg", seed=42)
        build_monogram_svg(f"{d}/portrait-barbara.svg", "BM", seed=11)
        for i, s in enumerate(["a", "b", "c"]):
            build_thumb_svg(f"{d}/thumb-{s}.svg", seed=i)
        for i, initials in enumerate(["JA", "SW", "RO", "MF", "DL", "AP", "BM"]):
            build_avatar_svg(f"{d}/avatar-{initials.lower()}.svg", initials, seed=i)
