<div class="well well-small" style="width: 310px;"><a id="myCart" href="shopping-cart"><img src="{{asset('bootshop/themes/images/ico-cart.png')}}" alt="cart">{{ count(Cart::content()) }} Items dalam keranjang  <span class="badge badge-warning pull-right">Rp. {{ Cart::total() }}</span></a></div>
<ul id="sideManu" class="nav nav-tabs nav-stacked" style="width: 330px;">
	<?php
		$categories = \DB::table('product_categories')->orderBy('category_name', 'asc')->get();
	?>
@foreach($categories as $category)
	<?php
		$jumlah = \DB::table('products')->where('category_id', $category->id)->where('status_id', 1)->get();
	?>
	<li><a href="{{ url('/product/category/'.$category->id) }}">{{$category->category_name}} [{{count($jumlah)}}]</a></li>
@endforeach
</ul>
<br/>
<?php $products = \DB::table('products')->inRandomOrder()->limit(2)->get(); ?>
@foreach($products as $product)
  <div class="thumbnail" style="width: 320px;">
  	<?php
  		$gambar = \DB::table('base64')->where('product_id', $product->id)->value('nama');
  		$photo = base64_decode($gambar);
  	?>
	<img style="height: 200px;" src="{{ asset('image/bridge bg.jpg') }}" alt="PhoneShop Best New Phone"/>
	<div class="caption">
	  <h5>{{ $product->product_name }}</h5>
		<h4 style="text-align:center"><a class="btn" href="{{ url('product/detail/'.$product->id) }}"> <i class="icon-zoom-in"></i></a> <a class="btn" href="{{ url('add-to-cart/'.$product->id) }}">Add to <i class="icon-shopping-cart"></i></a>
			<div>
				<a class="btn btn-primary" href="#">Rp. {{ number_format($product->price, 0) }}</a>
			</div>
		</h4>
	</div>
  </div>
 @endforeach