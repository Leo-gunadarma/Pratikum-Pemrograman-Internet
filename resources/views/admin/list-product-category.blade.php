@extends('template.admin-layout')
@section('css')
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('product-active')
active
@endsection
@section('content')
@if(Session::has('berhasil'))
    <script>
        Swal.fire(
        'Berhasil',
        '{{Session::get('berhasil') }}',
        'success'
        )
    </script>
@endif
@if(Session::has('gagal'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal Memasukan Data',
        text: '{{Session::get('gagal') }}',
        footer: '<a href="/product-category/create">Ingin Memasukan ulang data?</a>'
    })
</script>
@endif
<h1 class="h3 text-dark">List Kategori Produk Handphone</h1>
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
                        <th>Nama Kategori</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productCategorys as $productCategory)
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$productCategory->category_name}}</td>
                    <td class="text-center">
                        <form action="/product-category/{{$productCategory->id}}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}

                        {{-- TOMBOL EDIT --}}
                        <a href="/product-category/{{$productCategory->id}}/edit" class="btn btn-primary"> 
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                        
                        {{-- TOMBOL DELETE --}}
                        <button type="submit" name="submit"  class="btn btn-danger delete-confirm"> 
                            <i class="fas fa-trash"></i> Delete
                        </button>
                </form>
                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">There is no data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <a href="/product-category/create" class="btn btn-primary btn-icon-split">
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
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            })
        });
    });
</script>
<!-- <script>
    $(document).ready(function(){
$('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
    });
</script> -->
@endsection
