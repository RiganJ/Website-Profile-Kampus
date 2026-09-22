@php
  $accent = $accent ?? '#701F2B';
  $accentSoft = $accentSoft ?? 'rgba(112,31,43,.15)';
  $title = $title ?? 'Visi & Misi';
  $visionLabel = $visionLabel ?? 'VISI';
  $missionLabel = $missionLabel ?? 'MISI';
  $vision = $vision ?? '';
  $missions = $missions ?? [];
  $imageField = $imageField ?? 'visi_misi';
  $imageDefault = $imageDefault ?? 'model_ners_1.jpg';
  $imageAlt = $imageAlt ?? $title;
  $imagePosition = $imagePosition ?? 'right';
  $isImageLeft = $imagePosition === 'left';
@endphp

<div id="visi-misi" class="glass-card p-8 md:p-10 scroll-mt-32 reveal">
  <div class="flex items-center gap-3 mb-10">
    <div
      class="w-11 h-11 rounded-xl flex items-center justify-center shadow-sm"
      style="background: {{ $accentSoft }}; color: {{ $accent }};"
    >
      <i class="bi bi-compass-fill text-xl"></i>
    </div>
    <h2 class="text-2xl font-semibold" style="color: {{ $accent }};">
      {{ $title }}
    </h2>
  </div>

  <div class="visi-box reveal mb-14">
    <span class="badge-visi">{{ $visionLabel }}</span>
    <p class="mt-4">{{ $vision }}</p>
  </div>

  <div class="flex flex-col lg:flex-row gap-12 items-start">
    <div class="lg:w-7/12 space-y-6 {{ $isImageLeft ? 'lg:order-2' : '' }}">
      <span
        class="inline-block px-4 py-1 rounded-full text-sm font-semibold"
        style="background: {{ $accentSoft }}; color: {{ $accent }};"
      >
        {{ $missionLabel }}
      </span>

      <ul class="misi-list mt-5">
        @foreach($missions as $item)
          <li
            class="misi-card misi-reveal reveal flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 bg-white p-4 shadow-sm"
            style="border-left-color: {{ $accent }};"
          >
            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl" style="background: {{ $accentSoft }};">
              <i class="bi bi-arrow-right-circle-fill" style="color: {{ $accent }};"></i>
            </span>
            <span class="self-center text-gray-700 leading-relaxed">
              {{ $item }}
            </span>
          </li>
        @endforeach
      </ul>
    </div>

    <div class="lg:w-5/12 relative hidden lg:block group mt-6 {{ $isImageLeft ? 'lg:order-1' : '' }}">
      <div class="relative overflow-hidden rounded-2xl min-h-[520px] pt-16 pb-20">
        <img
          src="{{ $prodiProfile?->contentImageUrl($imageField, $imageDefault) ?? asset('images/' . $imageDefault) }}"
          alt="{{ $imageAlt }}"
          class="w-full max-w-xl scale-125 drop-shadow-2xl"
        />
        <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition-transform duration-700"></span>
      </div>
    </div>
  </div>
</div>
