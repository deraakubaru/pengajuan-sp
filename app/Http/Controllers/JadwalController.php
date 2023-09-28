<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SemesterPendek;
use App\Models\Matakuliah;
use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index(){

        $matakuliahs = Matakuliah::all();
        $counts = DB::table('semester_pendeks')
            ->select('matakuliah_id', DB::raw('COUNT(*) as jumlah_pengajuan'))
            ->groupBy('matakuliah_id')
            ->get();
        $jadwals = Jadwal::all();

        $nimp = Auth::user()->nimp;
        $jadwalMahasiswas = Jadwal::join('semester_pendeks', 'jadwals.matakuliah_id', '=', 'semester_pendeks.matakuliah_id')
            ->where('semester_pendeks.mahasiswa_id', $nimp)
            ->get();

        // Convert the result to an associative array for easier access
        $jumlahPengajuan = $counts->pluck('jumlah_pengajuan', 'matakuliah_id');
        return view('jadwal.index', compact('matakuliahs', 'jumlahPengajuan', 'jadwalMahasiswas', 'jadwals'));
    }

    public function create(){

    }

    public function store(){
        
        $attributes = request()->validate([
            'matakuliah_id' => 'required',
            'hari' => 'required',
            'jam' => 'required',
            'ruangan' => 'required',
        ]);
    
        Jadwal::create($attributes);
    
        return back()->with('success', 'Jadwal created successfully');

    }
}
