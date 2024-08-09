@extends('adminlte::page')

@section('title', 'Data Karyawan')

@section('content_header')
    <h1>Data Karyawan</h1>
@stop

@section('plugins.Datatables', true)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <p>List data karyawan.</p>

        <a href="{{ route('employees.create') }}">
            <button class="btn btn-primary">Create</button>
        </a>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{-- Setup data for datatables --}}
            @php
                $heads = [
                    'ID',
                    'Nama Depan',
                    'Nama Belakang',
                    'Email',
                    'Jenis Kelamin',
                    'Tanggal Lahir',
                    'Jabatan',
                    'Shift',
                    'Actions',
                ];

                $config = [
                    'processing' => true,
                    'serverSide' => true,
                    'ajax' => route('employees.index'),
                    'columnDefs' => [
                        [
                            'defaultContent' => '-',
                            'targets' => '_all',
                        ],
                    ],
                    'columns' => [
                        ['data' => 'id', 'name' => 'id'],
                        ['data' => 'first_name', 'name' => 'first_name'],
                        ['data' => 'last_name', 'name' => 'last_name'],
                        ['data' => 'user.email', 'name' => 'user.email'],
                        ['data' => 'gender', 'name' => 'gender'],
                        ['data' => 'birth_date', 'name' => 'birth_date'],
                        ['data' => 'position.name', 'name' => 'position.name'],
                        ['data' => 'shift.name', 'name' => 'shift.name'],
                        [
                            'data' => null,
                            'render' =>
                                'function(data) { return \'' .
                                '<a href="" class="btn btn-xs btn-default text-secondary mx-1" title="Edit"><i class="fa fa-lg fa-fw fa-edit"></i></a>' .
                                '<a href="#" class="btn btn-xs btn-default text-danger mx-1" title="Delete"><i class="fa fa-lg fa-fw fa-trash"></i></a>' .
                                '\'; }',
                        ],
                    ],
                ];
            @endphp

            <x-adminlte-datatable id="table" :heads="$heads" :config="$config" />

        </div>
    </div>
@stop


@push('js')
    <script>
        $(() => {
            let config = {
                'processing': true,
                'serverSide': true,
                'ajax': "{{ route('employees.index') }}",
                'columnDefs': [{
                    'defaultContent': '-',
                    'targets': '_all',
                }],
                'columns': [{
                        'data': 'id',
                        'name': 'id',
                    },
                    {
                        'data': 'first_name',
                        'name': 'first_name',
                    },
                    {
                        'data': 'last_name',
                        'name': 'last_name',
                    },
                    {
                        'data': 'user.email',
                        'name': 'user.email',
                    },
                    {
                        'data': 'gender',
                        'name': 'gender',
                    },
                    {
                        'data': 'birth_date',
                        'name': 'birth_date',
                    },
                    {
                        'data': 'position.name',
                        'name': 'position.name',
                    },
                    {
                        'data': 'shift.name',
                        'name': 'shift.name',
                    },
                    {
                        'data': null,
                        'render': (data, type, row) => {
                            let routeEdit = "{{ route('employees.edit', ':id') }}";
                            routeEdit = routeEdit.replace(":id", row.id);

                            let routeDelete = "{{ route('employees.destroy', ':id') }}";
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
