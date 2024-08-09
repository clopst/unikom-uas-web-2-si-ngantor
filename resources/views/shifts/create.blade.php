@extends('adminlte::page')

@section('title', 'Data Shift')

@section('content_header')
    <h1>Data Shift</h1>
@stop

@section('plugins.Select2', true)

@section('content')
    <div class="col-md-12">

        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Form Shift</h3>
            </div>

            <form method="post" action="{{ route('shifts.store') }}">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Shift</label>
                                <x-adminlte-input type="text" class="form-control" name="name" id="name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="tolerance">Toleransi Waktu <small>(dalam menit)</small></label>
                            <x-adminlte-input type="number" min="0" class="form-control" name="tolerance"
                                id="tolerance" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="in">Waktu Masuk</label>
                                <x-adminlte-input type="time" class="form-control" name="in" id="in" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="out">Waktu Keluar</label>
                            <x-adminlte-input type="time" class="form-control" name="out" id="out" />
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@stop
