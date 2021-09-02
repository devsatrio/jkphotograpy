<ul class="navbar-nav">
    <li class="nav-item">
        <a href="{{url('/home')}}" class="nav-link">Home</a>
    </li>
    <li class="nav-item">
        <a href="{{url('/admin')}}" class="nav-link">Admin</a>
    </li>
    <li class="nav-item">
        <a href="{{url('/pricelist')}}" class="nav-link">Price List</a>
    </li>
    <li class="nav-item">
        <a href="{{url('/transaksi')}}" class="nav-link">Transaksi</a>
    </li>
    <li class="nav-item">
        <a href="{{url('/laporan-transaksi')}}" class="nav-link">Laporan Transaksi</a>
    </li>
    <li class="nav-item">
        <a href="{{url('/transaksi')}}" class="nav-link">Laporan Laba Rugi</a>
    </li>
    <li class="nav-item dropdown">
        <!-- <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Dropdown</a> -->
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="#" class="dropdown-item">Some action </a></li>
            <li><a href="#" class="dropdown-item">Some other action</a></li>

            <li class="dropdown-divider"></li>

            <!-- Level two dropdown-->
            <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                    <li>
                        <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                    </li>

                    <!-- Level three dropdown-->
                    <li class="dropdown-submenu">
                        <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                        <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                            <li><a href="#" class="dropdown-item">3rd level</a></li>
                            <li><a href="#" class="dropdown-item">3rd level</a></li>
                        </ul>
                    </li>
                    <!-- End Level three -->

                    <li><a href="#" class="dropdown-item">level 2</a></li>
                    <li><a href="#" class="dropdown-item">level 2</a></li>
                </ul>
            </li>
            <!-- End Level two -->
        </ul>
    </li>
</ul>