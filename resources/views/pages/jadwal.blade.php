<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="jadwal"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Jadwal"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="col-12">
                    <div class="card mt-4">
                        <div class="card-header p-3">
                            <h3 class="mb-0">Jadwal SP</h3>
                        </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
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
