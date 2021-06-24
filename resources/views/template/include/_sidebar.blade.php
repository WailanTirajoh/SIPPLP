<style>
    .dropend:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }

</style>
<div class="bg-white border-right border-top border-bottom border-right shadow" id="sidebar-wrapper">
    <div class="d-flex flex-column"
        style="width: 4.5rem; border-top-right-radius:0.5rem; border-bottom-right-radius:0.5rem">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li>
                <a href="{{ route('dashboard.index') }}" class="nav-link py-3 border-bottom myBtn
                    {{ in_array(Route::currentRouteName(), ['dashboard.index', 'chart.dialyGuest']) ? 'active' : '' }}
                    " data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            {{-- @if (auth()->user()->role == 'Super' || auth()->user()->role == 'Admin')
                <li>
                    <a href="{{ route('transaction.index') }}" class="nav-link py-3 border-bottom border-right myBtn
                        {{ in_array(Route::currentRouteName(), ['payment.index', 'transaction.index', 'transaction.reservation.createIdentity', 'transaction.reservation.pickFromCustomer', 'transaction.reservation.usersearch', 'transaction.reservation.storeCustomer', 'transaction.reservation.viewCountPerson', 'transaction.reservation.chooseRoom', 'transaction.reservation.confirmation', 'transaction.reservation.payDownPayment']) ? 'active' : '' }}
                        " data-bs-toggle="tooltip" data-bs-placement="right" title="Transactions">
                        <i class="fas fa-cash-register"></i>
                    </a>
                </li>
                <li>
                    <div class="dropend">
                        <a class="nav-link py-3 border-bottom border-right myBtn
                    {{ in_array(Route::currentRouteName(), ['room.index', 'room.show', 'room.create', 'room.edit', 'type.index', 'type.create', 'type.edit', 'roomstatus.index', 'roomstatus.create', 'roomstatus.edit']) ? 'active' : '' }}
                        " data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-house-user"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('room.index') }}">Room</a></li>
                            <li><a class="dropdown-item" href="{{ route('type.index') }}">Type</a></li>
                            <li><a class="dropdown-item" href="{{ route('roomstatus.index') }}">Status</a></li>
                            <li><a class="dropdown-item" href="{{ route('facility.index') }}">Facility</a></li>
                        </ul>
                    </div>
                </li> --}}
            @if (auth()->user()->role == 'Super')
                <li>
                    <div class="dropend">
                        <a class="nav-link py-3 border-bottom border-right myBtn
                    {{ in_array(Route::currentRouteName(), ['sekolah.index', 'sekolah.create', 'sekolah.edit', 'cabor.index', 'cabor.create', 'cabor.edit', 'prestasi.index']) ? 'active' : '' }}
                " data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('sekolah.index') }}">Sekolah</a></li>
                            <li><a class="dropdown-item" href="{{ route('cabor.index') }}">Cabang Olahraga</a></li>
                            <li><a class="dropdown-item" href="{{ route('prestasi.index') }}">Prestasi</a></li>
                            {{-- <li><a class="dropdown-item" href="{{ route('sertifikasi.index') }}">Sertifikasi</a></li> --}}
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropend">
                        <a class="nav-link py-3 border-bottom border-right myBtn
                        {{ in_array(Route::currentRouteName(), ['user.index', 'user.create', 'user.edit', 'atlet.index', 'atlet.create', 'atlet.edit', 'pelatih.index', 'pelatih.show', 'pelatih.edit']) ? 'active' : '' }}
                    " data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-users"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('atlet.index') }}">Atlet</a></li>
                            <li><a class="dropdown-item" href="{{ route('pelatih.index') }}">Pelatih</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.index') }}">Super</a></li>
                        </ul>
                    </div>
                </li>
            @endif
            {{-- @endif --}}
        </ul>
    </div>
</div>
