@extends('template.user-layout')
@section('konten')
     <!-- CONTENT =============================-->
    <section class="item content">
        <div class="container toparea">
            <div class="underlined-title">
                <div class="wow-hr type_short">
                    <span class="wow-hr-h">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="card-body">
                                @foreach ($product->RelasiProductImage as $gambar)
                                @if ($loop->iteration == 1)
                                <img src="{{asset('img/'.$gambar->image_name)}}" alt="" width="200" height="200"></span>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <p class="text-primary font-weight-bold h2 ">{{$product->product_name}}</p>
                            <p class="text-success h4">Rp.{{number_format($product->price)}}</p>
                            <hr style="border-top: thin solid #000000;width:50%; text-align:left;margin-left:0">

                            <p>Deskripsi : {{$product->description}}</p>
                            <p>Berat : {{$product->weight}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

  
@endsection

 