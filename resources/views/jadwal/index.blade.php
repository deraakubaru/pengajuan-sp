<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="jadwal"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Jadwal"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="col-12">
                @if(auth()->user()->role_id === 2)
                <div class="card mt-4">
                    <div class="card-header p-3">
                        <h3 class="mb-0">Pengajuan SP</h3>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th scope="row">No.</th>
                                        <th scope="row">Matakuliah</th>
                                        <th scope="row">Jumlah Pengajuan</th>
                                        <th scope="row">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($matakuliahs->sortByDesc(function($matakuliah) use ($jumlahPengajuan) {
                                        return $jumlahPengajuan[$matakuliah->id] ?? 0;
                                    }) as $matakuliah)
                                    <tr>
                                        <td class="ps-5">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td>{{ $matakuliah->name }}</td>
                                        <td class="ps-5">
                                            {{ $jumlahPengajuan[$matakuliah->id] ?? 0 }}
                                        </td>
                                        <td>
                                            @php
                                                $count = $jumlahPengajuan[$matakuliah->id] ?? 0;
                                            @endphp
                                            <button type="button" class="btn btn-primary ms-3 mb-3" data-bs-toggle="modal" data-bs-target="#insertModal{{ $matakuliah->id }}" @if($count < 8) disabled @endif>
                                                Buat Jadwal SP
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="insertModal{{ $matakuliah->id }}" tabindex="-1" aria-labelledby="modalPengajuan" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Buat Jadwal SP {{ $matakuliah->name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('add-jadwal') }}">
                                                                @csrf
                                                                <!-- Insert data fields here -->
                                                                <div class="form-group">
                                                                    <label for="matakuliah">Matakuliah</label>
                                                                    <input type="text" class="form-control px-2" id="matakuliah" name="matakuliah" value="{{ $matakuliah->name }}" readonly>
                                                                </div>
                                                                <input type="hidden" name="matakuliah_id" value="{{ $matakuliah->id }}">
                                                                <div class="form-group">
                                                                    <label for="hari">Tanggal</label>
                                                                    <input type="text" class="form-control border px-2 " id="hari" name="hari">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jam">Jam</label>
                                                                    <input type="text" class="form-control border px-2" id="jam" name="jam" placeholder="00:00">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="ruangan">Ruangan</label>
                                                                    <input type="text" class="form-control border px-2" id="ruangan" name="ruangan">
                                                                </div>
                                                                <!-- End of data fields -->
                                                                <button type="submit" class="btn btn-primary mt-3">Tambah</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                @endif
                <div class="card mt-4">
                    <div class="card-header p-3">
                        <h3 class="mb-0">Jadwal SP</h3>
                    </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                @if(auth()->user()->role_id === 2)
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="row">No.</th>
                                            <th scope="row">Matakuliah</th>
                                            <th scope="row">Tanggal</th>
                                            <th scope="row">Ruangan</th>
                                            <th scope="row">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jadwals as $jadwal)
                                        <tr>
                                            <td class="ps-4">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            
                                            <td>
                                                {{ $jadwal->matakuliah->name }}
                                            </td>
                                            <td>
                                                {{ $jadwal->jam }}, {{ $jadwal->tanggal }}
                                            </td>
                                            <td>
                                                {{ $jadwal->ruangan }}
                                            </td>
                                            <td class="align-middle">
                                                BUTTON
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                                </table>
                                @elseif(auth()->user()->role_id === 4)
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="row">No.</th>
                                            <th scope="row">Matakuliah</th>
                                            <th scope="row">Tanggal</th>
                                            <th scope="row">Ruangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jadwalMahasiswas as $jadwalmahasiswa)
                                        <tr>
                                            <td class="ps-4">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            
                                            <td>
                                                {{ $jadwalmahasiswa->matakuliah->name }}
                                            </td>
                                            <td>
                                                {{ $jadwalmahasiswa->jam }}, {{ $jadwalmahasiswa->hari }}
                                            </td>
                                            <td>
                                                {{ $jadwalmahasiswa->ruangan }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <x-footers.auth></x-footers.auth>
    </div>
</main>
<x-imagejadwal></x-imagejadwal>

</x-layout>
