@php
  $accent = $accent ?? '#701F2B';
  $accentSoft = $accentSoft ?? 'rgba(112,31,43,.15)';
  $title = $title ?? 'Tujuan Program Studi';
  $items = $items ?? [];
  $imageField = $imageField ?? 'tujuan';
  $imageDefault = $imageDefault ?? 'model_ners_2.jpg';
  $imageAlt = $imageAlt ?? $title;
@endphp

<div id="tujuan" class="glass-card relative overflow-hidden scroll-mt-32 p-8 md:p-12 reveal fade-up">
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start relative z-10">
    <div class="flex items-center gap-4 lg:col-span-12 mb-2">
      <div
        class="w-11 h-11 rounded-xl flex items-center justify-center shadow-sm"
        style="background: {{ $accentSoft }}; color: {{ $accent }};"
      >
        <i class="bi bi-bullseye text-xl"></i>
      </div>
      <h3 class="text-2xl md:text-3xl font-semibold" style="color: {{ $accent }};">
        {{ $title }}
      </h3>
    </div>

    <div class="lg:col-span-12 grid lg:grid-cols-2 gap-6 items-start">
      <div class="relative group -mt-2 hidden lg:block">
        <div class="relative overflow-hidden rounded-2xl min-h-[100px] pt-7 pb-4">
          <img
            src="{{ $prodiProfile?->contentImageUrl($imageField, $imageDefault) ?? asset('images/' . $imageDefault) }}"
            alt="{{ $imageAlt }}"
            class="w-full max-w-xl scale-110 drop-shadow-2xl"
          />
          <span class="pointer-events-none absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-full skew-x-12 group-hover:translate-x-full transition duration-700"></span>
        </div>
      </div>

      <div class="space-y-4 mt-1">
        <ul class="tujuan-list grid gap-3">
          @foreach($items as $item)
            <li
              class="tujuan-card reveal flex items-start gap-3 rounded-2xl border border-gray-200 border-l-4 bg-white p-4 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-lg"
              style="border-left-color: {{ $accent }};"
            >
              <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl" style="background: {{ $accentSoft }};">
                <i class="bi bi-check-circle-fill" style="color: {{ $accent }};"></i>
              </span>
              <span class="self-center text-gray-700 leading-relaxed">
                {{ $item }}
              </span>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
