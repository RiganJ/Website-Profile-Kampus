@php
    $kaprodiDosen = $prodiProfile?->kaprodiDosen;
    $kaprodiName = $kaprodiDosen?->nama ?: ($prodiProfile?->nama_kaprodi ?: 'Data kaprodi belum tersedia');
    $kaprodiPhoto = $kaprodiDosen?->foto_url ?: ($prodiProfile?->foto_kaprodi_url ?: asset('images/rektor.png'));
    $programName = $prodiProfile?->nama_prodi ?: ($programName ?? 'Program Studi');
    $roleLabel = $roleLabel ?? 'Ketua Program Studi';
    $description = $description ?? 'Informasi ketua program studi akan diperbarui sesuai data resmi program studi.';
    $badgeLabel = $badgeLabel ?? $programName;
    $accentColor = $accentColor ?? '#0f172a';
    $accentSoftClass = $accentSoftClass ?? 'bg-slate-100';
    $borderClass = $borderClass ?? 'border-slate-200';
    $cardBgClass = $cardBgClass ?? 'from-white via-slate-50 to-slate-100';
    $imageBgClass = $imageBgClass ?? 'bg-slate-100';
    $chipRingClass = $chipRingClass ?? 'ring-slate-200';
    $badgeClass = $badgeClass ?? 'bg-slate-900/10 text-slate-900';
    $badgeIcon = $badgeIcon ?? 'bi bi-mortarboard-fill';
    $highlightOne = $highlightOne ?? 'Akademik Unggul';
    $highlightOneIcon = $highlightOneIcon ?? 'bi bi-stars';
    $highlightTwo = $highlightTwo ?? $programName;
    $highlightTwoIcon = $highlightTwoIcon ?? 'bi bi-award-fill';
@endphp

<div id="pimpinan" class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
  <div class="flex items-center gap-3 mb-8">
    <div class="w-11 h-11 rounded-xl {{ $accentSoftClass }} flex items-center justify-center shadow-sm" style="color: {{ $accentColor }};">
      <i class="bi bi-people-fill text-xl"></i>
    </div>
    <h2 class="text-2xl font-semibold" style="color: {{ $accentColor }};">
      {{ $roleLabel }}
    </h2>
  </div>

  <div class="md:max-w-2xl">
    <div class="overflow-hidden rounded-[28px] border {{ $borderClass }} bg-gradient-to-br {{ $cardBgClass }} shadow-[0_20px_60px_rgba(15,23,42,0.16)] reveal">
      <div class="grid grid-cols-1 md:grid-cols-[220px_minmax(0,1fr)] items-stretch">
        <div class="relative h-full min-h-[280px] overflow-hidden {{ $imageBgClass }}">
          <div class="absolute inset-0 bg-gradient-to-t from-slate-900/35 via-transparent to-transparent"></div>
          <img
            src="{{ $kaprodiPhoto }}"
            alt="{{ $kaprodiName }}"
            class="h-full w-full object-cover object-top"
            style="filter: contrast(.92) saturate(.95) blur(.15px); image-rendering: auto;"
          />
          <div class="absolute left-5 top-5 inline-flex items-center gap-2 rounded-full bg-white/90 px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] shadow" style="color: {{ $accentColor }};">
            <i class="bi bi-award-fill"></i>
            Lead Program
          </div>
        </div>

        <div class="flex flex-col justify-center p-8 md:p-10">
          <span class="inline-flex w-fit items-center gap-2 rounded-full {{ $badgeClass }} px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em]">
            <i class="{{ $badgeIcon }}"></i>
            {{ $badgeLabel }}
          </span>

          <h3 class="mt-5 text-2xl md:text-3xl font-bold text-slate-800 leading-tight">
            {{ $kaprodiName }}
          </h3>

          <p class="mt-3 text-base font-semibold" style="color: {{ $accentColor }};">
            {{ $roleLabel }}
          </p>

          <p class="mt-4 text-sm md:text-base leading-relaxed text-slate-600">
            {{ $description }}
          </p>

          <div class="mt-6 flex flex-wrap gap-3">
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm ring-1 {{ $chipRingClass }}">
              <i class="{{ $highlightOneIcon }}" style="color: {{ $accentColor }};"></i>
              {{ $highlightOne }}
            </span>
            <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm ring-1 {{ $chipRingClass }}">
              <i class="{{ $highlightTwoIcon }}" style="color: {{ $accentColor }};"></i>
              {{ $highlightTwo }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
