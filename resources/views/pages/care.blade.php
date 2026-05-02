@extends('layouts.app')
@section('title', 'Care Guide — preloved.g00ds')

@section('content')
<div class="page-top">

  <div class="page-header">
    <div class="container--narrow">
      <p class="t-label mb-md">The Ritual</p>
      <h1 class="t-display">Care for your<br /><em>preloved piece.</em></h1>
      <p class="t-body mt-md" style="max-width:520px;">Preloved garments are already unique. With the right care, they last another decade.</p>
    </div>
  </div>

  <section class="section">
    <div class="container--narrow">
      <div style="display:flex;flex-direction:column;gap:var(--space-2xl);">

        @foreach ([
          ['Washing', '⟳', [
            'Always check the care label first — treat it as a contract.',
            'Wash in cold water (30°C or below) to preserve fabric and colour.',
            'Turn garments inside out to protect prints and dyes.',
            'Use a gentle, eco-friendly detergent.',
            'Avoid washing more than necessary — air out between wears.',
          ]],
          ['Drying', '◌', [
            'Air dry whenever possible — skip the tumble dryer.',
            'Hang knits flat to avoid stretching.',
            'Dry away from direct sunlight to prevent colour fading.',
            'Steam instead of ironing when possible — gentler on fibres.',
          ]],
          ['Storage', '▢', [
            'Fold knitwear — hanging stretches the shoulders.',
            'Use wooden or padded hangers for structured pieces.',
            'Keep garments in a cool, dry, ventilated space.',
            'Cedar blocks over mothballs — better for you and the fabric.',
            'Allow clothes to breathe — avoid plastic covers long-term.',
          ]],
          ['Repairs', '✕', [
            'A small tear repaired is a garment saved.',
            'Find a local tailor — support craft, extend life.',
            'Learn basic hand-stitching for minor repairs.',
            'Denim patches, visible mending, and sashiko are valid aesthetics.',
          ]],
        ] as [$title, $icon, $tips])
          <div data-animate style="background:var(--clr-bg-2);border:1px solid var(--clr-border-soft);padding:var(--space-xl);">
            <div style="display:flex;align-items:center;gap:var(--space-md);margin-bottom:var(--space-lg);">
              <span style="font-size:1.2rem;color:var(--clr-sand);">{{ $icon }}</span>
              <h2 class="t-title">{{ $title }}</h2>
            </div>
            <ul style="list-style:none;display:flex;flex-direction:column;gap:var(--space-sm);">
              @foreach ($tips as $tip)
                <li style="display:flex;gap:var(--space-md);align-items:flex-start;">
                  <span style="color:var(--clr-sand-muted);margin-top:2px;flex-shrink:0;">—</span>
                  <span class="t-body" style="font-size:.875rem;">{{ $tip }}</span>
                </li>
              @endforeach
            </ul>
          </div>
        @endforeach

      </div>

      <div style="margin-top:var(--space-2xl);padding:var(--space-xl);border:1px solid var(--clr-border);text-align:center;">
        <p class="t-label mb-sm">Have a question about your piece?</p>
        <p class="t-body" style="margin-bottom:var(--space-lg);">Reach out — we're happy to give specific care advice.</p>
        <a href="{{ route('contact') }}" class="btn btn--ghost">Say Hello</a>
      </div>

    </div>
  </section>
</div>
@endsection
