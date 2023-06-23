<div class="app-menu">

    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="index.html" class="logo-light">
            <img src="assets/images/logo-light.png" alt="logo" class="logo-lg">
            <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm">
        </a>

        <!-- Brand Logo Dark -->
        <a href="{{route('home')}}" class="logo-dark">
            <img src="assets/images/logo-dark.png" alt="logo" class="logo-lg">
            <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm">
        </a>
    </div>

    <!-- menu-left -->
    <div class="scrollbar">

        <!--- Menu -->
        <ul class="menu">

            <li class="menu-title">Menu</li>
            <li class="menu-item">
                <a href="{{route('home')}}" class="menu-link">
                    <span class="menu-icon"><i data-feather="home"></i></span>
                    <span class="menu-text"> Home </span>
                </a>
            </li>


            {{-- Data --}}
            <li class="menu-title">Data</li>

            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i data-feather="check-circle"></i></span>
                    <span class="menu-text"> Kategori </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i data-feather="check-circle"></i></span>
                    <span class="menu-text"> Prodak </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i data-feather="check-circle"></i></span>
                    <span class="menu-text"> Pertanyaan </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i data-feather="check-circle"></i></span>
                    <span class="menu-text"> User </span>
                </a>
            </li>

            {{-- Referensi --}}
            <li class="menu-title">Referensi</li>

            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i data-feather="clipboard"></i></span>
                    <span class="menu-text"> Angka Kredit </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i data-feather="user"></i></span>
                    <span class="menu-text"> Akun </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i class="icon-question"></i></span>
                    <span class="menu-text"> FAQ </span>
                </a>
            </li>

        </ul>
        <!--- End Menu -->
        <div class="clearfix"></div>
    </div>
</div>