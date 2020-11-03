@inject('orderQuery', 'App\Models\Orders\OrderQuery')

<div id="sidebar" class="sidebar responsive  ace-save-state">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-shopping-cart"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger openChat">
                <i class="ace-icon fa fa-comments-o"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="{{ (request()->segment(1) == 'dashboard' ) ? 'active' : '' }}">
            <a href="{{Route('dashboard')}}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
            <b class="arrow"></b>
        </li>

        <li class="{{ (request()->segment(1) == 'inbox' ) ? 'active' : '' }}">
            <a href="{{Route('inbox.index')}}">
                <i class="menu-icon fa fa-comments-o"></i>
                <span class="menu-text"> Chat </span>
                <span class="badge badge-danger">2</span>
            </a>
            <b class="arrow"></b>
        </li>


        <li class="{{ (request()->segment(1) == 'order' ) ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-shopping-cart"></i>
                @php $orderCountRequest = count($orderQuery->getOrderRequest()); @endphp
                @if ($orderCountRequest>0)
                    <span class="badge badge-danger">{{$orderCountRequest}}</span>
                @endif
                <span class="menu-text">
                   Ordering
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>
            <ul class="submenu">
                    <li class="{{ (request()->segment(2) == 'order' ) ? 'active' : '' }}">
                        <a href="{{Route('order.order')}}">
                            <span class="menu-text"> List Ordering </span>
                        </a>
                        <b class="arrow"></b>
                    </li>
                    <li class="{{ (request()->segment(2) == 'add' ) ? 'active' : '' }}">
                        <a href="{{Route('order.order')}}">
                            <span class="menu-text"> Buat Pesanan Baru </span>
                        </a>
                        <b class="arrow"></b>
                    </li>
            </ul>
        </li>

        {{-- <li class="{{ (request()->segment(1) == 'payment' ) ? 'active' : '' }}">
            <a href="{{Route('dashboard')}}">
                <i class="menu-icon fa fa-money"></i>
                <span class="menu-text"> Pembayaran </span>
                <span class="badge badge-danger">5</span>
            </a>
            <b class="arrow"></b>
        </li> --}}

        <li class="{{ (request()->segment(1) == 'invoice' ) ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-file-text-o"></i>
                <span class="menu-text">
                   Invoice
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>
            <ul class="submenu">
                <li class="{{ (request()->segment(2) == 'tunai' && request()->segment(1) == 'invoice' ) ? 'active' : '' }}">
                    <a href="{{Route('invoice.tunai')}}"><i class="menu-icon fa fa-caret-right"></i>Invoice Tunai</a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ (request()->segment(2) == 'kredit' && request()->segment(1) == 'kredit') ? 'active' : '' }}">
                    <a href="{{Route('invoice.kredit')}}"><i class="menu-icon fa fa-caret-right"></i>Invoice Kredit</a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ (request()->segment(2) == 'cod'  && request()->segment(1) == 'cod') ? 'active' : '' }}">
                    <a href="{{Route('invoice.cod')}}"> <i class="menu-icon fa fa-caret-right"></i> Invoice COD </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>


        <li class="{{ (request()->segment(1) == 'products' ) ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text">
                   Produk Layanan
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>
            <ul class="submenu">
                <li class="{{ (request()->segment(2) == 'data' && request()->segment(1) == 'products' ) ? 'active' : '' }}">
                    <a href="{{Route('products.index')}}"><i class="menu-icon fa fa-caret-right"></i>List Produk</a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ (request()->segment(2) == 'add' && request()->segment(1) == 'products') ? 'active' : '' }}">
                    <a href="{{Route('products.add')}}"><i class="menu-icon fa fa-caret-right"></i>Add Produk</a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ (request()->segment(2) == 'category'  && request()->segment(1) == 'products') ? 'active' : '' }}">
                    <a href="{{Route('products.category')}}"> <i class="menu-icon fa fa-caret-right"></i> Kategori </a>
                    <b class="arrow"></b>
                </li>


                {{-- <li class="{{ (request()->segment(2) == 'promo'  && request()->segment(1) == 'products') ? 'active' : ''}}">
                    <a href="buttons.html"> <i class="menu-icon fa fa-caret-right"></i>Promo</a>
                    <b class="arrow"></b>
                </li> --}}
            </ul>
        </li>

        <li class="{{ (request()->segment(1) == 'customer' ) ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-users"></i>
                <span class="menu-text">
                   Customer
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>
            <ul class="submenu">
                <li class="{{ ( request()->segment(1) == 'customer' && request()->segment(2) == 'data' ) ? 'active' : '' }}">
                    <a href="{{Route('customer.index')}}"><i class="menu-icon fa fa-caret-right"></i>Data Customer</a>
                    <b class="arrow"></b>
                </li>
                <li class="{{ (request()->segment(1) == 'customer' && request()->segment(2) == 'add' ) ? 'active' : '' }}">
                    <a href="{{Route('customer.add')}}"> <i class="menu-icon fa fa-caret-right"></i>Tambah Customer </a>
                    <b class="arrow"></b>
                </li>

            </ul>
        </li>

        <li class="{{ (request()->segment(1) == 'vendor' ) ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-building"></i>
                <span class="menu-text">
                   Vendor
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>
            <ul class="submenu">
                <li class="{{ (request()->segment(1) == 'vendor' && request()->segment(2) == 'data' ) ? 'active' : '' }}">
                    <a href="{{Route('vendor.index')}}"><i class="menu-icon fa fa-caret-right"></i>Data Vendor</a>
                    <b class="arrow"></b>
                </li>
                {{-- <li class="">
                    <a href="buttons.html"> <i class="menu-icon fa fa-caret-right"></i> Order To Vendor </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="buttons.html"> <i class="menu-icon fa fa-caret-right"></i> Payment To Vendor </a>
                    <b class="arrow"></b>
                </li> --}}
            </ul>
        </li>

        {{-- <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-bar-chart"></i>
                <span class="menu-text">
                   Finance
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="">
                    <a href="typography.html"><i class="menu-icon fa fa-caret-right"></i>Produk</a>
                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="buttons.html"> <i class="menu-icon fa fa-caret-right"></i> Kategori </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li> --}}

        {{-- <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-bar-chart"></i>
                <span class="menu-text">
                   Reporting
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="">
                    <a href="typography.html"><i class="menu-icon fa fa-caret-right"></i>Produk</a>
                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="buttons.html"> <i class="menu-icon fa fa-caret-right"></i> Kategori </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li> --}}

        <li class="{{ (request()->segment(1) == 'master' ) ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-database"></i>
                <span class="menu-text"> Master</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">

                <li class="{{ (request()->segment(2) == 'bank' ) ? 'active' : '' }}">
                     <a href="{{Route('bank.index')}}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Bank Account
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="{{ (request()->segment(2) == 'point' ) ? 'active' : '' }}">
                    <a href="{{Route('point.index')}}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Sistem Point
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="{{(request()->segment(1) == 'landing') ? 'active open' : ''}}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-globe"></i>
                <span class="menu-text">
                   Landing Page
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="{{(request()->segment(2) == 'banner') ? 'active' : ''}}">
                    <a href="{{Route('banner.index')}}"><i class="menu-icon fa fa-caret-right"></i>Banner</a>
                    <b class="arrow"></b>
                </li>

                <li class="{{(request()->segment(2) == 'news') ? 'active' : ''}}">
                    <a href="{{Route('news.index')}}"><i class="menu-icon fa fa-caret-right"></i>News</a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>


        <li class="{{ (request()->segment(1) == 'setting' ) ? 'active' : '' }}">
            <a href="{{Route('dashboard')}}">
                <i class="menu-icon fa fa-cog"></i>
                <span class="menu-text"> Pengaturan </span>
            </a>
            <b class="arrow"></b>
        </li>



    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
