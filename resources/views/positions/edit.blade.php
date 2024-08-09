{{-- 10123909 - Andi Tegar Permadi --}}

@extends('adminlte::page')

@section('title', 'Data Jabatan')

@section('content_header')
    <h1>Data Jabatan</h1>
@stop

@section('plugins.Select2', true)

@section('content')
    <div class="col-md-12">

        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Form Jabatan</h3>
            </div>

            <form method="post" action="{{ route('positions.update', $position->id) }}">
                @csrf
                @method('put')

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Jabatan</label>
                                <x-adminlte-input type="text" class="form-control" name="name" id="name"
                                    value="{{ $position->name }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="parent_id">Parent Jabatan</label>
                            <x-adminlte-select2 class="form-control" name="parent_id" id="parent_id"
                                value="{{ $position->parent_id }}" style="width: 100%;">
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"
                                        {{ $position->parent_id === $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}</option>
                                @endforeach
                            </x-adminlte-select2>
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
