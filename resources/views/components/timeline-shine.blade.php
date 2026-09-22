<section id="{{ $sectionId }}" class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-12 gap-10 relative">

    <!-- GARIS ORANGE -->
    <div class="hidden md:block absolute top-0 bottom-0 left-[66.66%] w-1
                bg-gradient-to-b from-[#F38020] via-orange-300 to-[#F38020] rounded-full"></div>

    <!-- TIMELINE KIRI -->
    <div class="md:col-span-8 space-y-12">

      @foreach ($items as $i => $item)
        <div
          id="{{ $item['id'] }}"
          class="space-y-4"
          data-aos="fade-up"
          data-aos-delay="{{ 100 + ($i * 100) }}"
        >
          <div>
            <div class="text-sm font-semibold text-[#F38020]">
              {{ $item['year'] }}
            </div>
            <h4 class="text-lg font-semibold mt-1">
              {{ $item['title'] }}
            </h4>
            <p class="text-gray-700 mt-2">
              {{ $item['content'] }}
            </p>
          </div>

          <div class="relative group overflow-hidden rounded-2xl shadow-2xl">
            <img
              src="{{ $item['image'] }}"
              alt="{{ $item['year'] }}"
              class="w-full h-[500px] md:h-[600px] object-cover
                     transition-transform duration-700 group-hover:scale-110"
            >
            <div class="absolute inset-0 bg-gradient-to-r
                        from-transparent via-white/30 to-transparent
                        transform -translate-x-full group-hover:translate-x-full
                        duration-700"></div>
          </div>
        </div>
      @endforeach

    </div>

    <!-- TOC KANAN -->
    <div class="md:col-span-4 sticky top-32 self-start">
      <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
        <h4 class="text-xl font-semibold text-blue-900 mb-4">
          {{ $tocTitle ?? 'Daftar Isi Timeline' }}
        </h4>

        <ul class="space-y-4">
          @foreach ($items as $item)
            <li>
              <a href="#{{ $item['id'] }}"
                 data-target="{{ $item['id'] }}"
                 class="timeline-link flex items-center gap-3 group">

                <span class="arrow block w-3 h-3 border-r-2 border-b-2 border-gray-500 rotate-45
                             transition-all duration-300 group-hover:border-[#F38020]"></span>

                <span class="text-gray-700 font-medium
                             group-hover:text-[#F38020] transition-colors">
                  {{ $item['year'] }}: {{ $item['title'] }}
                </span>
              </a>
            </li>
          @endforeach
        </ul>
      </div>
    </div>

  </div>
</section>
