@extends('layouts.master')

@section('content')

<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small>{{ count(Cart::content()) }} Item(s) </small>]<a href="{{ url('shopping-cart/destroy') }}" class="btn btn-large pull-right"> Kosongkan Keranjang </a></h3>	
	<hr class="soft"/>
			
	<table class="table table-bordered">
              <thead>
                <tr>
                  <th>Deskripsi</th>
                  <th>Kuantitas/Update</th>
				  <th>Harga</th>
                  <th>SubTotal</th>
				</tr>
              </thead>
              <tbody>
              	@foreach($products as $product)
                <tr>
                  <td>{{ $product->name }}<br/>Color : black, Material : metal</td>
				  <td>
					<div class="input-append"><input disabled="" class="span1" style="max-width:34px" placeholder="{{ $product->qty }}" id="appendedInputButtons" size="16" type="text"><button rowId="{{ $product->rowId }}" class="btn kurangi-qty" type="button"><i class="icon-minus"></i></button>
						<a href="{{ $product->rowId }}" class="btn add-qty"><i class="icon-plus"></i></a>				
					</div>
				  </td>
                  <td>Rp. {{ number_format($product->price, 0) }}</td>
                  <td>Rp. {{ number_format($product->subtotal, 0) }}</td>
                </tr>
                @endforeach
                <tr>
                	<th class="text-center" colspan="3">Pajak</th>
                	<td class="label label-important text-center">21%</td>
                </tr>
                <tr>
                	<th class="text-center" colspan="3">Total</th>
                	<td class="label label-important">{{ Cart::total() }}</td>
                </tr>
                
				</tbody>
            </table>
			</table>

	<a href="{{ url('/') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Kembali Berbelanja </a>
	@if(count(Cart::content()) != 0)
	<a href="{{ url('shopping-cart/checkout') }}" class="btn btn-large pull-right">Checkout <i class="icon-arrow-right"></i></a>
	@endif
	
</div>

@endsection

@section('scripts')

<script type="text/javascript">
	$(document).ready(function(){
		$('.add-qty').click(function(e){
			e.preventDefault();
			var rowId = $(this).attr('href');
			window.location.href = "{{ url('shopping-cart/update') }}"+'/'+rowId;
		});

		$('.kurangi-qty').click(function(e){
			e.preventDefault();
			var rowId = $(this).attr('rowId');
			window.location.href = "{{ url('shopping-cart/kurangi') }}"+'/'+rowId;
		});
	});
</script>

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