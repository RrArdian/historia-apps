<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Kabupaten;
use App\Http\Models\Kecamatan;
use App\Http\Models\Kategori;
use App\Http\Models\Peta;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function peta(Request $request)
    {
        if ($request->input('limit') == '') {

            return response()->json(['error' => false, 'peta' => Peta::with('kategori', 'kecamatan.kabupaten', 'foto')->orderBy('id', 'DESC')->get()]);
        } else {

            return response()->json(['error' => false, 'jumlah' => $request->input('limit'), 'peta' => Peta::with('kategori', 'kecamatan.kabupaten', 'foto')->orderBy('id', 'DESC')->take($request->input('limit'))->get()]);
        }
    }

    public function caripeta(Request $request)
    {
        $data = Peta::with('kategori', 'kecamatan.kabupaten', 'foto')->where('nama_lokasi', 'LIKE', '%'.$request->input('q').'%')->orderBy('id', 'DESC')->get();

        if ($data->count() > 0) {

            return response()->json(['error' => false, 'count' => $data->count(), 'peta' => $data]);
        } else {

            return response()->json(['error' => true, 'message' => 'Data peta tidak ditemukan']);            
        }
    }

    public function terdekat(Request $request)
    {
        if ($request->input('limit') != '') {
            $data = Peta::getByDistance($request->input('lat'), $request->input('long'), $request->input('jarak'), $request->input('limit'));
        } else {
            $data = Peta::getByDistance($request->input('lat'), $request->input('long'), $request->input('jarak'), '100');
        }

        $peta = [];

        foreach($data as $q)
        {
            array_push($peta, ['peta' => Peta::with('kategori', 'kecamatan.kabupaten', 'foto')->find($q->id), 'jarak' => ceil($q->distance)]);
        }

        if (!empty($data)) {

            return response()->json(['error' => false, 'data' => $peta]);
        } else {

            return response()->json(['error' => true, 'message' => 'Data peta tidak ditemukan']);            
        }
    }

    public function kabupaten()
    {
        return response()->json(['error' => false, 'kabupaten' => Kabupaten::all()]);
    }

    public function showkabupaten($id)
    {
        return response()->json(['error' => false, 'kabupaten' => Kabupaten::whereId($id)->pluck('nama_kabupaten'), 'kecamatan' => Kecamatan::where('kabupaten_id', $id)->get()]);
    }

    public function petakabupaten(Request $request, $id)
    {
        $data = Kabupaten::with('kecamatan')->find($id);

        $ids = [];

        foreach ($data->kecamatan as $q) {
            array_push($ids, $q->id);    
        }

        if ($request->input('limit') == '') {

            return response()->json(['error' => false, 'kabupaten' => Kabupaten::whereId($id)->pluck('nama_kabupaten'), 'peta' => Peta::with('kategori', 'kecamatan.kabupaten', 'foto')->whereIn('kecamatan_id', $ids)->orderBy('id', 'DESC')->get()]);
        }

        else {

            return response()->json(['error' => false, 'kabupaten' => Kabupaten::whereId($id)->pluck('nama_kabupaten'), 'peta' => Peta::with('kategori', 'kecamatan.kabupaten', 'foto')->whereIn('kecamatan_id', $ids)->orderBy('id', 'DESC')->take($request->input('limit'))->get()]);
        }
    }

    public function kecamatan()
    {
        return response()->json(['error' => false, 'kecamatan' => Kecamatan::all()]);
    }

    public function petakecamatan(Request $request, $id)
    {
        if ($request->input('limit') == '') {

            return response()->json(['error' => false, 'kecamatan' => Kecamatan::whereId($id)->pluck('nama_kecamatan'), 'peta' => Peta::with('kecamatan.kabupaten', 'kategori', 'foto')->whereKecamatanId($id)->orderBy('id', 'DESC')->get()]);
        }

        else {

            return response()->json(['error' => false, 'kecamatan' => Kecamatan::whereId($id)->pluck('nama_kecamatan'), 'peta' => Peta::with('kecamatan.kabupaten', 'kategori', 'foto')->whereKecamatanId($id)->orderBy('id', 'DESC')->take($request->input('limit'))->get()]);
        }
    }

    public function carikecamatan($id)
    {
        $kecamatan = Kecamatan::where('kabupaten_id', $id)->get();
        $options = [];

        foreach ($kecamatan as $station) {
            $options += [$station->id => $station->nama_kecamatan];
        }

        return response()->json($options);
    }

    public function kategori()
    {
        return response()->json(['error' => false, 'kategori' => Kategori::all()]);
    }

    public function petakategori($id)
    {
        return response()->json(['error' => false, 'kategori' => Kategori::find($id)->pluck('nama_kategori'), 'peta' => Peta::with('kategori', 'kecamatan.kabupaten', 'foto')->where('kategori_id', $id)->get()]);
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
    public function show($id)
    {
        //
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
