/**
 * Universitas Fort De Kock (UFDK) Bukittinggi
 * Logika Tabel Rincian Biaya Studi Reguler & Non-Reguler (RPL) 2026/2027
 */

document.addEventListener('DOMContentLoaded', () => {
  // State
  const state = {
    searchQuery: '',
    selectedJalur: 'all',     // 'all' | 'reguler' | 'rpl'
    selectedJenjang: 'all',   // 'all' | 'S2' | 'S1' | 'D3' | 'Profesi'
    selectedBank: 'all',      // 'all' | 'BRI' | 'NAGARI'
    sortBy: 'default'
  };

  // DOM Elements
  const searchInput = document.getElementById('search-input');
  const searchClearBtn = document.getElementById('search-clear-btn');
  const jalurTabs = document.querySelectorAll('.jalur-tab-btn');
  const selectJenjang = document.getElementById('select-jenjang');
  const selectBank = document.getElementById('select-bank');
  const selectSort = document.getElementById('select-sort');
  const btnReset = document.getElementById('btn-reset');
  const countShown = document.getElementById('count-shown');
  const countTotal = document.getElementById('count-total');

  const tableBody = document.getElementById('official-table-body');
  const mobileCardsContainer = document.getElementById('mobile-cards-container');
  const emptyState = document.getElementById('empty-state');

  const themeToggleBtn = document.getElementById('theme-toggle-btn');
  const toastPopup = document.getElementById('toast-popup');
  const toastText = document.getElementById('toast-text');

  // Initialize
  init();

  function init() {
    setupTheme();
    renderData();
    setupEvents();
  }

  function setupEvents() {
    // Search
    if (searchInput) {
      searchInput.addEventListener('input', (e) => {
        state.searchQuery = e.target.value.trim().toLowerCase();
        if (searchClearBtn) {
          searchClearBtn.style.display = state.searchQuery ? 'block' : 'none';
        }
        renderData();
      });
    }

    if (searchClearBtn) {
      searchClearBtn.addEventListener('click', () => {
        searchInput.value = '';
        state.searchQuery = '';
        searchClearBtn.style.display = 'none';
        searchInput.focus();
        renderData();
      });
    }

    // Jalur Tabs
    jalurTabs.forEach(tab => {
      tab.addEventListener('click', () => {
        jalurTabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        state.selectedJalur = tab.dataset.jalur;
        renderData();
      });
    });

    // Jenjang Dropdown
    if (selectJenjang) {
      selectJenjang.addEventListener('change', (e) => {
        state.selectedJenjang = e.target.value;
        renderData();
      });
    }

    // Bank Dropdown
    if (selectBank) {
      selectBank.addEventListener('change', (e) => {
        state.selectedBank = e.target.value;
        renderData();
      });
    }

    // Sorting Dropdown
    if (selectSort) {
      selectSort.addEventListener('change', (e) => {
        state.sortBy = e.target.value;
        renderData();
      });
    }

    // Reset Filters
    if (btnReset) {
      btnReset.addEventListener('click', resetFilters);
    }

    // Theme Switcher
    if (themeToggleBtn) {
      themeToggleBtn.addEventListener('click', toggleTheme);
    }
  }

  function getCombinedList() {
    let combined = [];

    if (state.selectedJalur === 'all') {
      combined = [...UFDK_DATA.reguler, ...UFDK_DATA.non_reguler];
    } else if (state.selectedJalur === 'reguler') {
      combined = [...UFDK_DATA.reguler];
    } else if (state.selectedJalur === 'rpl') {
      combined = [...UFDK_DATA.non_reguler];
    }

    return combined;
  }

  function getFilteredData() {
    let list = getCombinedList();

    // Search query
    if (state.searchQuery) {
      const q = state.searchQuery;
      list = list.filter(item => 
        item.prodi.toLowerCase().includes(q) ||
        item.pendidikan.toLowerCase().includes(q) ||
        item.sistem_kuliah.toLowerCase().includes(q) ||
        item.jenjang.toLowerCase().includes(q) ||
        item.bank.toLowerCase().includes(q) ||
        item.nama_rekening.toLowerCase().includes(q) ||
        item.no_rekening.replace(/\s|\./g, '').includes(q.replace(/\s|\./g, ''))
      );
    }

    // Jenjang filter
    if (state.selectedJenjang !== 'all') {
      list = list.filter(item => item.jenjang.toUpperCase() === state.selectedJenjang.toUpperCase());
    }

    // Bank filter
    if (state.selectedBank !== 'all') {
      list = list.filter(item => item.bank.toUpperCase() === state.selectedBank.toUpperCase());
    }

    // Sort
    switch (state.sortBy) {
      case 'sem-asc':
        list.sort((a, b) => a.biaya_tiap_semester - b.biaya_tiap_semester);
        break;
      case 'sem-desc':
        list.sort((a, b) => b.biaya_tiap_semester - a.biaya_tiap_semester);
        break;
      case 'tahap-asc':
        list.sort((a, b) => a.biaya_per_tahap - b.biaya_per_tahap);
        break;
      case 'tahap-desc':
        list.sort((a, b) => b.biaya_per_tahap - a.biaya_per_tahap);
        break;
      case 'nama-asc':
        list.sort((a, b) => a.prodi.localeCompare(b.prodi));
        break;
      default:
        break;
    }

    return list;
  }

  function renderData() {
    const data = getFilteredData();
    const totalAll = UFDK_DATA.reguler.length + UFDK_DATA.non_reguler.length;

    if (countShown) countShown.textContent = data.length;
    if (countTotal) countTotal.textContent = totalAll;

    if (data.length === 0) {
      if (emptyState) emptyState.style.display = 'block';
      if (tableBody) tableBody.innerHTML = '';
      if (mobileCardsContainer) mobileCardsContainer.innerHTML = '';
      return;
    }

    if (emptyState) emptyState.style.display = 'none';

    renderTableRows(data);
    renderMobileCards(data);
  }

  function renderTableRows(data) {
    if (!tableBody) return;

    tableBody.innerHTML = data.map((item, idx) => {
      const bankBadge = item.bank === 'BRI' ? 'badge-bank-bri' : 'badge-bank-nagari';
      const jenjangBadge = `badge-jenjang-${item.jenjang.toLowerCase()}`;
      const programBadge = item.kategori === 'rpl' ? 'badge-program-rpl' : (item.kategori === 'profesi' ? 'badge-program-profesi' : 'badge-program-reguler');

      // Check if this row is the transition between Reguler and Non-Reguler
      const isTransitionRow = (state.selectedJalur === 'all' && item.kategori === 'reguler' && data[idx + 1] && data[idx + 1].kategori !== 'reguler');
      const pageBreakClass = isTransitionRow ? 'print-page-break-after' : '';

      return `
        <tr class="${pageBreakClass}">
          <td class="col-idx">${idx + 1}</td>
          <td class="col-prodi-title">
            <div class="font-bold">${highlight(item.prodi, state.searchQuery)}</div>
            <div class="mt-1"><span class="badge ${jenjangBadge}">${item.jenjang_label}</span></div>
          </td>
          <td class="col-pendidikan font-mono">${highlight(item.pendidikan, state.searchQuery)}</td>
          <td class="col-sistem"><span class="badge ${programBadge}">${highlight(item.sistem_kuliah, state.searchQuery)}</span></td>
          <td class="text-center font-bold font-mono">${item.jumlah_semester}</td>
          <td class="col-nominal-sem font-mono">${formatRupiah(item.biaya_tiap_semester)}</td>
          <td class="col-stage-val font-mono">${formatRupiah(item.tahap1)}</td>
          <td class="col-stage-val font-mono">${formatRupiah(item.tahap2)}</td>
          <td class="col-stage-val font-mono">${formatRupiah(item.tahap3)}</td>
          <td class="col-stage-val font-mono">${formatRupiah(item.tahap4)}</td>
          <td class="col-stage-val font-mono">${formatRupiah(item.tahap5)}</td>
          <td class="col-stage-val font-mono">${formatRupiah(item.tahap6)}</td>
          <td class="col-bank-wrap">
            <div class="bank-line">
              <span class="badge ${bankBadge}">${item.bank}</span>
              <span class="bank-acc-no font-mono">${item.no_rekening}</span>
              <button class="btn-copy-tag" data-acc="${item.no_rekening}" data-bank="${item.bank}" title="Salin Nomor Rekening">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                <span>Salin</span>
              </button>
            </div>
            <div class="bank-acc-name mt-1" title="${item.nama_rekening}">${item.nama_rekening}</div>
          </td>
        </tr>
      `;
    }).join('');

    bindCopyEvents();
  }

  function renderMobileCards(data) {
    if (!mobileCardsContainer) return;

    mobileCardsContainer.innerHTML = data.map(item => {
      const bankBadge = item.bank === 'BRI' ? 'badge-bank-bri' : 'badge-bank-nagari';
      const jenjangBadge = `badge-jenjang-${item.jenjang.toLowerCase()}`;
      const programBadge = item.kategori === 'rpl' ? 'badge-program-rpl' : (item.kategori === 'profesi' ? 'badge-program-profesi' : 'badge-program-reguler');

      return `
        <div class="mobile-prodi-card">
          <div class="card-tag-row">
            <span class="badge ${jenjangBadge}">${item.jenjang_label}</span>
            <span class="badge ${programBadge}">${item.sistem_kuliah}</span>
          </div>

          <h3 class="card-title-h3">${highlight(item.prodi, state.searchQuery)}</h3>
          <div class="card-qualification"><strong>Kualifikasi:</strong> ${item.pendidikan}</div>

          <div class="card-stat-box">
            <div class="card-stat-item">
              <span class="card-stat-lbl">Biaya Tiap Semester:</span>
              <span class="card-stat-val text-navy">${formatRupiah(item.biaya_tiap_semester)}</span>
            </div>
            <div class="card-stat-item">
              <span class="card-stat-lbl">Masa Studi:</span>
              <span class="card-stat-val">${item.jumlah_semester} Semester</span>
            </div>
            <div class="card-stat-item">
              <span class="card-stat-lbl">Angsuran / Tahap:</span>
              <span class="card-stat-val text-orange">${formatRupiah(item.biaya_per_tahap)}</span>
            </div>
            <div class="card-stat-item">
              <span class="card-stat-lbl">Sistem Angsuran:</span>
              <span class="card-stat-val">6 Tahap / Semester</span>
            </div>
          </div>

          <!-- 6-Stage Detailed Breakdown Box -->
          <div class="card-stages-grid-box">
            <div class="text-xs font-bold text-orange">Perencanaan Pembayaran 6 Tahap Per Semester:</div>
            <div class="stages-6-grid">
              <div class="stage-item-mini">
                <span class="num">Tahap I:</span>
                <span class="val">${formatRupiah(item.tahap1)}</span>
              </div>
              <div class="stage-item-mini">
                <span class="num">Tahap II:</span>
                <span class="val">${formatRupiah(item.tahap2)}</span>
              </div>
              <div class="stage-item-mini">
                <span class="num">Tahap III:</span>
                <span class="val">${formatRupiah(item.tahap3)}</span>
              </div>
              <div class="stage-item-mini">
                <span class="num">Tahap IV:</span>
                <span class="val">${formatRupiah(item.tahap4)}</span>
              </div>
              <div class="stage-item-mini">
                <span class="num">Tahap V:</span>
                <span class="val">${formatRupiah(item.tahap5)}</span>
              </div>
              <div class="stage-item-mini">
                <span class="num">Tahap VI:</span>
                <span class="val">${formatRupiah(item.tahap6)}</span>
              </div>
            </div>
          </div>

          <div class="card-bank-details">
            <div class="bank-line">
              <span class="badge ${bankBadge}">${item.bank}</span>
              <span class="bank-acc-no font-mono">${item.no_rekening}</span>
              <button class="btn-copy-tag" data-acc="${item.no_rekening}" data-bank="${item.bank}">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                <span>Salin</span>
              </button>
            </div>
            <div class="bank-acc-name mt-1">${item.nama_rekening}</div>
          </div>
        </div>
      `;
    }).join('');

    bindCopyEvents();
  }

  function bindCopyEvents() {
    document.querySelectorAll('.btn-copy-tag').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const acc = btn.dataset.acc;
        const bank = btn.dataset.bank;
        copyText(acc, `No. Rekening ${bank} (${acc}) berhasil disalin!`);
        animateCopy(btn);
      });
    });
  }

  function copyText(text, msg) {
    const clean = text.replace(/\s+/g, ' ').trim();
    if (navigator.clipboard && window.isSecureContext) {
      navigator.clipboard.writeText(clean)
        .then(() => showToast(msg))
        .catch(() => fallbackCopy(clean, msg));
    } else {
      fallbackCopy(clean, msg);
    }
  }

  function fallbackCopy(text, msg) {
    const ta = document.createElement('textarea');
    ta.value = text;
    ta.style.position = 'fixed';
    ta.style.opacity = '0';
    document.body.appendChild(ta);
    ta.focus();
    ta.select();
    try {
      document.execCommand('copy');
      showToast(msg);
    } catch (e) {
      showToast('Gagal menyalin');
    }
    document.body.removeChild(ta);
  }

  function animateCopy(btn) {
    const orig = btn.innerHTML;
    btn.classList.add('copied');
    btn.innerHTML = `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg> <span>Tersalin!</span>`;
    setTimeout(() => {
      btn.classList.remove('copied');
      btn.innerHTML = orig;
    }, 2000);
  }

  function showToast(msg) {
    if (!toastPopup || !toastText) return;
    toastText.textContent = msg;
    toastPopup.classList.add('show');
    clearTimeout(window.toastTimer);
    window.toastTimer = setTimeout(() => {
      toastPopup.classList.remove('show');
    }, 3000);
  }

  function resetFilters() {
    if (searchInput) searchInput.value = '';
    if (searchClearBtn) searchClearBtn.style.display = 'none';
    state.searchQuery = '';
    state.selectedJalur = 'all';
    state.selectedJenjang = 'all';
    state.selectedBank = 'all';
    state.sortBy = 'default';

    jalurTabs.forEach(t => {
      if (t.dataset.jalur === 'all') t.classList.add('active');
      else t.classList.remove('active');
    });

    if (selectJenjang) selectJenjang.value = 'all';
    if (selectBank) selectBank.value = 'all';
    if (selectSort) selectSort.value = 'default';

    renderData();
    showToast('Filter direset');
  }

  function setupTheme() {
    const saved = localStorage.getItem('ufdk_theme') || 'light';
    document.documentElement.setAttribute('data-theme', saved);
    updateThemeBtn(saved);
  }

  function toggleTheme() {
    const cur = document.documentElement.getAttribute('data-theme') || 'light';
    const next = cur === 'light' ? 'dark' : 'light';
    document.documentElement.setAttribute('data-theme', next);
    localStorage.setItem('ufdk_theme', next);
    updateThemeBtn(next);
    showToast(`Mode tema: ${next === 'dark' ? 'Gelap' : 'Terang'}`);
  }

  function updateThemeBtn(t) {
    if (!themeToggleBtn) return;
    if (t === 'dark') {
      themeToggleBtn.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line></svg> <span>Mode Terang</span>`;
    } else {
      themeToggleBtn.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg> <span>Mode Gelap</span>`;
    }
  }

  function highlight(text, q) {
    if (!q) return text;
    const esc = q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    const rx = new RegExp(`(${esc})`, 'gi');
    return text.replace(rx, '<mark class="mark-search">$1</mark>');
  }
});
