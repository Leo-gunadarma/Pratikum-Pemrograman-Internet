@extends('template.user-layout')
@section('css')
        <style>
        .ribbon {
            width: 120px;
            height: 120px;
            overflow: hidden;
            position: absolute;
        }

        .ribbon::before,
        .ribbon::after {
            position: absolute;
            z-index: -1;
            content: '';
            display: block;
            border: 5px solid #2980b9;
        }

        .ribbon span {
            position: absolute;
            display: block;
            width: 225px;
            padding: 15px 0 15px 20px;
            background-color: #3498db;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
            color: #fff;
            font: 700 18px/1 'Lato', sans-serif;
            text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
            text-transform: uppercase;
            text-align: center;
        }

        /* top left*/
        .ribbon-top-left {
            top: -10px;
            left: 5px;
        }

        .ribbon-top-left::before,
        .ribbon-top-left::after {
            border-top-color: transparent;
            border-left-color: transparent;
        }

        .ribbon-top-left::before {
            top: 0;
            right: 0;
        }

        .ribbon-top-left::after {
            bottom: 0;
            left: 0;
        }

        .ribbon-top-left span {
            right: -25px;
            top: 30px;
            transform: rotate(-45deg);
        }

    </style>
@endsection
@section('konten')
        <!-- STEPS =============================-->
    <div class="item content">
        <div class="container toparea">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="col editContent">
                        <span class="numberstep"><i class="fa fa-shopping-cart"></i></span>
                        <h3 class="numbertext">Produk Terbaru</h3>
                        <p>
                            Kami menawarkan produk-produk terbaik, berkualitas,terbaru dan langsung dari pabrik yang ada
                            hanya untuk anda.
                        </p>
                    </div>
                    <!-- /.col-md-4 -->
                </div>
                <!-- /.col-md-4 col -->
                <div class="col-md-4 editContent">
                    <div class="col">
                        <span class="numberstep"><i class="fa fa-gift"></i></span>
                        <h3 class="numbertext">Diskon</h3>
                        <p>
                            Kami sering mengadakan diskon besar-besaran, jadi tunggu apa lagi?
                        </p>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.col-md-4 col -->
                <div class="col-md-4 editContent">
                    <div class="col">
                        <span class="numberstep"><i class="fa fa-star"></i></span>
                        <h3 class="numbertext">Feed Back Pengguna</h3>
                        <p>
                            Kami selalu mengutamakan pelanggan. Seperti pepataah mengatakan pembeli adalah raja
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- LATEST ITEMS =============================-->
    <section class="item content">
        <div class="container">
            <div class="underlined-title">
                <div class="editContent">
                    <h1 class="text-center latestitems">PRODUK TERBARU</h1>
                </div>
                <div class="wow-hr type_short">
                    <span class="wow-hr-h">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card">

                        <div class="productbox">
                            <div class="fadeshop">
                                <div class="captionshop text-center" style="display: none;">
                                    <h3>{{$product->product_name}}</h3>
                                    <p class="">
                                        {{Str::limit($product->description, 80, $end='...')}}
                                    </p>
                                    <p>
                                        @if (Auth::check())
                                        <a href="/user/transaksi-langsung/{{$product->id}}" class="learn-more detailslearn"><i class="fa fa-shopping-cart"></i>
                                            Purchase</a>
                                        @else
                                        <a href="/login" class="learn-more detailslearn"><i
                                                class="fa fa-shopping-cart"></i>
                                            Purchase</a>
                                        @endif
                                        <a href="/user/detail/{{$product->id}}" class="learn-more detailslearn"><i
                                                class="fa fa-link"></i>
                                            Detail</a>
                                    </p>
                                </div>
                                @foreach ($product->RelasiProductImage as $gambar)
                                {{-- Melakukan Kondisi dimana hanya menampilkan 1 gambar saja dari product --}}
                                @if ($loop->iteration == 1)
                                <center><span class="maxproduct"><img src="../img/{{$gambar->image_name}}" alt=""
                                            width="200" height="200"></span></center>
                                @endif

                                @endforeach
                            </div>
                            <div class="product-details">
                                <h1>{{$product->product_name}}</h1>
                                </a>
                                <span class="price">
                                    <span class="edd_price">Rp.{{number_format($product->price)}}</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="ribbon ribbon-top-left">
                        <span>NEW</span>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
        </div>
    </section>


    <!-- BUTTON =============================-->
    <div class="item content">
        <div class="container text-center">
            <a href="/user/show" class="homebrowseitems">Liat Semua Produk
                <div class="homebrowseitemsicon">
                    <i class="fa fa-star fa-spin"></i>
                </div>
            </a>
        </div>
    </div>
    <br />
@endsection


