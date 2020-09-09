@include('head')
<!-- Main content -->
<div class="main-content" id="panel">
  <!-- Topnav -->
  <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center  ml-md-auto ">
          <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </li>
          <li class="nav-item d-sm-none">
            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
              <i class="ni ni-zoom-split-in"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="img/theme/avatar.png">
                </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="#!" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="/logout" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Header -->
  <!-- Header -->
  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Stok</a></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-12">
        <div class="card bg-default">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                @if (session('status'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong></strong> {{session('status')}}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <h6 class="text-light text-uppercase ls-1 mb-1">-----------</h6>
                <h5 class="h3 text-white mb-0">Masukkan Stok</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="/postStok" method="post">
                @csrf()
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label text-light">Produk</label>
                    <select name="kodeprod" class="form-control">
                        <option value="">-- Pilih Produk --</option>
                        @foreach ($prod as $ket)
                        <option value="{{$ket->kodeprod}}">{{$ket->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label text-light">Reseller</label>
                    <select name="koderesel" class="form-control">
                        <option value="">-- Pilih Reseller --</option>
                        @foreach ($resel as $ket)
                        <option value="{{$ket->koderesel}}">{{$ket->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label text-light">Jumlah Produk</label>
                    <input class="form-control" name="jumlah" type="number" id="example-text-input">
                </div>
                <button class="btn btn-icon btn-primary">
                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                    <span class="btn-inner--text">Tambah</span>
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">List Stok</h3>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>No.</th>
                  <th>Produk</th>
                  <th>Reseller</th>
                  <th>Jumlah Stok</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1 ?>
                @foreach ($data as $key)
                <tr>
                  <th >
                    {{$no++}}
                  </th>
                  <td>
                    {{$key->kodeprod}}
                  </td>
                  <td>
                    {{$key->koderesel}}
                  </td>
                  <td>
                    {{$key->jumlah}}
                  </td>
                  <td>
                    {{$key->tgl_add}}
                  </td>
                  <td>
                  <a href="/reselDelet/{{$key->id}}"><i class="ni ni-fat-remove text-danger mr-3" style="">Hapus</i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <footer class="footer pt-0">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6">
          <div class="copyright text-center  text-lg-left  text-muted">
            &copy; 2020 <a href="#" class="font-weight-bold ml-1" target="_blank">IBANK X TELKOM</a>
          </div>
        </div>
      </div>
    </footer>
  </div> 
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="vendor/js-cookie/js.cookie.js"></script>
<script src="vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="vendor/chart.js/dist/Chart.min.js"></script>
<script src="vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="js/argon.js?v=1.2.0"></script>
</body>

</html>
