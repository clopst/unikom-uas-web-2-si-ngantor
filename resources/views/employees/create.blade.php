{{-- 10123914 - DIMAS NURFAUZI --}}

@extends('adminlte::page')

@section('title', 'Data Karyawan')

@section('content_header')
    <h1>Data Karyawan</h1>
@stop

@section('plugins.Select2', true)

@section('content')
    <div class="col-md-12">

        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Form Karyawan</h3>
            </div>

            <form method="post" action="{{ route('employees.store') }}">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">Nama Depan</label>
                                <x-adminlte-input type="text" class="form-control" name="first_name" id="first_name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Nama Belakang</label>
                                <x-adminlte-input type="text" class="form-control" name="last_name" id="last_name" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <x-adminlte-select2 class="form-control" name="gender" id="gender" style="width: 100%;">
                                    <option value="male">male</option>
                                    <option value="female">female</option>
                                </x-adminlte-select2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="birth_date">Tanggal Lahir</label>
                                <x-adminlte-input type="date" class="form-control" name="birth_date" id="birth_date" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position_id">Jabatan</label>
                                <x-adminlte-select2 class="form-control" name="position_id" id="position_id"
                                    style="width: 100%;">
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </x-adminlte-select2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shift_id">Shift</label>
                                <x-adminlte-select2 class="form-control" name="shift_id" id="shift_id"
                                    style="width: 100%;">
                                    @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                    @endforeach
                                </x-adminlte-select2>
                            </div>
                        </div>
                    </div>

                    <h5>Informasi Akun</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <x-adminlte-input type="email" class="form-control" name="email" id="email" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <x-adminlte-input type="password" class="form-control" name="password" id="password" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@stop
