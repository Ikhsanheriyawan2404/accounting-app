@extends('layouts.app', compact('title'))

@section('content')
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
            <li class="breadcrumb-item active">{{ Breadcrumbs::render('edit_customer', $customer) }}</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid">
<!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Edit Pelanggan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Nama pelanggan</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nomor telepon" value="{{ $customer->name ?? old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="cth: pelanggan@mail.com" value="{{ $customer->email ?? old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="" value="{{ $customer->phone ?? old('phone') }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis kelamin</label>
                            <div class="form-check">
                                <input type="radio" name="gender" class="form-check-input @error('gender') is-invalid @enderror" value="L" {{ $customer->gender == 'L' ? 'checked' : ''}}>
                                <label class="form-check-label">Laki - Laki</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="gender" class="form-check-input @error('gender') is-invalid @enderror" value="P" {{ $customer->gender == 'P' ? 'checked' : ''}}>
                                <label class="form-check-label">Perempuan</label>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select name="province" id="province" class="form-control select2 @error('province') is-invalid @enderror" style="width: 100%;">
                                <option selected disabled>Pilih provinsi</option>
                                @foreach ($provinces as $id => $code)
                                <option value="{{ $id }}" {{ $customer->province == $id ? 'selected' : ''}}>{{ $code }}</option>
                                @endforeach
                            </select>
                            @error('province')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kota / Kabupaten</label>
                            <select name="city" id="city" class="form-control select2 @error('city') is-invalid @enderror" style="width: 100%;">
                                <option selected disabled>Pilih kota / kabupaten</option>
                                {{-- @foreach ($cities as $id => $code)
                                <option value="{{ $id }}" {{ $customer->cities == $id ? 'selected' : ''}}>{{ $code }}</option>
                                @endforeach --}}
                            </select>
                            </select>
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select name="district" id="district" class="form-control select2 @error('district') is-invalid @enderror" style="width: 100%;">
                                <option selected disabled>Pilih kecamatan</option>
                            </select>
                            @error('district')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kelurahan</label>
                            <select name="village" id="village" class="form-control select2 @error('village') is-invalid @enderror" style="width: 100%;">
                                <option selected disabled>Pilih kelurahan</option>
                            </select>
                            @error('village')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat detail</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="cth: Blok 3 penangisan RT 01 RW 05" value="{{ $customer->address ?? old('address') }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Tambah</button>
            </div>
        </form>
    </div>
<!-- /.card -->
</div>

@endsection

@section('custom-styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/select2/css/select2.min.css">
@endsection

@section('custom-scripts')
    <!-- Select2 -->
    <script src="{{ asset('asset') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>

    $(function () {

        // Agar tokennya tidak missmatch
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        // dropdown kota / kabupaten {
        $('#province').on('change', function () {
            $.ajax({
                url: '{{ route('get_cities') }}',
                method: 'POST',
                data: {id: $(this).val()},
                success: function (response) {
                    $('#city').empty();

                    $.each(response, function (id, name) {
                        $('#city').append(new Option(name, id))
                    })
                }
            })
        });

        // dropdown kecamatan
        $('#city').on('change', function () {
            $.ajax({
                url: '{{ route('get_districts') }}',
                method: 'POST',
                data: {id: $(this).val()},
                success: function (response) {
                    $('#district').empty();

                    $.each(response, function (id, name) {
                        $('#district').append(new Option(name, id))
                    })
                }
            })
        });

        // dropdown desa / kelurahan
        $('#district').on('change', function () {
            $.ajax({
                url: '{{ route('get_villages') }}',
                method: 'POST',
                data: {id: $(this).val()},
                success: function (response) {
                    $('#village').empty();

                    $.each(response, function (id, name) {
                        $('#village').append(new Option(name, id))
                    })
                }
            })
        });
    });

    </script>
@endsection
