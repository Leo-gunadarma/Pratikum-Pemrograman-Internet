@extends('layouts_admin.master')

@section('content')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="example1">
                <span style="color: red;"><small></small></span>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Total Bayar</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Bukti Pembayaran</th>
                  </tr></thead>
                <tbody>
                @foreach($konfirmasis as $index=>$konfirmasi)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <?php
                    $user = \DB::table('users')->where('id', $konfirmasi->users_id)->value('name');
                    $totalbayar = \DB::table('pesanan')->where('id', $konfirmasi->pesanan_id)->value('total_bayar');
                    $tanggal = \DB::table('pesanan')->where('id', $konfirmasi->pesanan_id)->value('created_at');
                    $statuss = \DB::table('pesanan')->where('id', $konfirmasi->pesanan_id)->value('status_invoice_id');
                  ?>
                  <td class="konfirmasi" pesanan-id="{{ $konfirmasi->pesanan_id }}" style="cursor: pointer; color: black;">{{ $user }}</td>
                  <td>Rp. {{ number_format($totalbayar, 0) }}</td>
                  <td>{{ $tanggal }}</td>
                  <?php
                      $status = $statuss;
                      $warna = 'black';
                      if($status == 1){
                        $warna = 'yellow' && $status_new = 'Belum bayar';
                      }
                      if($status == 2){
                        $warna = 'blue' && $status_new = 'Menunggu Verifikasi';
                      }
                      if($status == 3){
                        $warna = 'green' && $status_new = 'Dibayar';
                      }
                      if($status == 4){
                        $warna = 'red' && $status_new = 'Ditolak';
                      }
                  ?>
                  <td style="color: {{ $warna }}">{{ $status_new }}</td>
                  <?php
                      $photo = $konfirmasi->photo;
                      $lampiran = base64_decode($photo);
                  ?>
                  <td><a href="{{ $lampiran }}" download>Download Lampiran</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

       <!-- /.modal -->

        <div class="modal modal-default fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Konfirmasi Pembayaran</h4>
              </div>
              <div class="modal-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                        Nama Penerima
                      </th>
                      <td>
                        :
                      </td>
                      <td id="nama-penerima">
                        
                      </td>
                    </tr>
                    <tr>
                      <th>
                        Alamat
                      </th>
                      <td>
                        :
                      </td>
                      <td id="alamat">
                        
                      </td>
                    </tr>
                  </thead>
                </table>

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>
                        Nama Barang
                      </th>
                      <th>
                        Qty
                      </th>
                      <th>
                        Subtotal
                      </th>
                    </tr>
                  </thead>
                  <tbody id="barangs">
                    
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

@endsection

@section('scripts')

<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function(){
    var flash = "{{ Session::has('pesan') }}";
    if(flash){
      var pesan = "{{ Session::get('pesan') }}";
      swal('success', pesan, 'success');
    }

    // Ketika detial konfirmasi
    $('body').on('click', '.konfirmasi', function(){
      var pesanan_id = $(this).attr('pesanan-id');
      var url = "{{ url('konfirmasi/detail') }}"+'/'+pesanan_id;
      $('#nama-penerima').empty();
      $('#alamat').empty();
      $('#barangs').empty();

      $.ajax({
        type : 'get',
        dataType : 'json',
        url : "{{ url('konfirmasi/detail') }}"+'/'+pesanan_id,
        success : function(data){
          // console.log(data);
          $('#nama-penerima').append(data.hasil.nama_penerima);
          $('#alamat').append(data.hasil.alamat);

          $.each(data.hasil.barang, function(i, v){
            console.log(v);

            var barang = '<tr>';

            barang += '<td>';
            barang += v.nama_barang;
            barang += '</td>';

            barang += '<td>';
            barang += v.qty;
            barang += '</td>';

            barang += '<td>';
            barang += 'Rp. '+v.subtotal;
            barang += '</td>';

            barang += '</tr>';

            $('#barangs').append(barang);
          });

          $('#modal-info').modal();
        }
      });
    });

    // Ketika hapus barang
    $('body').on('click', '.hapusBarang', function(e){
      e.preventDefault();
      var barang_id = $(this).attr('barang-id');
      var url = "{{ url('delete/barang') }}"+'/'+barang_id;
      $('.confirmDelete').attr('href', url);
        
      $('#modal-danger').modal();
    });

  });
</script>

@endsection