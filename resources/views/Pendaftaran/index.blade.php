<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="pendaftaran"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Pendaftaran"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="col-12">
                    <div class="card mt-4">
                        <div class="card-header p-3">
                            <h3 class="mb-0">Pengajuan SP</h3>
                        </div>
                        <div class="card-body px-0 pb-2">
                            @if(auth()->user()->role_id === 4)
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary ms-3 mb-3" data-bs-toggle="modal" data-bs-target="#modalPengajuan">
                                Ajukan Semester Pendek
                                
                            </button>
                            <div class="text-center">
                                    <h5 class="text-danger">Kuota pengajuan 3 matakuliah</h5>
                                
                                @error('matakuliah_id')
                                    <h5 class="text-danger">{{ $message }}</h5>
                                @enderror
                            </div>
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="row">No.</th>
                                            <th scope="row">Matakuliah</th>
                                            <th scope="row">Dosen Wali</th>
                                            <th scope="row">Keterangan</th>
                                            <th scope="row">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($semesterpendeks as $semesterpendek)
                                        <tr>
                                            <td class="ps-4">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            
                                            <td>
                                                {{ $semesterpendek->matakuliah->name }}
                                            </td>
                                            <td>
                                                {{ $semesterpendek->dosen->name }}
                                            </td>
                                            <td>
                                                {{ $semesterpendek->keterangan }}
                                            </td>
                                            <td class="align-middle">
                                                @if($semesterpendek->level > 0)
                                                    <!-- Button is disabled if $semesterpendek->level > 0 -->
                                                    <button type="button" class="btn btn-secondary text-light btn-link" disabled>
                                                        Batalkan
                                                    </button>
                                                @else
                                                    <!-- Button is enabled if $semesterpendek->level <= 0 -->
                                                    <form method="POST" action="{{ route('delete-sp', $semesterpendek->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-link">
                                                            Batalkan
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                                </table>
                            </div>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="modalPengajuan" tabindex="-1" aria-labelledby="modalPengajuan" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan Semester Pendek</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('ajukan') }}">
                                                @csrf
                                                <div class="input-group input-group-outline mt-3">
                                                    {{-- <label for="dosen_wali" class="form-label mb-3">Dosen Wali</label> --}}
                                                    <select class="form-select p-2" name="dosen_wali_id">
                                                        <option value="">Pilih Dosen Wali</option>
                                                        @foreach($dosenWalis as $dosenWali)
                                                            <option value="{{ $dosenWali->nimp }}">{{ $dosenWali->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" class="form-control" name="level" value ="0">
                                                    <input type="hidden" class="form-control" name="keterangan" value ="Pengajuan belum disetujui Dosen Wali">
                                                    <input type="hidden" class="form-control" name="mahasiswa_id" value ="{{ auth()->user()->nimp}}">
                                                </div>
                                                @error('dosen_wali')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                                <div class="input-group input-group-outline mt-3">
                                                    {{-- <label class="form-label">Matakuliah</label> --}}
                                                    <select class="form-select p-2" name="matakuliah_id">
                                                        <option value="">Pilih Matakuliah</option>
                                                        @foreach($matakuliahs as $matakuliah)
                                                            <option value="{{ $matakuliah->id }}">{{ $matakuliah->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('matakuliah')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                                
                                                <button type="submit" class="btn btn-primary mt-3">Ajukan</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif(auth()->user()->role_id === 3)
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="row">No.</th>
                                            <th scope="row">NRP</th>
                                            <th scope="row">Nama Mahasiswa</th>
                                            <th scope="row">Matakuliah</th>
                                            <th scope="row">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dosenConfirms as $dosenConfirm)
                                        <tr>
                                            <td class="ps-4">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            
                                            <td>
                                                {{ $dosenConfirm->mahasiswa->nimp }}
                                            </td>
                                            <td>
                                                {{ $dosenConfirm->mahasiswa->name }}
                                            </td>
                                            <td>
                                                {{ $dosenConfirm->matakuliah->name }}
                                            </td>
                                            <td class="align-middle">
                                                <form method="POST" action="{{ route('approve', $dosenConfirm->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-link">
                                                        Konfirmasi
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                                </table>
                            </div>
                            @elseif(auth()->user()->role_id === 2)
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="row">No.</th>
                                            <th scope="row">NRP</th>
                                            <th scope="row">Nama Mahasiswa</th>
                                            <th scope="row">Matakuliah</th>
                                            <th scope="row">Keterangan</th>
                                            <th scope="row">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($baaConfirms as $baaConfirm)
                                        <tr>
                                            <td class="ps-4">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            
                                            <td>
                                                {{ $baaConfirm->mahasiswa->nimp }}
                                            </td>
                                            <td>
                                                {{ $baaConfirm->mahasiswa->name }}
                                            </td>
                                            <td>
                                                {{ $baaConfirm->matakuliah->name }}
                                            </td>
                                            <td>
                                                {{ $baaConfirm->keterangan }}

                                            </td>
                                            <td class="align-middle">
                                                <form method="POST" action="{{ route('approve', $baaConfirm->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-link">
                                                        Konfirmasi
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                                </table>
                            </div>

                            @endif
                        </div>
                    </div>
                    @if(auth()->user()->role_id === 2)
                    <div class="card mt-4">
                        <div class="card-header p-3">
                            <h3 class="mb-0">Daftar Pengajuan SP</h3>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="row">No.</th>
                                            <th scope="row">NRP</th>
                                            <th scope="row">Mahasiswa</th>
                                            <th scope="row">Matakuliah</th>
                                            <th scope="row">Dosen Wali</th>
                                            <th scope="row">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allsemesterpendeks as $allsemesterpendek)
                                        <tr>
                                            <td class="ps-4">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            
                                            <td>
                                                {{ $allsemesterpendek->mahasiswa_id }}
                                            </td>
                                            <td>
                                                {{ $allsemesterpendek->mahasiswa->name }}
                                            </td>
                                            <td>
                                                {{ $allsemesterpendek->matakuliah->name }}
                                            </td>
                                            <td>
                                                {{ $allsemesterpendek->dosen->name }}
                                            </td>
                                            <td>
                                                {{ $allsemesterpendek->keterangan }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>
        </main>
        <x-forms></x-forms>

</x-layout>
