<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{

    // =============================
    // LIST DATA
    // =============================
    public function index()
    {

        $slides = AdminTable::paginate(HeroSlide::orderByDesc('sort_order')
            ->latest(), ['title', 'description', 'media_type'], 'slides', 10);

        return view(
            'admin.banner.index',
            compact('slides')
        );

    }



    // =============================
    // FORM CREATE
    // =============================
    public function create()
    {

        return view('admin.banner.create');

    }



    // =============================
    // STORE DATA
    // =============================
    public function store(Request $request)
    {

        $request->validate([

            'title' => 'nullable|string|max:255',

            'description' => 'nullable|string',

            'media_path' => 'nullable|required_without:manual_media_path|file|mimes:jpg,jpeg,png,mp4,webm|max:102400',

            'manual_media_path' => 'nullable|required_without:media_path|string|max:2048',

            'manual_media_type' => 'nullable|in:image,video',

            'media_fit' => 'required|in:fill,cover,contain',

            'media_position' => 'required|in:center center,top center,bottom center,left center,right center',

            'banner_dimension' => 'required|in:compact,medium,large',

            'sort_order' => 'nullable|integer|min:0|max:9999',

            'is_active' => 'required'

        ]);


        [$path, $type] = $this->resolveSubmittedMedia($request);


        HeroSlide::create([

            'title' => $request->title,

            'description' => $request->description,

            'media_path' => $path,

            'media_type' => $type,

            'media_fit' => $request->media_fit,

            'media_position' => $request->media_position,

            'banner_dimension' => $request->banner_dimension,

            'sort_order' => $request->integer('sort_order', 0),

            'is_active' => $request->is_active

        ]);


        return redirect('/admin/banner')
            ->with(
                'success',
                'Banner berhasil ditambah'
            );

    }



    // =============================
    // FORM EDIT
    // =============================
    public function edit($id)
    {

        $slide = HeroSlide::findOrFail($id);

        return view(
            'admin.banner.edit',
            compact('slide')
        );

    }



    // =============================
    // UPDATE DATA
    // =============================
    public function update(
        Request $request,
        $id
    )
    {

        $slide = HeroSlide::findOrFail($id);


        $request->validate([

            'title' => 'nullable|string|max:255',

            'description' => 'nullable|string',

            'media_path' => 'nullable|file|mimes:jpg,jpeg,png,mp4,webm|max:102400',

            'manual_media_path' => 'nullable|string|max:2048',

            'manual_media_type' => 'nullable|in:image,video',

            'media_fit' => 'required|in:fill,cover,contain',

            'media_position' => 'required|in:center center,top center,bottom center,left center,right center',

            'banner_dimension' => 'required|in:compact,medium,large',

            'sort_order' => 'nullable|integer|min:0|max:9999',

            'is_active' => 'required'

        ]);


        if(
            $request->hasFile('media_path')
        ){

            $this->deleteStoredMedia($slide->media_path);

            $file =
                $request->file('media_path');


            $path = $this->storePublicImageMedia($file);


            $type =
                str_contains(
                    $file->getMimeType(),
                    'video'
                )
                ? 'video'
                : 'image';


            $slide->media_path =
                $path;


            $slide->media_type =
                $type;

        } elseif($request->filled('manual_media_path')){

            $this->deleteStoredMedia($slide->media_path);

            $slide->media_path =
                trim($request->manual_media_path);

            $slide->media_type =
                $this->resolveManualMediaType(
                    $slide->media_path,
                    $request->manual_media_type
                );

        }



        $slide->title =
            $request->title;


        $slide->description =
            $request->description;


        $slide->is_active =
            $request->is_active;


        $slide->media_fit =
            $request->media_fit;


        $slide->media_position =
            $request->media_position;


        $slide->banner_dimension =
            $request->banner_dimension;

        $slide->sort_order =
            $request->integer('sort_order', 0);


        $slide->save();



        return redirect('/admin/banner')
            ->with(
                'success',
                'Banner berhasil diupdate'
            );

    }



    // =============================
    // DELETE DATA
    // =============================
    public function destroy($id)
    {

        $slide =
            HeroSlide::findOrFail($id);


        $this->deleteStoredMedia($slide->media_path);


        $slide->delete();


        return back()
            ->with(
                'success',
                'Banner berhasil dihapus'
            );

    }



    // =============================
    // AKTIF / NONAKTIF
    // =============================
    public function toggle($id)
    {

        $slide =
            HeroSlide::findOrFail($id);


        $slide->is_active =
            !$slide->is_active;


        $slide->save();


        return back()
            ->with(
                'success',
                'Status banner diperbarui'
            );

    }



    private function resolveSubmittedMedia(Request $request): array
    {

        if($request->hasFile('media_path')){

            $file = $request->file('media_path');

            $path = $this->storePublicImageMedia($file);

            $type = str_contains(
                $file->getMimeType(),
                'video'
            )
                ? 'video'
                : 'image';

            return [$path, $type];

        }

        $path = trim($request->manual_media_path);

        return [
            $path,
            $this->resolveManualMediaType(
                $path,
                $request->manual_media_type
            ),
        ];

    }



    private function resolveManualMediaType(
        string $path,
        ?string $selectedType
    ): string
    {

        if(in_array($selectedType, ['image', 'video'], true)){
            return $selectedType;
        }

        $extension = strtolower(
            pathinfo(
                parse_url($path, PHP_URL_PATH) ?: $path,
                PATHINFO_EXTENSION
            )
        );

        return in_array($extension, ['mp4', 'webm'], true)
            ? 'video'
            : 'image';

    }



    private function deleteStoredMedia(
        ?string $storagePath
    ): void
    {

        if(! $this->isUploadedMedia($storagePath)){
            return;
        }

        if (str_starts_with($storagePath, 'banner/')) {
            Storage::disk('banner')->delete(substr($storagePath, strlen('banner/')));
        }

        // Compatibility with banners uploaded by versions sebelumnya.
        Storage::disk('public')->delete($storagePath);
        $this->deletePublicImageMedia($storagePath);

    }



    private function isUploadedMedia(
        ?string $storagePath
    ): bool
    {

        return filled($storagePath)
            && (
                str_starts_with($storagePath, 'banner/')
                || str_starts_with($storagePath, 'images/banner/')
            );

    }



    private function storePublicImageMedia($file): string
    {

        $fileName = uniqid('banner_', true) . '.' . strtolower($file->getClientOriginalExtension());
        $stored = $file->storeAs('', $fileName, 'banner');

        if (! $stored) {
            throw new \RuntimeException('File banner gagal disimpan. Periksa izin folder penyimpanan di hosting.');
        }

        return 'banner/' . $stored;

    }



    private function deletePublicImageMedia(
        ?string $storagePath
    ): void
    {

        if(! $storagePath || ! str_starts_with($storagePath, 'images/banner/')){
            return;
        }

        Storage::disk('legacy_public')->delete($storagePath);

    }

}
