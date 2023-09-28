<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        </div>
        <div class="container-fluid py-4">
                <div class="row">
        <div class="col-xl-12 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <h3>Home</h3>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <div
                        style="position: relative; width: 100%; height: 0; padding-top: 56.2500%;
                            padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden;
                            border-radius: 8px; will-change: transform;">
                        <iframe loading="lazy"
                            style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;"
                            src="{{ asset('assets') }}/img/wk.jpeg"
                            allowfullscreen="allowfullscreen" allow="fullscreen">
                        </iframe>
                    </div>
                    <span class="font-weight-bold">Panduan Semester Pendek - IDE LPKIA</span> oleh Mochamad Reza O
                </div>
            </div>
        </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    </div>
</x-layout>
