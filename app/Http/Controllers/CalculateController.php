<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\DapilModel;
use App\Models\KecamatanModel;
use App\Models\DesaModel;
use App\Models\RtrwModel;
use App\Models\TpsModel;
use App\Models\User;
use App\Models\DetailDapilModel;
use App\Models\CalculateModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon; 

class CalculateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = 1;
        
        $query = DB::table('dapil as a')
        ->join('kecamatan as b', 'a.id', '=', 'b.id_dapil')
        ->join('desa as c', 'c.id_kecamatan', '=', 'b.id')
        ->join('rtrw as d', 'd.id_desa', '=', 'c.id')
        ->join('tps as e', 'e.id_rtrw', '=', 'd.id')
        ->join('detail_dapil as f', 'f.id_tps', '=', 'e.id_tps')
        ->join('calculate as g', 'g.id_dtl', '=', 'f.id_dtl')
        ->join('caleg as h', 'h.id_caleg', '=', 'g.id_caleg') 
        ->join('partai as i', 'i.id_partai', '=', 'h.id_partai')
        // ->join('detail_dapil as h_detail', 'h_detail.id_kecamatan', '=', 'b.id')
        ->selectRaw('i.name_partai,h.name_caleg,SUM(g.totalsuara_caleg) as total_suara,e.name_tps,c.nama_desa,b.nama_kecamatan')
        ->groupBy('i.name_partai','h.name_caleg','e.name_tps','c.nama_desa','b.nama_kecamatan');
        $results = $query->get();
        return view('calculate.index', compact('results','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
