<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login — preloved.g00ds</title>
  @vite(['resources/css/app.css'])
</head>
<body style="background:#0A0908;display:flex;align-items:center;justify-content:center;min-height:100vh;padding:24px;">

  <div style="width:100%;max-width:380px;">

    {{-- Brand --}}
    <div class="text-center mb-xl">
      <div style="font-family:var(--font-mono);font-size:1rem;letter-spacing:.08em;color:var(--clr-text-primary);margin-bottom:6px;">
        preloved<span style="color:var(--clr-sand);">.g00ds</span>
      </div>
      <div style="font-family:var(--font-mono);font-size:.55rem;letter-spacing:.25em;text-transform:uppercase;color:var(--clr-stone);">
        Curation Studio
      </div>
    </div>

    {{-- Card --}}
    <div style="background:var(--clr-bg-2);border:1px solid var(--clr-border-soft);padding:var(--space-xl);">

      <h1 style="font-family:var(--font-serif);font-weight:300;font-size:1.4rem;color:var(--clr-text-primary);margin-bottom:var(--space-xl);">
        Sign in
      </h1>

      @if ($errors->any())
        <div class="alert alert--error mb-lg">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="form-group">
          <label class="form-label" for="email">Email</label>
          <input id="email" name="email" type="email" class="form-input"
            value="{{ old('email') }}" autocomplete="email" required autofocus />
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input id="password" name="password" type="password" class="form-input"
            autocomplete="current-password" required />
        </div>

        <label style="display:flex;align-items:center;gap:8px;margin-bottom:var(--space-xl);cursor:pointer;">
          <input type="checkbox" name="remember" style="accent-color:var(--clr-sand);" />
          <span class="t-label" style="color:var(--clr-text-muted);">Remember me</span>
        </label>

        <button type="submit" class="btn btn--primary w-full" style="justify-content:center;">
          Enter Studio
        </button>
      </form>
    </div>

    <div class="text-center mt-lg">
      <a href="{{ route('home') }}" class="t-label" style="color:var(--clr-stone);">← Back to site</a>
    </div>

  </div>

</body>
</html>
