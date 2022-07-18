<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $keyword = $request->get('keyword') ?: '';

        if ($status) {
            $artikel = \App\Models\Artikel::where('title', "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(10);
        } else {
            $artikel = \App\Models\Artikel::where("title", "LIKE", "%$keyword%")->paginate(10);
        }
        return view('backend.artikel.index', ['artikel' => $artikel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artikel_baru = new \App\Models\Artikel;
        //upload file gambar yang di text editor
        $storage = "images";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filepath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)->resize(null, 720, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode($mimetype, 100)->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-fluid');
            }
        }

        $getJudul = $request->get('title');
        $artikel_baru->title = $getJudul;
        $artikel_baru->konten = $dom->saveHTML();
        $artikel_baru->slug = \Str::slug($request->get('title'));

        // file_pendukung

        $file_pendukung = $request->file('file_pendukung');

        if ($file_pendukung) {

            $filename = $file_pendukung->getClientOriginalName();

            if ($filename && file_exists(storage_path('app/public/file_pendukung/' . $filename))) {
                $fileNameimgRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filename_new = $fileNameimgRand . $filename;
                $file_path_new = $file_pendukung->storeAs('file_pendukung', $filename_new, 'public');
                $artikel_baru->file_pendukung = $file_path_new;
            }

            $file_path = $file_pendukung->storeAs('file_pendukung', $filename, 'public');
            $artikel_baru->file_pendukung = $file_path;
        }

        //cover / image
        $image = $request->file('image');

        if ($image) {
            $image_path = $image->store('artikel-image', 'public');

            $artikel_baru->image = $image_path;
        }
        $artikel_baru->user_id = \Auth::user()->id;
        $artikel_baru->created_by = \Auth::user()->id;
        $artikel_baru->status = $request->get('save_action');

        $artikel_baru->save();
        $artikel_baru->skill()->attach($request->get('skill'));

        if ($request->get('save_action') == 'PUBLISH') {
            return redirect()->route('artikel.index')->with('status', 'artikel successfully saved and published');
        } else {
            return redirect()->route('artikel.index')->with('status', 'artikel saved as draft');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artikel = \App\Models\Artikel::with('user')->findOrFail($id);

        return view('backend.artikel.show', ['artikel' => $artikel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artikel_to_edit = \App\Models\Artikel::findOrFail($id);

        return view('backend.artikel.edit', ['artikel' => $artikel_to_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $artikel = \App\Models\Artikel::findOrFail($id);
        //upload file gambar yang di text editor
        $storage = "images";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if ($src && file_exists(storage_path('app/public/images' . $src))) {
                \Storage::delete('public/images' . $src);
            };
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filepath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)->resize(null, 720, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode($mimetype, 100)->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-fluid');
            }
        }

        $judul = $request->get('title');
        $artikel->title = $judul;
        $artikel->konten = $dom->saveHTML();
        $slug = Str::slug($judul, '-');
        $artikel->slug = $slug;

        // file_pendukung

        $new_file_pendukung = $request->file('file_pendukung');

        if ($new_file_pendukung) {
            if ($artikel->file_pendukung && file_exists(storage_path('app/public/' . $artikel->file_pendukung))) {
                \Storage::delete('public/' . $artikel->file_pendukung);
            }

            $filename = $new_file_pendukung->getClientOriginalName();
            $file_path = $new_file_pendukung->storeAs('file_pendukung', $filename, 'public');

            $artikel->file_pendukung = $file_path;
        }

        //cover / image
        $new_image = $request->file('image');

        if ($new_image) {
            if ($artikel->image && file_exists(storage_path('app/public/' . $artikel->image))) {
                \Storage::delete('public/' . $artikel->image);
            }

            $new_image_path = $new_image->store('artikel-image', 'public');

            $artikel->image = $new_image_path;
        }
        $artikel->user_id = \Auth::user()->id;
        $artikel->created_by = \Auth::user()->id;

        $artikel->status = $request->get('status');

        $artikel->save();
        $artikel->skill()->sync($request->get('skill'));

        return redirect()->route('artikel.index', [$artikel->id])->with('status', 'Artikel successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artikel = \App\Models\Artikel::findOrFail($id);
        $artikel->delete();

        return redirect()->route('artikel.index')->with('status', 'Artikel moved to trash');
    }


    public function trash()
    {
        $artikels = \App\Models\Artikel::onlyTrashed()->paginate(10);
        return view('backend.artikel.trash', ['artikel' => $artikels]);
    }

    public function deletePermanent($id)
    {
        $artikels = \App\Models\Artikel::withTrashed()->findOrFail($id);

        if (!$artikels->trashed()) {
            return redirect()->route('artikel.trash')->with('status', 'Artikel is not in trash!')->with('status_type', 'alert');
        } else {
            $artikels->skill()->detach();
            $artikels->forceDelete();

            return redirect()->route('artikel.trash')->with('status', 'Artikel permanently deleted!');
        }
    }

    public function restore($id)
    {
        $artikels = \App\Models\Artikel::withTrashed()->findOrFail($id);
        if ($artikels->trashed()) {
            $artikels->restore();
            return redirect()->route('artikel.trash')->with('status', 'Artikel successfully restored');
        } else {
            return redirect()->route('artikel.trash')->with('status', 'Artikel is not in trash');
        }
    }

    public function published(Request $request)
    {
        $artikel = \App\Models\Artikel::with('user')->with('skill')->orderBy('title', 'asc')->where('status', 'PUBLISH')->paginate(5);

        return view('backend.artikel.published', ['artikel' => $artikel]);
    }

    public function lihatArtikel($slug)
    {
        $artikel = \App\Models\Artikel::with('user')->with('skill')->where('slug', $slug)->first();

        return view('backend.artikel.lihat-artikel', ['artikel' => $artikel]);
    }
}
