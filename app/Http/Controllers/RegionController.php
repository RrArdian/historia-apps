<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Kabupaten;
use App\Http\Models\Kecamatan;
use App\Http\Models\Peta;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $lokasi = Kabupaten::all();

        return view('admin.lokasi.index')->withLokasi($lokasi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        $lokasi = Kabupaten::with('kecamatan')->whereSlugNama($slug)->first();

        return view('admin.lokasi.kecamatan')->withLokasi($lokasi);
    }

    public function kabupatencagarbudaya($slug)
    {
        $lokasi = Kabupaten::with('kecamatan')->whereSlugNama($slug)->first();

        $kec = [];

        foreach ($lokasi->kecamatan as $q) {
            array_push($kec, $q->id);
        }

        $peta = Peta::with('kecamatan', 'kategori', 'foto')->whereIn('kecamatan_id', $kec)->orderBy('nama_lokasi', 'ASC')->get();

        return view('admin.lokasi.cagarbudaya')->withLokasi($lokasi)->withPeta($peta);
    }

    public function kecamatancagarbudaya($slug)
    {
        $lokasi = Kecamatan::with('kabupaten', 'peta.kategori', 'peta.foto')->whereSlugNama($slug)->first();

        return view('admin.lokasi.kecamatancagarbudaya')->withLokasi($lokasi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
