document.addEventListener("DOMContentLoaded",()=>{const n={searchQuery:"",selectedJalur:"all",selectedJenjang:"all",selectedBank:"all",sortBy:"default"},r=document.getElementById("search-input"),o=document.getElementById("search-clear-btn"),f=document.querySelectorAll(".jalur-tab-btn"),d=document.getElementById("select-jenjang"),p=document.getElementById("select-bank"),g=document.getElementById("select-sort"),y=document.getElementById("btn-reset"),$=document.getElementById("count-shown"),_=document.getElementById("count-total"),u=document.getElementById("official-table-body"),h=document.getElementById("mobile-cards-container"),m=document.getElementById("empty-state"),c=document.getElementById("theme-toggle-btn"),b=document.getElementById("toast-popup"),w=document.getElementById("toast-text");L();function L(){D(),s(),C()}function C(){r&&r.addEventListener("input",e=>{n.searchQuery=e.target.value.trim().toLowerCase(),o&&(o.style.display=n.searchQuery?"block":"none"),s()}),o&&o.addEventListener("click",()=>{r.value="",n.searchQuery="",o.style.display="none",r.focus(),s()}),f.forEach(e=>{e.addEventListener("click",()=>{f.forEach(a=>a.classList.remove("active")),e.classList.add("active"),n.selectedJalur=e.dataset.jalur,s()})}),d&&d.addEventListener("change",e=>{n.selectedJenjang=e.target.value,s()}),p&&p.addEventListener("change",e=>{n.selectedBank=e.target.value,s()}),g&&g.addEventListener("change",e=>{n.sortBy=e.target.value,s()}),y&&y.addEventListener("click",S),c&&c.addEventListener("click",J)}function j(){let e=[];return n.selectedJalur==="all"?e=[...UFDK_DATA.reguler,...UFDK_DATA.non_reguler]:n.selectedJalur==="reguler"?e=[...UFDK_DATA.reguler]:n.selectedJalur==="rpl"&&(e=[...UFDK_DATA.non_reguler]),e}function E(){let e=j();if(n.searchQuery){const a=n.searchQuery;e=e.filter(t=>t.prodi.toLowerCase().includes(a)||t.pendidikan.toLowerCase().includes(a)||t.sistem_kuliah.toLowerCase().includes(a)||t.jenjang.toLowerCase().includes(a)||t.bank.toLowerCase().includes(a)||t.nama_rekening.toLowerCase().includes(a)||t.no_rekening.replace(/\s|\./g,"").includes(a.replace(/\s|\./g,"")))}switch(n.selectedJenjang!=="all"&&(e=e.filter(a=>a.jenjang.toUpperCase()===n.selectedJenjang.toUpperCase())),n.selectedBank!=="all"&&(e=e.filter(a=>a.bank.toUpperCase()===n.selectedBank.toUpperCase())),n.sortBy){case"sem-asc":e.sort((a,t)=>a.biaya_tiap_semester-t.biaya_tiap_semester);break;case"sem-desc":e.sort((a,t)=>t.biaya_tiap_semester-a.biaya_tiap_semester);break;case"tahap-asc":e.sort((a,t)=>a.biaya_per_tahap-t.biaya_per_tahap);break;case"tahap-desc":e.sort((a,t)=>t.biaya_per_tahap-a.biaya_per_tahap);break;case"nama-asc":e.sort((a,t)=>a.prodi.localeCompare(t.prodi));break}return e}function s(){const e=E(),a=UFDK_DATA.reguler.length+UFDK_DATA.non_reguler.length;if($&&($.textContent=e.length),_&&(_.textContent=a),e.length===0){m&&(m.style.display="block"),u&&(u.innerHTML=""),h&&(h.innerHTML="");return}m&&(m.style.display="none"),I(e),R(e)}function I(e){u&&(u.innerHTML=e.map((a,t)=>{const l=a.bank==="BRI"?"badge-bank-bri":"badge-bank-nagari",k=`badge-jenjang-${a.jenjang.toLowerCase()}`,H=a.kategori==="rpl"?"badge-program-rpl":a.kategori==="profesi"?"badge-program-profesi":"badge-program-reguler";return`
        <tr class="${n.selectedJalur==="all"&&a.kategori==="reguler"&&e[t+1]&&e[t+1].kategori!=="reguler"?"print-page-break-after":""}">
          <td class="col-idx">${t+1}</td>
          <td class="col-prodi-title">
            <div class="font-bold">${v(a.prodi,n.searchQuery)}</div>
            <div class="mt-1"><span class="badge ${k}">${a.jenjang_label}</span></div>
          </td>
          <td class="col-pendidikan font-mono">${v(a.pendidikan,n.searchQuery)}</td>
          <td class="col-sistem"><span class="badge ${H}">${v(a.sistem_kuliah,n.searchQuery)}</span></td>
          <td class="text-center font-bold font-mono">${a.jumlah_semester}</td>
          <td class="col-nominal-sem font-mono">${formatRupiah(a.biaya_tiap_semester)}</td>
          <td class="col-stage-val font-mono">${formatRupiah(a.tahap1)}</td>
          <td class="col-stage-val font-mono">${formatRupiah(a.tahap2)}</td>
          <td class="col-stage-val font-mono">${formatRupiah(a.tahap3)}</td>
          <td class="col-stage-val font-mono">${formatRupiah(a.tahap4)}</td>
          <td class="col-stage-val font-mono">${formatRupiah(a.tahap5)}</td>
          <td class="col-stage-val font-mono">${formatRupiah(a.tahap6)}</td>
          <td class="col-bank-wrap">
            <div class="bank-line">
              <span class="badge ${l}">${a.bank}</span>
              <span class="bank-acc-no font-mono">${a.no_rekening}</span>
              <button class="btn-copy-tag" data-acc="${a.no_rekening}" data-bank="${a.bank}" title="Salin Nomor Rekening">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                <span>Salin</span>
              </button>
            </div>
            <div class="bank-acc-name mt-1" title="${a.nama_rekening}">${a.nama_rekening}</div>
          </td>
        </tr>
      `}).join(""),B())}function R(e){h&&(h.innerHTML=e.map(a=>{const t=a.bank==="BRI"?"badge-bank-bri":"badge-bank-nagari",l=`badge-jenjang-${a.jenjang.toLowerCase()}`,k=a.kategori==="rpl"?"badge-program-rpl":a.kategori==="profesi"?"badge-program-profesi":"badge-program-reguler";return`
        <div class="mobile-prodi-card">
          <div class="card-tag-row">
            <span class="badge ${l}">${a.jenjang_label}</span>
            <span class="badge ${k}">${a.sistem_kuliah}</span>
          </div>

          <h3 class="card-title-h3">${v(a.prodi,n.searchQuery)}</h3>
          <div class="card-qualification"><strong>Kualifikasi:</strong> ${a.pendidikan}</div>

          <div class="card-stat-box">
            <div class="card-stat-item">
              <span class="card-stat-lbl">Biaya Tiap Semester:</span>
              <span class="card-stat-val text-navy">${formatRupiah(a.biaya_tiap_semester)}</span>
            </div>
            <div class="card-stat-item">
              <span class="card-stat-lbl">Masa Studi:</span>
              <span class="card-stat-val">${a.jumlah_semester} Semester</span>
            </div>
            <div class="card-stat-item">
              <span class="card-stat-lbl">Angsuran / Tahap:</span>
              <span class="card-stat-val text-orange">${formatRupiah(a.biaya_per_tahap)}</span>
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
                <span class="val">${formatRupiah(a.tahap1)}</span>
              </div>
              <div class="stage-item-mini">
                <span class="num">Tahap II:</span>
                <span class="val">${formatRupiah(a.tahap2)}</span>
              </div>
              <div class="stage-item-mini">
                <span class="num">Tahap III:</span>
                <span class="val">${formatRupiah(a.tahap3)}</span>
              </div>
              <div class="stage-item-mini">
                <span class="num">Tahap IV:</span>
                <span class="val">${formatRupiah(a.tahap4)}</span>
              </div>
              <div class="stage-item-mini">
                <span class="num">Tahap V:</span>
                <span class="val">${formatRupiah(a.tahap5)}</span>
              </div>
              <div class="stage-item-mini">
                <span class="num">Tahap VI:</span>
                <span class="val">${formatRupiah(a.tahap6)}</span>
              </div>
            </div>
          </div>

          <div class="card-bank-details">
            <div class="bank-line">
              <span class="badge ${t}">${a.bank}</span>
              <span class="bank-acc-no font-mono">${a.no_rekening}</span>
              <button class="btn-copy-tag" data-acc="${a.no_rekening}" data-bank="${a.bank}">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                <span>Salin</span>
              </button>
            </div>
            <div class="bank-acc-name mt-1">${a.nama_rekening}</div>
          </div>
        </div>
      `}).join(""),B())}function B(){document.querySelectorAll(".btn-copy-tag").forEach(e=>{e.addEventListener("click",a=>{a.stopPropagation();const t=e.dataset.acc,l=e.dataset.bank;A(t,`No. Rekening ${l} (${t}) berhasil disalin!`),M(e)})})}function A(e,a){const t=e.replace(/\s+/g," ").trim();navigator.clipboard&&window.isSecureContext?navigator.clipboard.writeText(t).then(()=>i(a)).catch(()=>T(t,a)):T(t,a)}function T(e,a){const t=document.createElement("textarea");t.value=e,t.style.position="fixed",t.style.opacity="0",document.body.appendChild(t),t.focus(),t.select();try{document.execCommand("copy"),i(a)}catch{i("Gagal menyalin")}document.body.removeChild(t)}function M(e){const a=e.innerHTML;e.classList.add("copied"),e.innerHTML='<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg> <span>Tersalin!</span>',setTimeout(()=>{e.classList.remove("copied"),e.innerHTML=a},2e3)}function i(e){!b||!w||(w.textContent=e,b.classList.add("show"),clearTimeout(window.toastTimer),window.toastTimer=setTimeout(()=>{b.classList.remove("show")},3e3))}function S(){r&&(r.value=""),o&&(o.style.display="none"),n.searchQuery="",n.selectedJalur="all",n.selectedJenjang="all",n.selectedBank="all",n.sortBy="default",f.forEach(e=>{e.dataset.jalur==="all"?e.classList.add("active"):e.classList.remove("active")}),d&&(d.value="all"),p&&(p.value="all"),g&&(g.value="default"),s(),i("Filter direset")}function D(){const e=localStorage.getItem("ufdk_theme")||"light";document.documentElement.setAttribute("data-theme",e),x(e)}function J(){const a=(document.documentElement.getAttribute("data-theme")||"light")==="light"?"dark":"light";document.documentElement.setAttribute("data-theme",a),localStorage.setItem("ufdk_theme",a),x(a),i(`Mode tema: ${a==="dark"?"Gelap":"Terang"}`)}function x(e){c&&(e==="dark"?c.innerHTML='<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line></svg> <span>Mode Terang</span>':c.innerHTML='<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg> <span>Mode Gelap</span>')}function v(e,a){if(!a)return e;const t=a.replace(/[.*+?^${}()|[\]\\]/g,"\\$&"),l=new RegExp(`(${t})`,"gi");return e.replace(l,'<mark class="mark-search">$1</mark>')}});
