<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Models\SemesterPendek;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('max_semester_pendeks', function ($attribute, $value, $parameters, $validator) {
            $mahasiswaId = $validator->getData()['mahasiswa_id'];
            $matakuliahId = $value;

            // Check if the Mahasiswa has already added 3 records
            $recordCount = SemesterPendek::where('mahasiswa_id', $mahasiswaId)->count();
            
            if ($recordCount >= 3) {
                return false;
            }

            // Check if there are no duplicate combinations of mahasiswa_id and matakuliah_id
            $duplicateCount = SemesterPendek::where('mahasiswa_id', $mahasiswaId)
                ->where('matakuliah_id', $matakuliahId)
                ->count();

            return $duplicateCount == 0;
        });

    }
}
