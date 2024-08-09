{{-- 10123914 - DIMAS NURFAUZI --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p>Halo, <strong>{{ $user->email }}</strong></p>
        </div>

        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Kehadiran</h3>
                </div>

                <form method="post" action="{{ route('attendances.store') }}">
                    @csrf

                    <x-adminlte-input type="hidden" class="form-control" name="type" id="type"
                        value="{{ $attendance_status['type'] }}" />

                    <div class="card-body">
                        <p class="text-lg" id="real-time-clock"></p>

                        <p class="text-lg">Shift Anda: <strong>{{ $user->employee->shift->name }}</strong></p>
                        <table class="table">
                            <tr>
                                <thead>
                                    <tr>
                                        <th>Waktu Masuk</th>
                                        <th>Waktu Keluar</th>
                                        <th>Toleransi Keterlambatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $user->employee->shift->in }}</td>
                                        <td>{{ $user->employee->shift->out }}</td>
                                        <td>{{ $user->employee->shift->tolerance }} Menit</td>
                                    </tr>
                                </tbody>
                            </tr>
                        </table>
                    </div>

                    <div class="card-footer text-center">
                        @if ($attendance_status['should_attendance'])
                            @if ($attendance_status['type'] === 'in')
                                <button type="submit" class="btn btn-primary">Absensi Masuk</button>
                            @else
                                <button type="submit" class="btn btn-warning">Absensi Keluar</button>
                            @endif
                        @else
                            <span>Absensi Hari Ini Telah Selesai</span>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Kehadiran Terakhir</h3>
                </div>

                <div class="card-body">
                    <div id="real-time-clock"></div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis Kehadiran</th>
                                <th>Waktu</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->date_day }}</td>
                                    <td>
                                        @if ($attendance->type === 'in')
                                            <span class="badge bg-primary">Masuk</span>
                                        @else
                                            <span class="badge bg-warning">Keluar</span>
                                        @endif
                                    </td>
                                    <td>{{ $attendance->time }}</td>
                                    <td>
                                        @if ($attendance->is_late)
                                            <span class="badge bg-danger">Terlambat</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

    <script>
        $(() => {
            function updateDateTime() {
                const clockElement = document.getElementById('real-time-clock');
                const currentTime = new Date();

                // Define arrays for days of the week and months to format the day and month names.
                const daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const dayOfWeek = daysOfWeek[currentTime.getDay()];

                const months = [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                ];
                const month = months[currentTime.getMonth()];

                const day = currentTime.getDate();
                const year = currentTime.getFullYear();

                // Calculate and format hours (in 24-hour format), minutes, seconds.
                const hours = currentTime.getHours().toString().padStart(2, '0');
                const minutes = currentTime.getMinutes().toString().padStart(2, '0');
                const seconds = currentTime.getSeconds().toString().padStart(2, '0');

                // Construct the date and time string in the desired format.
                const dateTimeString =
                    `${dayOfWeek}, ${day} ${month} ${year} ${hours}:${minutes}:${seconds}`;
                clockElement.textContent = dateTimeString;
            }

            // Update the date and time every second (1000 milliseconds).
            setInterval(updateDateTime, 1000);

            // Initial update.
            updateDateTime();
        });
    </script>
@stop
