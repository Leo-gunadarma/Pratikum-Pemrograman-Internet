@extends('layouts_admin.master')

@section('content')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


    <div class="row">
        <div class="col-md-4">
            <form role="form" method="post" action="{{ url('alamat') }}">
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Pilih provinsi</label>
                  <select class="form-control" name="provinsi">
                    <option>Pilih Provinsi</option>
                      @foreach($provinsi->rajaongkir->results as $pr)
                      <option value="{{ $pr->province_id }}">{{ $pr->province }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Kota</label>
                  <select class="form-control" name="kota">

                  </select>
                </div>

              </div>
              <!-- /.box-body -->
 
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')

<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function(){

    $("select[name='provinsi']").change(function(e){
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


    var flash = "{{ Session::has('pesan') }}";
    if(flash){
      var pesan = "{{ Session::get('pesan') }}";
      swal('success', pesan, 'success');
    }

  });
</script>

@endsection