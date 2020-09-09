<?php $code = Auth::user()->code; ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Vocher</title>
  <!-- Favicon -->
  <link rel="icon" href="img/brand/tel.png" style="width: 10%" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="css/argon.css?v=1.2.0" type="text/css">
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="img/brand/tel.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="/">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            @if ($code != 1 && $code != 2)
            <li class="nav-item">
              <a class="nav-link" href="/report">
                <i class="ni ni-collection text-primary"></i>
                <span class="nav-link-text">Laporan</span>
              </a>
            </li>
            @endif
            @if ($code == 1 || $code == 2)                
            <li class="nav-item">
              <a class="nav-link" href="/stok">
                <i class="ni ni-basket text-primary"></i>
                <span class="nav-link-text">Input Stok</span>
              </a>
            </li>
            @endif
            @if ($code == 1)
            <li class="nav-item">
              <a class="nav-link" href="/reseller">
                <i class="ni ni-planet text-orange"></i>
                <span class="nav-link-text">Reseller</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/product">
                <i class="ni ni-box-2 text-primary"></i>
                <span class="nav-link-text">Product</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/user">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Add User</span>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </nav>