<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-4">
                        <div class="card-header p-3">
                            <h3 class="mb-0">All User</h3>
                        </div>
                        <div class=" me-3 my-3 text-end">
                        <button type="button" class="mb-3 btn button btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                User
                        </button>
                        </div>
                        <div class="card-body pt-0 px-5 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="row">No.</th>
                                            <th scope="row">Username</th>
                                            <th scope="row">Nim/Nip</th>
                                            <th scope="row">Email</th>
                                            <th scope="row">Role</th>
                                            <th scope="row">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td class="ps-4">
                                            {{ $loop->index + 1 }}
                                        </td>
                                           
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->nimp }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $user->role_id }}
                                        </td>
                                        <td class="align-middle">
                                            <a rel="tooltip" class="btn btn-success btn-link"
                                                href="" data-original-title=""
                                                title="">
                                                <i class="material-icons">edit</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-link"
                                                data-original-title="" title="">
                                                <i class="material-icons">close</i>
                                                <div class="ripple-container"></div>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
</main>

</x-layout>
