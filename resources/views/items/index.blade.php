@extends('layouts.app', compact('title'))

@section('content')
@include('sweetalert::alert')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">{{ $title ?? '' }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            {{-- <li class="breadcrumb-item"><a href="#">{{ Breadcrumbs::render('home') }}</a></li> --}}
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('items') }}</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid mb-3 d-flex justify-content-end">
    <div class="row">
        <div class="col-12">
            @can('item-create')
                <a href="{{ route('items.create') }}" class="btn btn-sm btn-primary">Tambah</a>
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Impor</a>
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Ekspor</a>
            @endcan
        </div>
    </div>
</div>

<div class="container">
    @include('components.alerts')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 1%">No.</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Kuantitas</th>
                        {{-- <th>Deskripsi</th> --}}
                        <th class="text-center" style="width: 15%"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->description }}</td>
                        <td class="d-flex justify-content-between">
                            @can('item-list') <a class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a> @endcan

                            @can('item-edit')
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>
                            @endcan

                            @can('item-delete')
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus ini?')"><i class="fas fa-trash"></i></button>
                                @csrf
                                @method('DELETE')
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- MODAL -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Detail Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div>
                <input type="hidden" name="item_id" id="item_id">
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item name"></li>
                        <li class="list-group-item price"></li>
                        <li class="list-group-item quantity"></li>
                        <li class="list-group-item description"></li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer justify-content-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection

@section('custom-styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('asset')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('custom-scripts')

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('asset')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('asset')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('asset')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('asset')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('asset')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('asset')}}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('asset')}}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('asset')}}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('asset')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('asset')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('asset')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script>
        $(function () {

            let table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,

                ajax: "{{ route('items.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'quantity', name: 'quantity'},
                    // {data: 'description', name: 'description'},
                    {data: 'action', name: 'action', orderable: true, searchable: true},
                ]
            });

            $('body').on('click', '#showItem', function () {
                var item_id = $(this).data('id');
                $.get("{{ route('items.index') }}" +'/' + item_id, function (data) {
                    $('#modal-lg').modal('show');
                    $('#modal-title').html("Detail Barang");
                    $('#item_id').val(data.id);
                    $('.name').html('Nama : ' + data.name);
                    $('.price').html('Harga : ' + data.price);
                    $('.quantity').html('Kuantitas : ' + data.quantity);
                    $('.description').html('Deskripsi : ' + data.description);
                })
           });

        });
    </script>

@endsection
