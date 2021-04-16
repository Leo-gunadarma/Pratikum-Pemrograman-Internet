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
<h1 class="h3 text-dark">List Product Handphone</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="font-weight-bold text-primary">List data</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Product</th>
                        <th>Rate</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>Ini Rate</td>
                        <td class="text-center">
                            <form action="/product/{{$product->id}}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                {{-- TOMBOL TAMPILKAN GAMBAR --}}
                                {{-- TOMBOL DETAIL --}}
                                <a href="/product/{{$product->id}}" class="btn btn-success">
                                    <i class="fas fa-eye"></i> Detail
                                </a>

                                {{-- TOMBOL DELETE --}}
                                <button type="submit" name="submit"
                                    onclick="return confirm('Anda yakin ingin menghapus data ini?')"
                                    class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">There is no data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        <a href="product/create" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus-square"></i>
            </span>
            <span class="text">Tambah Data</span>
        </a>
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
