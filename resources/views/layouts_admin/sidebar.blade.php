<div class="user-panel">
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
      
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Master Product</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ url('/product') }}"><i class="fa fa-circle-o"></i> Daftar Semua Produk</a>
                </li>
                <li><a href="{{ url('/product-category') }}"><i class="fa fa-circle-o"></i> Daftar Kategori Produk</a>
                </li>
                <li><a href=""><i class="fa fa-circle-o"></i> Daftar Produk Yang Habis</a>
                </li>
              </ul>
            </li>

            <li>
              <a href="{{ url('/courier') }}">
                <i class="fa fa-opera"></i> <span>Courier</span>
              </a>
            </li>

            <li>
              <a href="{{ url('/konfirmasi-admin') }}">
                <i class="fa fa-opera"></i> <span>Konfirmasi Pembayaran</span>
              </a>
            </li>

            <li>
              <a href="{{ url('/pesanan') }}">
                <i class="fa fa-adjust"></i> <span>List Semua Pesanan</span>
              </a>
            </li>

            <li>
              <a href="{{ url('/logout') }}">
                <i class="fa fa-adjust"></i> <span>Logout</span>
              </a>
            </li>
            
          </ul>