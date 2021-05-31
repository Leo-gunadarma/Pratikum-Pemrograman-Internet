<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layouts.header')
  </head>
<body>
<div id="header">
<div class="container" style="width: 1300px;">
<div id="welcomeLine" class="row">
	<div class="span6">Selamat Datang<strong></strong></div>
	<div class="span6" style="padding-left: 130px;">
	<div class="pull-right" >
		<a href="{{ url('shopping-cart') }}"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ {{ count(Cart::content()) }} ] Items di dalam keranjang </span> </a>
	</div>
	</div>
</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
@include('layouts.navbar')
</div>
</div>
</div>
<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container" style="width: 1300px;">
	<div class="row" >
<!-- Sidebar ================================================== -->
	<div id="sidebar" class="span3">
		@include('layouts.sidebar')
	</div>
<!-- Sidebar end=============================================== -->
		<?php
			$products = \DB::table('products')->inRandomOrder()->limit(12)->get();
			$productsActive = \DB::table('products')->where('status_id', 1)->inRandomOrder()->limit(4)->get();
		?>
		<div class="span9" style="width: 920px; padding-left: 64px;">		
			<div class="well well-small"style="width: 916px;">
			<h4>Product Terbaru <small class="pull-right"></small></h4>
			<div class="row-fluid">
			<div id="featured" class="carousel slide">
			<div class="carousel-inner">
			  <div class="item active">
			  <ul class="thumbnails">
			  	@foreach($productsActive as $product)
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
				  <?php
			  		$gambar = \DB::table('base64')->where('product_id', $product->id)->value('nama');
			  		$photo = base64_decode($gambar);
			  	?>
					<a href="{{ url('product/detail/'.$product->id) }}"><img src="{{ $photo }}" alt=""></a>
					<div class="caption">
					  <h5>{{ $product->product_name }}</h5>
					  <h4><a class="btn" href="{{ url('product/detail/'.$product->id) }}">VIEW</a> <span class="pull-right">Rp. {{ number_format($product->price, 0) }}</span></h4>
					</div>
				  </div>
				</li>
				@endforeach
			  </ul>
			  </div>

			  @foreach($products->chunk(4) as $productsChunk)
			  <div class="item">
			  <ul class="thumbnails">
			  	@foreach($productsChunk as $product)
				<li class="span3">
				  <div class="thumbnail">
				  <i class="tag"></i>
				  <?php
			  		$gambar = \DB::table('base64')->where('product_id', $product->id)->value('nama');
			  		$photo = base64_decode($gambar);
			  	?>
					<a href="{{ url('product/detail/'.$product->id) }}"><img src="{{ $photo }}" alt=""></a>
					<div class="caption">
					  <h5>{{ $product->product_name }}</h5>
					  <h4><a class="btn" href="{{ url('product/detail/'.$product->id) }}">VIEW</a> <span class="pull-right">$222.00</span></h4>
					</div>
				  </div>
				</li>
				@endforeach
			  </ul>
			  </div>
			  @endforeach

			  </div>
			  <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
			  <a class="right carousel-control" href="#featured" data-slide="next">›</a>
			  </div>
			  </div>
		</div>

		<!-- Latest Products ===================================================== -->

			  @yield('content')	

		<!-- End Latest Products ================================================== -->
		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
	<div  id="footerSection">
	<div class="container">
		<div class="row">
			<div class="span3">
				<h5>ACCOUNT</h5>
				<a href="login.html">YOUR ACCOUNT</a>
				<a href="login.html">PERSONAL INFORMATION</a> 
				<a href="login.html">ADDRESSES</a> 
				<a href="login.html">DISCOUNT</a>  
				<a href="login.html">ORDER HISTORY</a>
			 </div>
			<div class="span3">
				<h5>INFORMATION</h5>
				<a href="contact.html">CONTACT</a>  
				<a href="register.html">REGISTRATION</a>  
				<a href="legal_notice.html">LEGAL NOTICE</a>  
				<a href="tac.html">TERMS AND CONDITIONS</a> 
				<a href="faq.html">FAQ</a>
			 </div>
			<div class="span3">
				<h5>OUR OFFERS</h5>
				<a href="#">NEW PRODUCTS</a> 
				<a href="#">TOP SELLERS</a>  
				<a href="special_offer.html">SPECIAL OFFERS</a>  
				<a href="#">MANUFACTURERS</a> 
				<a href="#">SUPPLIERS</a> 
			 </div>
			<div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="#"><img width="60" height="60" src="bootshop/themes/images/facebook.png" title="facebook" alt="facebook"/></a>
				<a href="#"><img width="60" height="60" src="bootshop/themes/images/twitter.png" title="twitter" alt="twitter"/></a>
				<a href="#"><img width="60" height="60" src="bootshop/themes/images/youtube.png" title="youtube" alt="youtube"/></a>
			 </div> 
		 </div>
		<p class="pull-right">&copy; --Online PhoneShop Number #1 in Bali Island--</p>
	</div><!-- Container End -->
	</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	@include('layouts.script')
	@yield('scripts')
	
	<!-- Themes switcher section ============================================================================================= -->

<span id="themesBtn"></span>
</body>
</html>