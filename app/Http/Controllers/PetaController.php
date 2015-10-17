<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;
use Validator;
use App\Http\Models\Foto;
use App\Http\Models\Kabupaten;
use App\Http\Models\Kategori;
use App\Http\Models\Peta;
use App\Http\Models\Video;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $peta = Peta::with('kategori', 'kecamatan.kabupaten', 'foto')->orderBy('id', 'DESC')->get();

        return view('admin.peta.index')->withPeta($peta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $kategori = Kategori::all();

        $kabupaten = Kabupaten::all();

        return view('admin.peta.create')->withKategori($kategori)->withKabupaten($kabupaten);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|max:50',
            'kategori' => 'required',
            'singkat' => 'required|max:2048',
            'lengkap' => 'required|max:65536',
            'kecamatan' => 'required',
            'alamat' => 'required|max:255',
            'latitude' => 'required',
            'longitude' => 'required'
        ];

        $v = Validator::make($request->all(), $rules);

        if ($v->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($v);
        } else {
            
            $peta = new Peta;
            $peta->kategori_id = $request->input('kategori');
            $peta->nama_lokasi = $request->input('nama');
            $peta->slug_nama = str_slug($request->input('nama'));
            $peta->deskripsi_singkat = $request->input('singkat');
            $peta->deskripsi_lengkap = $request->input('lengkap');
            $peta->alamat = $request->input('alamat');
            $peta->kecamatan_id = $request->input('kecamatan');
            $peta->latitude = $request->input('latitude');
            $peta->longitude = $request->input('longitude');
            $peta->save();

            for ($i=0; $i < count($request->input('files')); $i++) {
                $namafoto = $request->input('nama');
                $a = $i + 1;
                $ekstensi = explode('.', $request->input('files')[$i]);
                $newname = str_slug($namafoto . ' ' . $a). '.' . $ekstensi[1];
                rename($request->input('files')[$i], 'assets/img/cagar-budaya/' . $newname);

                $foto = new Foto;
                $foto->peta_id = Peta::max('id');
                $foto->keterangan_foto = $namafoto . ' ' . $a;
                $foto->nama_file = $newname;
                $foto->url_foto = 'assets/img/cagar-budaya/' . $newname;
                $foto->save();
            }

            $video = new Video;
            $video->peta_id = Peta::max('id');
            $video->nama_video = $request->input('nama') . ' Video';
            $video->link_video = $request->input('video');
            $video->save();

            return redirect('admin/peta')->with('message', 'Data peta cagar budaya berhasil ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        $peta = Peta::with('kategori', 'kecamatan.kabupaten')->whereSlugNama($slug)->first();

        return view('admin.peta.show')->withPeta($peta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($slug)
    {
        $kategori = Kategori::all();

        $kabupaten = Kabupaten::all();

        $peta = Peta::with('kategori', 'kecamatan.kabupaten')->whereSlugNama($slug)->first();

        return view('admin.peta.edit')->withKategori($kategori)->withKabupaten($kabupaten)->withPeta($peta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required|max:50',
            'kategori' => 'required',
            'singkat' => 'required|max:459',
            'lengkap' => 'required|max:65536',
            'kecamatan' => 'required',
            'alamat' => 'required|max:255',
            'latitude' => 'required',
            'longitude' => 'required'
        ];

        $v = Validator::make($request->all(), $rules);

        if ($v->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($v);
        } else {
            
            $peta = Peta::find($id);
            $peta->kategori_id = $request->input('kategori');
            $peta->nama_lokasi = $request->input('nama');
            $peta->slug_nama = str_slug($request->input('nama'));
            $peta->deskripsi_singkat = $request->input('singkat');
            $peta->deskripsi_lengkap = $request->input('lengkap');
            $peta->alamat = $request->input('alamat');
            $peta->kecamatan_id = $request->input('kecamatan');
            $peta->latitude = $request->input('latitude');
            $peta->longitude = $request->input('longitude');
            $peta->save();

            return redirect('admin/peta')->with('message', 'Data peta cagar budaya berhasil diperbaharui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $peta = Peta::find($id);
        $peta->delete();

        $foto = Foto::wherePetaId($id)->get();

        foreach ($foto as $q) {
            if (File::exists(public_path().'/'.$q->url_foto)) {
                unlink($q->url_foto);
            }
        }

        Foto::wherePetaId($id)->delete();

        return redirect()->back()->with('message', 'Data peta cagar budaya berhasil dihapus');
    }
}
