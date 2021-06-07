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
				  <th>Berat</th>
                  <th>SubTotal</th>
				</tr>
              </thead>
              <tbody>
              	@php
              		$total_berat = 0;
              	@endphp
              	@foreach($products as $product)
                <tr>
                  <td>{{ $product->name }}<br/>Color : black, Material : metal</td>
				  <td>
					<div class="input-append"><input disabled="" class="span1" style="max-width:34px" placeholder="{{ $product->qty }}" id="appendedInputButtons" size="16" type="text"><button rowId="{{ $product->rowId }}" class="btn kurangi-qty" type="button"><i class="icon-minus"></i></button>
						<a href="{{ $product->rowId }}" class="btn add-qty"><i class="icon-plus"></i></a>				
					</div>
				  </td>
                  <td>Rp. {{ number_format($product->price, 0) }}</td>
                  <td>{{ $product->weight * $product->qty }} gram</td>
                  <td>Rp. {{ number_format($product->subtotal, 0) }}</td>
                  @php
              		$total_berat += $product->weight * $product->qty;
              	  @endphp
                </tr>
                @endforeach
                <tr>
                	<th class="text-center" colspan="3">Berat total</th>
                	<td class="label label-warning pull-right">{{ $total_berat }} Gram</td>
                </tr>
                <tr>
                	<th class="text-center" colspan="3">Total Harga</th>
                	<td class="label label-important pull-right">{{ Cart::pricetotal() }}</td>
                </tr>

               
                  
                  <table>
                  	<tbody>
                  		<tr>
                  			<td>
                  				<select class="form-control" name="provinsi">
				                	<option selected="" disabled="">Pilih Provinsi</option>
				                	@foreach($provinsi->rajaongkir->results as $pv)
				                	<option value="{{ $pv->province_id }}">{{ $pv->province }}</option>
				                	@endforeach
				                </select>
                  			</td>

                  			<td>
                  				<select class="form-control" name="kota">
				                	<option selected="" disabled="">Pilih Kota</option>
				                	
				                </select>
                  			</td>

                  			<td>
                  				<select class="form-control" name="kurir">
				                	<option selected="" disabled="">Pilih Kurir</option>
				                	<option value="jne">JNE</option>
				                	<option value="tiki">Tiki</option>
				                	<option value="post">Post</option>
				                	
				                </select>
                  			</td>

                  			<td>
                  				<button class="btn btn-cek-ongkir btn-primary">Cek Ongkir</button>
                  			</td>
                  			<br>
                  		</tr>

                  		<tr>
                  			<td class="list-ongkir">
                  				
                  			</td>
                  		</tr>
                  	</tbody>
                  </table>

              <!-- /.box-body -->
                
				</tbody>
            </table>
            <br><br>

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

		$('.btn-cek-ongkir').click(function(e){
			e.preventDefault();
			var kota_asal = "{{$kota_asal}}";
			var kota_tujuan = $("select[name='kota']").val();
			var kurir = $("select[name='kurir']").val();
			var berat = "{{$total_berat}}";
			var url = "{{url('cek-ongkir')}}"+'/'+kota_asal+'/'+kota_tujuan+'/'+kurir+'/'+berat;

			$.ajax({
	            type:'get',
	            dataType:'json',
	            url:url, 
	            success:function(data){
	            	console.log(data);

	            	var ongkirs = '' ;

	            	$.each(data.data.rajaongkir.results, function(i,v){
	            		$.each(v.cost, function(a,b){
	            			// ongkirs += b.service + ' ' + b.cost[0].value;
	            			ongkirs += '<input type="radio" name="servis" value="'+b.service + '|' + b.cost[0].value+'">'+ b.service + ' ' + b.cost[0].value;
	            		});
	            	})

	            	$('.list-ongkir').append(ongkirs);
            	}
            })
		})

		$("select[name='provinsi']").change(function(){
        $("select[name='kota']").empty();
        var id = $(this).val();
        var url = "{{ url('alamat/get-kota') }}"+'/'+id;
        
        $.ajax({
            type:'get',
            dataType:'json',
            url:url,
            success:function(data){
                console.log(data.data);

                var hasil = '';
                $.each(data.data.rajaongkir.results, function(i,v){
                    hasil += '<option value="'+v.city_id+'">';
                        hasil += v.type + ' ' + v.city_name;
                    hasil += '</option>';
                });

                $("select[name='kota']").append(hasil);
            }
        })
    })
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