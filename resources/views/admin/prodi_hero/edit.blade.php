@extends('admin.layouts.app')

@section('css')
<style>
    .hero-prodi-form-btn {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 0;
        color: #fff;
        transition: .2s ease;
        box-shadow: 0 8px 20px rgba(15, 23, 42, .12);
    }
    .hero-prodi-form-btn:hover {
        color: #fff;
        transform: translateY(-1px);
    }
    .hero-prodi-form-btn--save {
        background: #4b49ac;
    }
    .hero-prodi-form-btn--save:hover {
        background: #3f3d94;
    }
    .hero-prodi-form-btn--cancel {
        background: #64748b;
    }
    .hero-prodi-form-btn--cancel:hover {
        background: #475569;
    }
    .hero-prodi-help-text {
        color: #64748b;
        display: block;
        font-size: 12px;
        margin-top: 6px;
    }
    .hero-prodi-preview {
        width: 240px;
        height: 130px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }
    .hero-prodi-content-grid {
        display: grid;
        gap: 16px;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    }
    .hero-prodi-content-card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 14px;
        background: #f8fafc;
    }
    .hero-prodi-content-preview {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        background: #fff;
    }
    .hero-prodi-image-tools {
        display: grid;
        gap: 10px;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        margin-top: 12px;
    }
    .hero-prodi-image-tools label {
        color: #334155;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .hero-prodi-image-tools .form-control,
    .hero-prodi-image-tools .form-select {
        min-height: 38px;
    }
    .hero-prodi-image-tools--full {
        grid-column: 1 / -1;
    }
    .hero-prodi-processed-preview {
        display: none;
        margin-top: 10px;
    }
    .hero-prodi-processed-preview.is-visible {
        display: block;
    }
    .hero-prodi-processing-note {
        color: #0f766e;
        display: none;
        font-size: 12px;
        margin-top: 8px;
    }
    .hero-prodi-processing-note.is-visible {
        display: block;
    }
    @media (max-width: 575.98px) {
        .hero-prodi-image-tools {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title">Edit Hero Prodi</h3>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <strong>Data belum bisa disimpan.</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <h4 class="mb-4">{{ $prodi->nama_prodi }}</h4>

        <form method="POST"
              action="{{ route('prodi-hero.update', $prodi) }}"
              enctype="multipart/form-data"
              data-skip-global-confirm="true"
              data-confirm-submit="true"
              data-confirm-title="Update Hero Prodi?"
              data-confirm-text="Perubahan hero prodi akan disimpan."
              data-confirm-button="Ya, update">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Judul Hero</label>
                <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $prodi->hero_title) }}" placeholder="Kosongkan untuk memakai judul bawaan halaman">
                <small class="hero-prodi-help-text">Contoh: S1 Kesehatan Masyarakat.</small>
            </div>

            <div class="mb-3">
                <label>Deskripsi Hero</label>
                <textarea name="hero_subtitle" class="form-control" rows="4" placeholder="Kosongkan untuk memakai deskripsi bawaan halaman">{{ old('hero_subtitle', $prodi->hero_subtitle) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Gambar Hero</label>
                @if($prodi->hero_image_url)
                    <div class="mb-2">
                        <img src="{{ $prodi->hero_image_url }}" alt="Hero {{ $prodi->nama_prodi }}" class="hero-prodi-preview">
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="remove_hero_image" value="1" id="remove_hero_image">
                        <label class="form-check-label" for="remove_hero_image">Hapus gambar hero saat ini</label>
                    </div>
                @endif
                <input type="file" name="hero_image" class="form-control" accept="image/*">
                <small class="hero-prodi-help-text">Format jpg, jpeg, png, atau webp. Maksimal 4 MB.</small>
            </div>

            <div class="mb-4">
                <label>Posisi Gambar Hero</label>
                <input type="text" name="hero_image_position" class="form-control" value="{{ old('hero_image_position', $prodi->hero_image_position) }}" placeholder="contoh: center 35%">
                <small class="hero-prodi-help-text">Gunakan format CSS object-position. Kosongkan untuk posisi tengah.</small>
            </div>

            <hr>

            <div class="mb-4">
                <h5 class="mb-2">Foto Konten Halaman Prodi</h5>
                <small class="hero-prodi-help-text mb-3">
                    Foto ini dipakai pada section seperti Visi & Misi, Tujuan Prodi, dan Profil Lulusan. Jika kosong, halaman memakai gambar bawaan.
                </small>

                <div class="hero-prodi-content-grid">
                    @foreach($contentImageSlots as $slot => $slotLabel)
                        @php
                            $currentContentImage = $prodi->contentImageUrl($slot);
                            $currentContentImageSettings = $prodi->contentImageSettings($slot);
                        @endphp

                        <div class="hero-prodi-content-card"
                             data-content-image-card
                             data-slot="{{ $slot }}"
                             data-current-image-url="{{ $currentContentImage }}">
                            <label>{{ $slotLabel }}</label>

                            @if($currentContentImage)
                                <div class="my-2">
                                    <img src="{{ $currentContentImage }}" alt="{{ $slotLabel }} {{ $prodi->nama_prodi }}" class="hero-prodi-content-preview">
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="remove_content_images[{{ $slot }}]" value="1" id="remove_content_image_{{ $slot }}">
                                    <label class="form-check-label" for="remove_content_image_{{ $slot }}">Hapus foto ini</label>
                                </div>
                            @endif

                            <input type="file" name="content_images[{{ $slot }}]" class="form-control" accept="image/*" data-content-image-input>
                            <small class="hero-prodi-help-text">Format jpg, jpeg, png, atau webp. Maksimal 4 MB.</small>

                            <div class="hero-prodi-image-tools">
                                <div>
                                    <label for="content_width_{{ $slot }}">Lebar</label>
                                    <input type="number" min="240" max="2400" step="10" value="{{ old("content_image_settings.$slot.width", $currentContentImageSettings['width']) }}" id="content_width_{{ $slot }}" class="form-control" data-image-width name="content_image_settings[{{ $slot }}][width]">
                                </div>
                                <div>
                                    <label for="content_height_{{ $slot }}">Tinggi</label>
                                    <input type="number" min="180" max="1800" step="10" value="{{ old("content_image_settings.$slot.height", $currentContentImageSettings['height']) }}" id="content_height_{{ $slot }}" class="form-control" data-image-height name="content_image_settings[{{ $slot }}][height]">
                                </div>
                                <div class="hero-prodi-image-tools--full">
                                    <label for="content_fit_{{ $slot }}">Penyesuaian</label>
                                    <select id="content_fit_{{ $slot }}" class="form-control" data-image-fit name="content_image_settings[{{ $slot }}][fit]">
                                        <option value="cover" @selected(old("content_image_settings.$slot.fit", $currentContentImageSettings['fit']) === 'cover')>Potong rapi memenuhi ukuran</option>
                                        <option value="contain" @selected(old("content_image_settings.$slot.fit", $currentContentImageSettings['fit']) === 'contain')>Masukkan semua foto</option>
                                        <option value="stretch" @selected(old("content_image_settings.$slot.fit", $currentContentImageSettings['fit']) === 'stretch')>Tarik sesuai ukuran</option>
                                    </select>
                                </div>
                                <div class="hero-prodi-image-tools--full">
                                    <div class="form-check mb-1">
                                        <input type="hidden" name="content_image_settings[{{ $slot }}][remove_background]" value="0">
                                        <input class="form-check-input" type="checkbox" id="remove_bg_{{ $slot }}" data-remove-bg name="content_image_settings[{{ $slot }}][remove_background]" value="1" @checked(old("content_image_settings.$slot.remove_background", $currentContentImageSettings['remove_background']))>
                                        <label class="form-check-label" for="remove_bg_{{ $slot }}">Auto remove background polos</label>
                                    </div>
                                    <input type="range" min="12" max="96" value="{{ old("content_image_settings.$slot.background_tolerance", $currentContentImageSettings['background_tolerance']) }}" class="form-control-range" data-bg-tolerance name="content_image_settings[{{ $slot }}][background_tolerance]" aria-label="Toleransi hapus background">
                                    <small class="hero-prodi-help-text">Paling cocok untuk background putih/polos. Naikkan toleransi jika background belum bersih.</small>
                                </div>
                            </div>

                            <div class="hero-prodi-processed-preview" data-processed-preview-wrap>
                                <small class="hero-prodi-help-text">Preview hasil yang akan diupload:</small>
                                <img src="" alt="Preview hasil {{ $slotLabel }}" class="hero-prodi-content-preview" data-processed-preview>
                            </div>
                            <span class="hero-prodi-processing-note" data-processing-note>Foto akan diproses otomatis saat disimpan.</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="d-flex gap-2">
                <button class="hero-prodi-form-btn hero-prodi-form-btn--save" title="Simpan Hero Prodi" aria-label="Simpan Hero Prodi">
                    <i class="fas fa-save"></i>
                </button>
                <a href="{{ route('prodi-hero.index') }}" class="hero-prodi-form-btn hero-prodi-form-btn--cancel" title="Kembali" aria-label="Kembali">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    (function () {
        const form = document.querySelector('form[action="{{ route('prodi-hero.update', $prodi) }}"]');
        const cards = Array.from(document.querySelectorAll('[data-content-image-card]'));

        if (!form || !cards.length || !window.FileReader || !window.HTMLCanvasElement || !window.DataTransfer) {
            return;
        }

        const csrfToken = form.querySelector('input[name="_token"]').value;
        let isSubmitting = false;

        const clamp = function (value, min, max, fallback) {
            const parsed = Number.parseInt(value, 10);
            if (Number.isNaN(parsed)) {
                return fallback;
            }

            return Math.min(Math.max(parsed, min), max);
        };

        const loadImageFromBlob = function (blob) {
            return new Promise(function (resolve, reject) {
                const image = new Image();
                const url = URL.createObjectURL(blob);

                image.onload = function () {
                    URL.revokeObjectURL(url);
                    resolve(image);
                };

                image.onerror = function () {
                    URL.revokeObjectURL(url);
                    reject(new Error('Gambar tidak bisa dibaca.'));
                };

                image.src = url;
            });
        };

        const loadImageFromUrl = async function (url) {
            const response = await fetch(url, { cache: 'no-store' });

            if (!response.ok) {
                throw new Error('Foto lama tidak bisa diproses ulang.');
            }

            return loadImageFromBlob(await response.blob());
        };

        const canvasToBlob = function (canvas, type, quality) {
            return new Promise(function (resolve) {
                canvas.toBlob(resolve, type, quality);
            });
        };

        const getCornerColor = function (data, width, height) {
            const points = [
                [2, 2],
                [width - 3, 2],
                [2, height - 3],
                [width - 3, height - 3],
            ];
            const color = [0, 0, 0];
            let count = 0;

            points.forEach(function (point) {
                const x = Math.min(Math.max(point[0], 0), width - 1);
                const y = Math.min(Math.max(point[1], 0), height - 1);
                const index = (y * width + x) * 4;

                if (data[index + 3] > 20) {
                    color[0] += data[index];
                    color[1] += data[index + 1];
                    color[2] += data[index + 2];
                    count++;
                }
            });

            if (!count) {
                return [255, 255, 255];
            }

            return color.map(function (channel) {
                return Math.round(channel / count);
            });
        };

        const removeFlatBackground = function (context, width, height, tolerance) {
            const imageData = context.getImageData(0, 0, width, height);
            const data = imageData.data;
            const background = getCornerColor(data, width, height);
            const hardLimit = tolerance * 4.4;
            const softLimit = hardLimit + 38;

            for (let index = 0; index < data.length; index += 4) {
                const red = data[index] - background[0];
                const green = data[index + 1] - background[1];
                const blue = data[index + 2] - background[2];
                const distance = Math.sqrt(red * red + green * green + blue * blue);

                if (distance <= hardLimit) {
                    data[index + 3] = 0;
                } else if (distance <= softLimit) {
                    data[index + 3] = Math.round(data[index + 3] * ((distance - hardLimit) / (softLimit - hardLimit)));
                }
            }

            context.putImageData(imageData, 0, 0);
        };

        const drawImage = function (context, image, width, height, fit, transparent) {
            if (!transparent) {
                context.fillStyle = '#ffffff';
                context.fillRect(0, 0, width, height);
            }

            if (fit === 'stretch') {
                context.drawImage(image, 0, 0, width, height);
                return;
            }

            const sourceRatio = image.naturalWidth / image.naturalHeight;
            const targetRatio = width / height;
            let drawWidth = width;
            let drawHeight = height;
            let drawX = 0;
            let drawY = 0;

            if ((fit === 'cover' && sourceRatio > targetRatio) || (fit === 'contain' && sourceRatio < targetRatio)) {
                drawHeight = height;
                drawWidth = height * sourceRatio;
                drawX = (width - drawWidth) / 2;
            } else {
                drawWidth = width;
                drawHeight = width / sourceRatio;
                drawY = (height - drawHeight) / 2;
            }

            context.drawImage(image, drawX, drawY, drawWidth, drawHeight);
        };

        const processCardImage = async function (card) {
            const input = card.querySelector('[data-content-image-input]');
            const file = input && input.files ? input.files[0] : null;
            const currentImageUrl = card.dataset.currentImageUrl;
            const isDirty = card.dataset.settingsDirty === 'true';

            if ((!file && (!isDirty || !currentImageUrl)) || input.dataset.processed === 'true') {
                return;
            }

            const width = clamp(card.querySelector('[data-image-width]').value, 240, 2400, 900);
            const height = clamp(card.querySelector('[data-image-height]').value, 180, 1800, 620);
            const fit = card.querySelector('[data-image-fit]').value;
            const shouldRemoveBackground = card.querySelector('[data-remove-bg]').checked;
            const tolerance = clamp(card.querySelector('[data-bg-tolerance]').value, 12, 96, 42);
            const image = file ? await loadImageFromBlob(file) : await loadImageFromUrl(currentImageUrl);
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d', { willReadFrequently: shouldRemoveBackground });

            canvas.width = width;
            canvas.height = height;

            drawImage(context, image, width, height, fit, shouldRemoveBackground);

            if (shouldRemoveBackground) {
                removeFlatBackground(context, width, height, tolerance);
            }

            const outputType = shouldRemoveBackground ? 'image/png' : 'image/jpeg';
            const extension = shouldRemoveBackground ? 'png' : 'jpg';
            const blob = await canvasToBlob(canvas, outputType, 0.9);

            if (!blob) {
                return;
            }

            const cleanName = file ? file.name.replace(/\.[^.]+$/, '') : (card.dataset.slot || 'foto-konten');
            const processedFile = new File([blob], cleanName + '-konten-prodi.' + extension, { type: outputType });
            const transfer = new DataTransfer();
            transfer.items.add(processedFile);
            input.files = transfer.files;
            input.dataset.processed = 'true';
            card.dataset.settingsDirty = 'false';

            const preview = card.querySelector('[data-processed-preview]');
            const previewWrap = card.querySelector('[data-processed-preview-wrap]');
            if (preview && previewWrap) {
                preview.src = URL.createObjectURL(processedFile);
                previewWrap.classList.add('is-visible');
            }
        };

        cards.forEach(function (card) {
            const input = card.querySelector('[data-content-image-input]');
            const controls = card.querySelectorAll('[data-image-width], [data-image-height], [data-image-fit], [data-remove-bg], [data-bg-tolerance]');
            const note = card.querySelector('[data-processing-note]');

            if (!input) {
                return;
            }

            input.addEventListener('change', function () {
                input.dataset.processed = 'false';
                if (input.files.length && note) {
                    note.classList.add('is-visible');
                }
            });

            controls.forEach(function (control) {
                const markDirty = function () {
                    input.dataset.processed = 'false';
                    card.dataset.settingsDirty = 'true';
                    if ((input.files.length || card.dataset.currentImageUrl) && note) {
                        note.classList.add('is-visible');
                    }
                };

                control.addEventListener('change', markDirty);
                control.addEventListener('input', markDirty);
            });
        });

        const showSuccess = function (message) {
            if (window.Swal) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: message,
                    timer: 1800,
                    showConfirmButton: false
                });
                return;
            }

            alert(message);
        };

        const showError = function (message) {
            if (window.Swal) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menyimpan',
                    text: message,
                    confirmButtonColor: '#ea580c'
                });
                return;
            }

            alert(message);
        };

        const confirmSave = function () {
            if (!window.Swal) {
                return Promise.resolve(window.confirm('Perubahan hero prodi akan disimpan?'));
            }

            return Swal.fire({
                icon: 'question',
                title: form.dataset.confirmTitle || 'Update Hero Prodi?',
                text: form.dataset.confirmText || 'Perubahan hero prodi akan disimpan.',
                showCancelButton: true,
                confirmButtonText: form.dataset.confirmButton || 'Ya, update',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#ea580c',
                cancelButtonColor: '#64748b'
            }).then(function (result) {
                return result.isConfirmed;
            });
        };

        const updateCardsAfterSave = function (contentImages) {
            cards.forEach(function (card) {
                const slot = card.dataset.slot;
                const data = contentImages && contentImages[slot] ? contentImages[slot] : null;
                const input = card.querySelector('[data-content-image-input]');
                const currentPreview = card.querySelector('.my-2 img.hero-prodi-content-preview');
                const processedPreview = card.querySelector('[data-processed-preview]');
                const note = card.querySelector('[data-processing-note]');

                if (data && data.url) {
                    card.dataset.currentImageUrl = data.url;
                    if (currentPreview) {
                        currentPreview.src = data.url;
                    }
                }

                if (input) {
                    input.value = '';
                    input.dataset.processed = 'false';
                }

                card.dataset.settingsDirty = 'false';

                if (processedPreview && data && data.url) {
                    processedPreview.src = data.url;
                }

                if (note) {
                    note.classList.remove('is-visible');
                }
            });
        };

        form.addEventListener('submit', async function (event) {
            event.preventDefault();

            if (isSubmitting) {
                return;
            }

            const confirmed = await confirmSave();
            if (!confirmed) {
                return;
            }

            isSubmitting = true;

            const cardsToProcess = cards.filter(function (card) {
                const input = card.querySelector('[data-content-image-input]');
                return input && (input.files.length || (card.dataset.settingsDirty === 'true' && card.dataset.currentImageUrl));
            });

            const submitButton = form.querySelector('button[type="submit"], button:not([type])');
            if (submitButton) {
                submitButton.disabled = true;
            }

            try {
                await Promise.all(cardsToProcess.map(processCardImage));

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });

                const result = await response.json().catch(function () {
                    return {};
                });

                if (!response.ok) {
                    const validationMessage = result.errors
                        ? Object.values(result.errors).flat().join(' ')
                        : (result.message || 'Data belum bisa disimpan.');
                    throw new Error(validationMessage);
                }

                updateCardsAfterSave(result.content_images);
                showSuccess(result.message || 'Hero prodi berhasil diupdate');
            } catch (error) {
                showError(error.message || 'Foto konten gagal diproses.');
            } finally {
                if (submitButton) {
                    submitButton.disabled = false;
                }
                isSubmitting = false;
            }
        });
    })();
</script>
@endsection
