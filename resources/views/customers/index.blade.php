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
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('customers') }}</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid mb-3 d-flex justify-content-end">
    <div class="row">
        <div class="col-12">
            @can('customer-create')
                <a href="{{ route('customers.create') }}" class="btn btn-sm btn-primary">Tambah</a>
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
            <table id="example1" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 1%">No.</th>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th class="text-center" style="width: 15%"><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->gender == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                        <td>
                            {{ $customer->address }}
                            @foreach ($villages as $village)
                                {{ $customer->village == $village->code ? $village->name : ""  }}
                            @endforeach
                            @foreach ($districts as $district)
                                {{ $customer->district == $district->code ? $district->name : ""  }}
                            @endforeach
                            @foreach ($cities as $city)
                                {{ $customer->city == $city->code ? $city->name : ""  }}
                            @endforeach
                            @foreach ($provinces as $province)
                                {{ $customer->province == $province->code ? $province->name : "" }}
                            @endforeach
                        </td>
                        <td class="d-flex justify-content-between">
                            @can('customer-list') <a class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a> @endcan

                            @can('customer-edit')
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>
                            @endcan

                            @can('customer-delete')
                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus ini?')"><i class="fas fa-trash"></i></button>
                                @csrf
                                @method('DELETE')
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection

@section('custom-scripts')

<script>

$(document).ready(function () {


});

</script>

@endsection
