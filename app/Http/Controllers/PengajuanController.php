<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Matakuliah;
use App\Models\SemesterPendek;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index(){
        $dosenWalis = User::where('role_id', 3)->get();
        $matakuliahs = Matakuliah::all();
        $userNimp = Auth::user()->nimp;
        $semesterpendeks = SemesterPendek::where('mahasiswa_id', $userNimp)->get();
        $dosenConfirms = SemesterPendek::where('level', 0)->where('dosen_wali_id', $userNimp)->get();
        $baaConfirms = SemesterPendek::where('level', 1)->get();
        $allsemesterpendeks = SemesterPendek::all();

        return view('pendaftaran.index', compact('dosenWalis', 'allsemesterpendeks', 'matakuliahs', 'semesterpendeks', 'dosenConfirms', 'baaConfirms'));
    }

    public function store(){

        $validator = Validator::make(request()->all(), [
            'dosen_wali_id' => 'required|max:255',
            'mahasiswa_id' => 'required|max:255',
            'matakuliah_id' => [
                'required',
                'max:20',
                'max_semester_pendeks', // Use the custom validation rule
            ],
            'level' => 'required',
            'keterangan' => 'required',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
    
            // Get the selected matakuliah name
            $matakuliahName = Matakuliah::find(request('matakuliah_id'))->name ?? '';
    
            // Replace :matakuliah_name with the actual matakuliah name in the specific error message
            $errorMessage = 'Pengajuan pada matakuliah ' . $matakuliahName . ' sudah di ajukan sebelumnya!';
    
            // Check for duplicate matakuliah_id
            if ($this->hasDuplicateMatakuliah()) {
                $errors->add('matakuliah_id', $errorMessage);
            }
    
            return redirect()->back()->withErrors($errors)->withInput();
        }
    
        $attributes = $validator->validated();
    
        $sp = SemesterPendek::create($attributes);
    
        return back();
        
    } 

    private function hasDuplicateMatakuliah() {
        $mahasiswaId = request('mahasiswa_id');
        $matakuliahId = request('matakuliah_id');

        // Check if there are duplicate records with the same mahasiswa_id and matakuliah_id
        $duplicateCount = SemesterPendek::where('mahasiswa_id', $mahasiswaId)
            ->where('matakuliah_id', $matakuliahId)
            ->count();

        return $duplicateCount > 0;
    }

    public function approve(Request $request, $id)
    {
        // Find the SemesterPendek record by its ID
        $semesterPendek = SemesterPendek::findOrFail($id);

        // Check if the current level is 0 before updating
        if ($semesterPendek->level === 0) {
            // Update the level to 1
            $semesterPendek->update(['level' => 1]);
            $semesterPendek->update(['keterangan' => 'Menunggu Persetujuan BAA']);

            // You can add additional logic here if needed

            return redirect()->back()->with('success', 'Semester Pendek approved successfully.');
        } elseif ($semesterPendek->level === 1) {
            $semesterPendek->update(['level' => 2]);
            
            $semesterPendek->update(['keterangan' => 'Menunggu keputusan terbentuknya SP']);

            return redirect()->back()->with('success', 'Semester Pendek approved successfully.');
        } else {
            return redirect()->back()->with('error', 'Kesalahan !');
        }
    }

    public function destroy($id)
{
    // Find the record by ID
    $semesterpendek = SemesterPendek::findOrFail($id);

    // Perform any additional checks or validations here if needed

    // Delete the record
    $semesterpendek->delete();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Record deleted successfully');
}
}
