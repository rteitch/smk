<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        if($status){
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
        $dom->loadHTML($request->konten,LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $images=$dom->getElementsByTagName('img');
        foreach($images as $img){
            $src=$img->getAttribute('src');
            if(preg_match('/data:image/', $src)){
                preg_match('/data:image\/(?<mime>.*?)\;/',$src,$groups);
                $mimetype=$groups['mime'];
                $fileNameContent=uniqid();
                $fileNameContentRand=substr(md5($fileNameContent),6,6).'_'.time();
                $filepath=("$storage/$fileNameContentRand.$mimetype");
                $image=Image::make($src)->resize(null,720, function($constraint) {$constraint->aspectRatio();})->encode($mimetype,100)->save(public_path($filepath));
                $new_src=asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src',$new_src);
                $img->setAttribute('class','img-responsive');
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
            return redirect()->route('artikel.create')->with('status', 'artikel successfully saved and published');
        } else {
            return redirect()->route('artikel.create')->with('status', 'artikel saved as draft');
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
        $artikel = \App\Models\Artikel::with('users')->findOrFail($id);

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
        //
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
        //

        $storage = "storage/images";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->konten,LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $images=$dom->getElementsByTagName('img');
        foreach($images as $img){
            $src=$img->getAttribute('src');
            if(preg_match('/data:image/', $src)){
                preg_match('/data:image\/(?<mime>.*?)\;/',$src,$groups);
                $mimetype=$groups['mime'];
                $fileNameContent=uniqid();
                $fileNameContentRand=substr(md5($fileNameContent),6,6).'_'.time();
                $filepath=("$storage/$fileNameContentRand.$mimetype");
                $image=Image::make($src)->resize(null,720, function($constraint) {$constraint->aspectRatio();})->encode($mimetype,100)->save(public_path($filepath));
                $new_src=asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src',$new_src);
                $img->setAttribute('class','img-responsive');
            }
        }

        $artikel_update = new \App\Models\Artikel;
        $artikel_update->update([
            'konten'=>$request->$dom->saveHTML()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
