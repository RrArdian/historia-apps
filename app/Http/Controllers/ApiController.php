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

            return response()->json(['error' => false, 'count' => $data->count(), 'data' => ['peta' => $data]]);
        } else {

            return response()->json(['error' => true, 'message' => 'Data peta tidak ditemukan']);            
        }
    }

    public function terdekat(Request $request)
    {
        $data = Peta::getByDistance($request->input('lat'), $request->input('long'), $request->input('jarak'));

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

    public function petakabupaten(Request $request)
    {
        if ($request->input('limit') == '') {

            return response()->json(['error' => false, 'kabupaten' => Kabupaten::with('kecamatan.peta.kategori', 'kecamatan.peta.foto')->orderBy('id', 'DESC')->get()]);
        }

        else {

            return response()->json(['error' => false, 'kabupaten' => Kabupaten::with('kecamatan.peta.kategori', 'kecamatan.peta.foto')->orderBy('id', 'DESC')->take($request->input('limit'))->get()]);
        }
    }

    public function caripetakabupaten(Request $request)
    {
        $data = Kabupaten::with('kecamatan.peta.kategori', 'kecamatan.peta.foto')->where('nama_kabupaten', 'LIKE', '%'.$request->input('q').'%')->orderBy('id', 'DESC')->get();

        if ($data->count() > 0) {

            return response()->json(['error' => false, 'count' => $data->count(), 'data' => ['kabupaten' => $data]]);
        } else {

            return response()->json(['error' => true, 'message' => 'Data peta tidak ditemukan']);            
        }
    }

    public function kecamatan()
    {
        return response()->json(['error' => false, 'kecamatan' => Kecamatan::all()]);
    }

    public function petakecamatan(Request $request)
    {
        if ($request->input('limit') == '') {

            return response()->json(['error' => false, 'kecamatan' => Kecamatan::with('kabupaten', 'peta.kategori', 'peta.foto')->orderBy('id', 'DESC')->get()]);
        }

        else {

            return response()->json(['error' => false, 'kecamatan' => Kecamatan::with('kabupaten', 'peta.kategori', 'peta.foto')->orderBy('id', 'DESC')->take($request->input('limit'))->get()]);
        }
    }    

    public function caripetakecamatan(Request $request)
    {
        $data = Kecamatan::with('kabupaten', 'peta.kategori', 'peta.foto')->where('nama_kecamatan', 'LIKE', '%'.$request->input('q').'%')->orderBy('id', 'DESC')->get();

        if ($data->count() > 0) {

            return response()->json(['error' => false, 'count' => $data->count(), 'data' => ['kecamatan' => $data]]);
        } else {

            return response()->json(['error' => true, 'message' => 'Data peta tidak ditemukan']);            
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

    public function petakategori()
    {
        return response()->json(['error' => false, 'kategori' => Kategori::with('peta.kecamatan.kabupaten', 'peta.foto')->get()]);
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
