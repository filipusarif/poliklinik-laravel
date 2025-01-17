@extends('component.layout.app')
@push('title')
    <title>Jadwal Praktik - Poliklinik Udinus</title>
@endpush
@push('styles')
    <style>
        .card-calendar .calendar {
            width: 100%;
            height: 100%;
        }

        .col-lg-3 {
            flex: 1;
        }
    </style>
@endpush
@section('content')
    <!-- Jadwal Praktik -->
    <section id="jadwal-praktik">
        <div class="container-fluid py-4">
            @include('component.alert')
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Jadwal Praktik</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Navigasi Hari -->
                                <div class="col-sm-3 mb-3">
                                    <div class="nav-wrapper position-relative end-0">
                                        <ul class="nav nav-pills nav-fill flex-column p-1" role="tablist">
                                            @foreach ($days as $index => $day)
                                                <li class="nav-item">
                                                    <a class="nav-link mb-0 px-0 py-1 {{ $index === 0 ? 'active' : '' }}"
                                                        id="{{ strtolower($day) }}-tab" data-bs-toggle="tab"
                                                        data-bs-target="#{{ strtolower($day) }}" type="button"
                                                        role="tab" aria-controls="{{ strtolower($day) }}"
                                                        aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                                                        {{ $day }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <!-- Konten Jadwal -->
                                <div class="col-sm-9">
                                    <div class="tab-content" id="hariTabContent">
                                        @foreach ($days as $index => $day)
                                            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="{{ strtolower($day) }}" role="tabpanel" aria-labelledby="{{ strtolower($day) }}-tab">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="mb-0">{{ $day }}</h5>
                                                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addSlotModal">
                                                        Tambah Slot
                                                    </button>
                                                </div>
                                                @if (isset($jadwal_by_day[$day]) && $jadwal_by_day[$day]->isNotEmpty())
                                                    <div class="table-responsive">
                                                        <table class="table table-hover align-middle text-center">
                                                            <thead>
                                                                <tr>
                                                                    <th>Jam Mulai</th>
                                                                    <th>Jam Selesai</th>
                                                                    <th>Aksi</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($jadwal_by_day[$day] as $jadwal)
                                                                    <tr>
                                                                        <td>
                                                                            <span class="badge badge-pill badge-dark badge-lg text-white">
                                                                                <p class="mb-0 text-sm">
                                                                                    {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                                                                                </p>
                                                                            </span>
                                                                        </td>
                                                                        <td>
                                                                            <span class="badge badge-pill badge-dark badge-lg text-white">
                                                                                <p class="mb-0 text-sm">
                                                                                    {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                                                                </p>
                                                                            </span>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <div class="d-flex justify-content-center">
                                                                                <form action="{{ route('dokter.jadwal_praktik.activate', $jadwal->id) }}" method="POST" class="confirm-update-jadwal">
                                                                                    @csrf
                                                                                    @method('PATCH')
                                                                                    <button class="btn btn-success btn-sm mx-1" type="submit">
                                                                                        <i class="fa-solid fa-check"></i>
                                                                                    </button>
                                                                                </form>                                                                                
                                                                                <form action="{{ route('dokter.jadwal_praktik.deactivate', $jadwal->id) }}" method="POST" class="confirm-update-jadwal">
                                                                                    @csrf
                                                                                    @method('PATCH')
                                                                                    <button class="btn btn-danger btn-sm mx-1" type="submit">
                                                                                        <i class="fa-solid fa-times"></i>
                                                                                    </button>
                                                                                </form>                                                                                
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            @if ($jadwal->is_active)
                                                                                <i class="fa-solid fa-check-circle fa-lg text-success" title="Aktif"></i>
                                                                            @else
                                                                                <i class="fa-solid fa-times-circle fa-lg text-danger" title="Tidak Aktif"></i>
                                                                            @endif
                                                                        </td>                                                                        
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    <p>Tidak ada jadwal pada hari ini.</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="addSlotModal" tabindex="-1" aria-labelledby="addSlotModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addSlotModalLabel">Tambah Slot</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('dokter.jadwal_praktik.store') }}">
                                                @csrf
                                                <input type="hidden" name="id_dokter" id="id_dokter" value="{{ auth()->guard('dokter')->user()->id }}">
                                                <input type="hidden" name="hari" id="hari" value="Senin">
                                                <div class="mb-3">
                                                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                                    <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                                    <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" required>
                                                </div>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa-solid fa-floppy-disk me-1"></i>
                                                    Tambah Slot
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Calendar -->
                <div class="col-lg-7">
                    <div class="card card-calendar">
                        <div class="card-body p-3">
                            <div class="calendar" id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/plugins/flatpickr.js') }}"></script>
    <script src="{{ asset('js/plugins/flatpickr-id.js') }}"></script>
    <script>
        $(document).ready(function() {
            var hiddenInput = $('#hari');

            // Ambil teks dari tab aktif dan ambil hanya nama hari
            var activeTabText = $('.nav-link.active').text().trim();

            // Menggunakan regex untuk hanya mengambil nama hari dari teks tab
            var day = activeTabText.match(/Senin|Selasa|Rabu|Kamis|Jumat|Sabtu|Minggu/);

            // Set nilai input tersembunyi dengan nama hari saja, jika ditemukan
            if (day) {
                hiddenInput.val(day[0]);
            }

            // Ketika tab berubah, update nilai input tersembunyi dengan nama hari
            $('.nav-link').on('shown.bs.tab', function() {
                var newActiveTabText = $(this).text().trim();

                // Menggunakan regex untuk mengambil nama hari
                var newDay = newActiveTabText.match(/Senin|Selasa|Rabu|Kamis|Jumat|Sabtu|Minggu/);

                if (newDay) {
                    hiddenInput.val(newDay[0]); // Update nilai input tersembunyi
                }
            });
        });
    </script>

    <script>
        // Menangani submit form dengan kelas 'delete-form'
        $(document).on('submit', '.delete-form', function(event) {
            event.preventDefault();
            var form = this; // Menyimpan form yang sedang disubmit
            confirmDelete(form); // Memanggil fungsi konfirmasi hapus
        });
    </script>
    <script src="{{ asset('js/plugins/fullcalendar.min.js') }}"></script>

    <script>
        var events = @json($events); // Ambil data event dari controller
        console.log(events);

        // Inisialisasi kalender FullCalendar
        var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
            initialView: "dayGridMonth",
            headerToolbar: {
                start: 'title',
                center: '',
                end: 'today prev,next'
            },
            events: events, // Gunakan data event dari controller
            locale: 'id', // Set locale untuk bahasa Indonesia
            selectable: true,
            editable: true,
        });

        // Render kalender
        calendar.render();
    </script>
    <script>
        // Menangani submit form dengan kelas 'delete-form'
        $(document).on('submit', '.confirm-update-jadwal', function(event) {
            event.preventDefault();
            var form = this;  // Menyimpan form yang sedang disubmit
            confirmUpdateJadwal(form);  // Memanggil fungsi konfirmasi hapus
        });
    </script>
    <script>
        // Inisialisasi flatpickr untuk jam_mulai
        const jamMulaiPicker = flatpickr('#jam_mulai', {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            locale: "id",
            onChange: function (selectedDates, dateStr) {
                // Saat jam_mulai berubah, perbarui minTime untuk jam_selesai
                jamSelesaiPicker.set('minTime', dateStr);
            },
        });
    
        // Inisialisasi flatpickr untuk jam_selesai
        const jamSelesaiPicker = flatpickr('#jam_selesai', {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            locale: "id",
        });
    </script>    
@endpush