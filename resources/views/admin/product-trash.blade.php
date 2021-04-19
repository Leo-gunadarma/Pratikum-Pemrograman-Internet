@extends('template.admin-layout')
@section('css')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
@endsection
@section('product-active')
active
@endsection


@section('content')

@if(Session::has('berhasil'))
<script>
    Swal.fire(
        'Berhasil',
        '{{Session::get('
        berhasil ') }}',
        'success'
    )

</script>
@endif
@if(Session::has('gagal'))
<div class="alert alert-danger">
    <p>{{Session::get('gagal') }}</p>
</div>
@endif
@if(Session::has('error'))
<script>
    Swal.fire({
        icon: 'warning',
        title: '{{Session::get('
        error ') }}',
        text: 'Data katogori tidak ada, silahkan tambahkan data kategori terlebih dahulu',
        confirmButtonText: 'Tambah Data Kategori',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/product-category/create";
        }
    })

</script>
@endif


<h1 class="h3 text-dark">Product Terhapus</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="font-weight-bold text-primary">List Data Yang Terhapus Sementara</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Product</th>
                        <th>Rate</th>
                        <th>Deleted At</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_trash as $prd)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$prd->product_name}}</td>
                        <td>Ini Rate</td>
                        <td>{{ $prd->deleted_at }}</td>
                        <td class="text-center">
                                <button type="submit" name="submit"
                                    onclick="return confirm('Anda yakin ingin menghapus data ini?')"
                                    class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

</div>

@endsection


@section('javascript')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });

</script>
@endsection
