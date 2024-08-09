@extends('adminlte::page')

@section('title', 'Data Shift')

@section('content_header')
    <h1>Data Shift</h1>
@stop

@section('plugins.Datatables', true)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <p>List data shift.</p>

        <a href="{{ route('shifts.create') }}">
            <button class="btn btn-primary">Create</button>
        </a>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{-- Setup data for datatables --}}
            @php
                $heads = ['ID', 'Nama', 'Waktu Masuk', 'Waktu Keluar', 'Toleransi Keterlambatan', 'Actions'];
            @endphp

            <x-adminlte-datatable id="table" :heads="$heads" />

        </div>
    </div>
@stop


@push('js')
    <script>
        $(() => {
            let config = {
                'processing': true,
                'serverSide': true,
                'ajax': "{{ route('shifts.index') }}",
                'columnDefs': [{
                    'defaultContent': '-',
                    'targets': '_all',
                }],
                'columns': [{
                        'data': 'id',
                        'name': 'id',
                    },
                    {
                        'data': 'name',
                        'name': 'name',
                    },
                    {
                        'data': 'in',
                        'name': 'in',
                    },
                    {
                        'data': 'out',
                        'name': 'out',
                    },
                    {
                        'data': 'tolerance',
                        'name': 'tolerance',
                        'render': (data) => `${data} Menit`,
                    },
                    {
                        'data': null,
                        'render': (data, type, row) => {
                            let routeEdit = "{{ route('shifts.edit', ':id') }}";
                            routeEdit = routeEdit.replace(":id", row.id);

                            let routeDelete = "{{ route('shifts.destroy', ':id') }}";
                            routeDelete = routeDelete.replace(":id", row.id);

                            return `<div class="d-flex">
                                <a href="${routeEdit}" class="btn btn-xs btn-default text-secondary mx-1" title="Edit"><i class="fa fa-lg fa-fw fa-edit"></i></a>
                                <form method="post" action="${routeDelete}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <button href="#" type="submit" class="btn btn-xs btn-default text-danger mx-1" title="Delete"><i class="fa fa-lg fa-fw fa-trash"></i></button>
                                </form>
                            </div>`;
                        }
                    },
                ],
            };

            $('#table').DataTable(config);
        })
    </script>
@endpush
