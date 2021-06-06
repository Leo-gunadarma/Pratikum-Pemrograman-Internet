@extends('layouts.master')

@section('content')

<ul class="thumbnails">
@foreach($products->chunk(3) as $productChunk)
<div class="row" style="padding-left: 30px;">
    @foreach($productChunk as $product)
    <li class="span3" style="padding-bottom: 30px; padding-left: 8px; padding-right: 5px;">
      <div class="thumbnail" style="width: 280px;">
        <?php
            $gambar = \DB::table('base64')->where('product_id', $product->id)->value('nama');
            $photo = base64_decode($gambar);
            $category = \DB::table('product_categories')->where('id', $product->category_id)->value('category_name');
            $foto = \DB::table('product_images')->where('id', $product->product_images_id)->value('image_name');
        ?>
        <a  href="{{ url('product/detail/'.$product->id) }}"><img style="height: 200px;" src="{{ asset('image/landscape.jpeg') }}" alt=""/></a>
        <div class="caption">
          <h5>{{ $product->product_name }}</h5>
          <p>
            {{ $category }}
          </p>
         
          <h4 style="text-align:center"><a class="btn" href="{{ url('product/detail/'.$product->id) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="{{ url('/add-to-cart/'.$product->id) }}">Add to <i class="icon-shopping-cart"></i></a>
            <div>
                <a class="btn btn-primary" href="#">Rp. {{ number_format($product->price, 0) }}</a>
            </div>
          </h4>
        </div>
      </div>
    </li>
    @endforeach
</div>
@endforeach
</ul>


@endsection

@section('scripts')
    
    <script>
        $(document).ready(function(){
            var flash = "{{ Session::has('pesan') }}";
            if(flash){
                var pesan = "{{ Session::get('pesan') }}";
                swal('success', pesan, 'success');
            }
        });
    </script>

@endsection