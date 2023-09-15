<div class="app-menu">

    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="{{ route('home') }}" class="logo-light">
            <img src="{{ asset('/') }}assets/images/logoMall.png" alt="logo" width="100">
            {{-- <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm"> --}}
        </a>

        <!-- Brand Logo Dark -->
        <a href="{{ route('home') }}" class="logo-dark">
            <img src="{{ asset('/') }}assets/images/logoMall.png" alt="logo" width="100">
            {{-- <img src="assets/images/logo-sm.png" alt="small logo" class="logo-sm"> --}}
        </a>
    </div>

    <!-- menu-left -->
    <div class="scrollbar">

        <!--- Menu -->
        <ul class="menu">

            <li class="menu-title">Menu</li>
            <li class="menu-item">
                <a href="{{ route('home') }}" class="menu-link">
                    <span class="menu-icon"><i data-feather="home"></i></span>
                    <span class="menu-text"> Home </span>
                </a>
            </li>


            {{-- Data --}}
            <li class="menu-title">Data</li>

            <li class="menu-item">
                <a href="{{ route('profileCompany.index') }}" class="menu-link">
                    <span class="menu-icon"><i data-feather="airplay"></i></span>
                    <span class="menu-text"> Profil Perusahaan </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('categoryProduct.index') }}" class="menu-link">
                    <span class="menu-icon"><i data-feather="shopping-bag"></i></span>
                    <span class="menu-text"> Kategori </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('Product.index') }}" class="menu-link">
                    <span class="menu-icon"><i data-feather="shopping-cart"></i></span>
                    <span class="menu-text"> Produk </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('carousel.index') }}" class="menu-link">
                    <span class="menu-icon"><i data-feather="image"></i></span>
                    <span class="menu-text"> Gambar Bergulir </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('transaction.index') }}" class="menu-link">
                    <span class="menu-icon"><i data-feather="dollar-sign"></i></span>
                    <span class="menu-text"> Transaksi </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="#menuBaseui" data-bs-toggle="collapse" class="menu-link">
                    <span class="menu-icon"><i data-feather="info"></i></span>
                    <span class="menu-text"> Survey </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse collapse-md" id="menuBaseui">
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="{{ route('question.index') }}" class="menu-link">
                                <span class="menu-text">Pertanyaan</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('answer.index') }}" class="menu-link">
                                <span class="menu-text">Jawaban</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('result.index') }}" class="menu-link">
                                <span class="menu-text">Hasil</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item">
                <a href="{{ route('user.index') }}" class="menu-link">
                    <span class="menu-icon"><i data-feather="user"></i></span>
                    <span class="menu-text"> User </span>
                </a>
            </li>

        </ul>
        <!--- End Menu -->
        <div class="clearfix"></div>
    </div>
</div>
