@extends('layouts.admin')

@section('title', 'Akademik Santri - ' . $santri->Nama_santri)

@section('content')
<div class="container-fluid">
    <!-- Header Santri -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $santri->Nama_santri }}</h1>
        <div class="d-flex align-items-center">
            <span class="mr-2 text-gray-700">Status Akademik:</span>
            <span class="badge badge-{{ $santri->Status_aksk == 'aktif' ? 'success' : 'danger' }} px-3 py-2 text-uppercase">
                {{ ucfirst($santri->Status_aksk) }}
            </span>
        </div>
    </div>

    <!-- Statistik Santri (Kartu Info) -->
    <div class="row">
        <!-- Hafalan Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Progress Hafalan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $santri->progressHafalans->count() ?? 0 }} Surah
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book-quran fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konseling Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Sesi Konseling
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $santri->psikologiSantris->count() ?? 0 }} Sesi
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-brain fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pembayaran Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Pembayaran
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp {{ number_format($santri->pembayarans->sum('Jumlah'), 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelas Santri Card (Contoh: Menampilkan Kelas atau Point Pelanggaran) -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Kelas Santri
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $santri->Kelas ?? 'Belum Ditentukan' }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Progress Hafalan Section -->
        <div class="col-lg-6 mb-4">
            {{-- Menggunakan komponen Blade hafalan.blade.php --}}
            @include('components.hafalan', ['santri' => $santri])
        </div>

        <!-- Konseling Psikologi Section -->
        <div class="col-lg-6 mb-4">
           {{-- Menggunakan komponen Blade psikologi.blade.php --}}
           @include('components.psikologi', ['santri' => $santri])
        </div>
    </div>

    <!-- Administrasi Keuangan Section -->
    <div class="row">
        <div class="col-12 mb-4">
           {{-- Menggunakan komponen Blade pembayaran.blade.php --}}
           @include('components.pembayaran', ['santri' => $santri])
        </div>
    </div>
</div>

<!-- Modal Edit Umum (Digunakan untuk Hafalan, Psikologi, Pembayaran) -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white"> {{-- Warna bisa disesuaikan dinamis jika perlu --}}
                <h5 class="modal-title" id="editModalTitle">Edit Data</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm">
                @csrf
                @method('PUT') {{-- Ini akan menjadi hidden input _method --}}
                <input type="hidden" id="edit-id" name="id">
                <input type="hidden" id="edit-type" name="type"> {{-- Untuk identifikasi jenis data (hafalan, psikologi, pembayaran) --}}
                <div class="modal-body" id="editModalBody">
                    {{-- Form fields akan di-inject di sini oleh JavaScript --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Pesan Global (untuk notifikasi sukses/error) --}}
<div class="modal fade" id="globalMessageModal" tabindex="-1" role="dialog" aria-labelledby="globalMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" id="globalMessageModalHeader">
                <h5 class="modal-title" id="globalMessageModalLabel">Pesan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="globalMessageModalBody">
                {{-- Isi pesan akan di-inject di sini --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- Pastikan jQuery dan Bootstrap JS dimuat di layout utama Anda atau di sini --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
{{-- SweetAlert2 untuk konfirmasi hapus dan notifikasi yang lebih baik (opsional) --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk menampilkan modal pesan global (sukses/error)
        function showGlobalMessage(title, message, isSuccess = true) {
            const modalHeader = document.getElementById('globalMessageModalHeader');
            const modalTitle = document.getElementById('globalMessageModalLabel');
            const modalBody = document.getElementById('globalMessageModalBody');

            modalTitle.textContent = title;
            modalBody.textContent = message;

            // Atur warna header modal berdasarkan status (sukses/error)
            if (isSuccess) {
                modalHeader.classList.remove('bg-danger');
                modalHeader.classList.add('bg-success');
            } else {
                modalHeader.classList.remove('bg-success');
                modalHeader.classList.add('bg-danger');
            }

            $('#globalMessageModal').modal('show');
        }

        // --- Fungsi Render Data untuk masing-masing tabel ---

        // Fungsi untuk merender data Hafalan
        function renderHafalans(dataHafalan) {
            const tbody = document.getElementById('hafalan-body');
            tbody.innerHTML = ''; // Kosongkan tbody sebelum mengisi ulang

            if (dataHafalan.length > 0) {
                dataHafalan.forEach(hafalan => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${hafalan.Juz}</td>
                            <td>${hafalan.Surah}</td>
                            <td>${hafalan.Ayat_mulai} - ${hafalan.Ayat_selesai}</td>
                            <td>${new Date(hafalan.Tanggal_setor).toLocaleDateString('id-ID')}</td>
                            <td><span class="badge badge-${hafalan.Status_setor === 'lulus' ? 'success' : 'danger'}">${hafalan.Status_setor}</span></td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-sm btn-info mr-1 edit-btn" data-id="${hafalan.id}" data-type="hafalan">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="${hafalan.id}" data-type="hafalan">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            } else {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4">Belum ada data hafalan.</td></tr>';
            }
        }

        // Fungsi untuk merender data Psikologi
        function renderPsikologi(dataPsikologi) {
            const tbody = document.getElementById('psikologi-body');
            tbody.innerHTML = '';

            if (dataPsikologi.length > 0) {
                dataPsikologi.forEach(psikologi => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${new Date(psikologi.Tanggal_konseling).toLocaleDateString('id-ID')}</td>
                            <td>${psikologi.Hasil_psikologi.substring(0, 50)}${psikologi.Hasil_psikologi.length > 50 ? '...' : ''}</td>
                            <td>${psikologi.pengguna?.Nama_pengguna ?? '-'}</td> {{-- Pastikan relasi 'pengguna' di model PsikologiSantri sudah benar --}}
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-sm btn-info mr-1 edit-btn" data-id="${psikologi.id}" data-type="psikologi">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="${psikologi.id}" data-type="psikologi">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            } else {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted py-4">Belum ada data konseling.</td></tr>';
            }
        }

        // Fungsi untuk merender data Pembayaran
        function renderPembayaran(dataPembayaran) {
            const tbody = document.getElementById('pembayaran-body');
            tbody.innerHTML = '';

            if (dataPembayaran.length > 0) {
                dataPembayaran.forEach(pembayaran => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${pembayaran.Jenis_pembayaran}</td>
                            <td>Rp ${pembayaran.Jumlah.toLocaleString('id-ID')}</td>
                            <td>${new Date(pembayaran.Tanggal_bayar).toLocaleDateString('id-ID')}</td>
                            <td>${pembayaran.Metode_bayar}</td>
                            <td><span class="badge badge-${pembayaran.Status_bayar === 'lunas' ? 'success' : 'warning'}">${pembayaran.Status_bayar}</span></td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-sm btn-info mr-1 edit-btn" data-id="${pembayaran.id}" data-type="pembayaran">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="${pembayaran.id}" data-type="pembayaran">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            } else {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4">Belum ada data pembayaran.</td></tr>';
            }
        }

        // --- Fungsi untuk Mengelola Modal Edit Dinamis ---

        // Fungsi untuk menambahkan/memperbarui modal edit secara dinamis
        function addDynamicEditModals(hafalansData, psikologiSantrisData, pembayaransData) {
            // Hapus modal-modal edit yang sudah ada untuk mencegah duplikasi
            // Penting: Pastikan modal edit yang dibuat dinamis memiliki kelas 'dynamic-edit-modal'
            document.querySelectorAll('.dynamic-edit-modal').forEach(modal => modal.remove());

            // --- Generate Modal Edit Hafalan ---
            hafalansData.forEach(hafalan => {
                const tanggalSetor = hafalan.Tanggal_setor ? new Date(hafalan.Tanggal_setor).toISOString().split('T')[0] : '';
                const modalHtml = `
                    <div class="modal fade dynamic-edit-modal" id="editHafalanModal${hafalan.id}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Edit Hafalan</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editHafalanForm${hafalan.id}" class="edit-form" action="/dashboard/hafalan/${hafalan.id}"> {{-- PERBAIKAN: action --}}
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="Santri_id" value="{{ $santri->id }}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="editJuz${hafalan.id}">Juz</label>
                                            <input type="number" class="form-control" id="editJuz${hafalan.id}" name="Juz" value="${hafalan.Juz}" required min="1" max="30">
                                        </div>
                                        <div class="form-group">
                                            <label for="editSurah${hafalan.id}">Surah</label>
                                            <input type="text" class="form-control" id="editSurah${hafalan.id}" name="Surah" value="${hafalan.Surah}" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="editAyat_mulai${hafalan.id}">Ayat Mulai</label>
                                                    <input type="number" class="form-control" id="editAyat_mulai${hafalan.id}" name="Ayat_mulai" value="${hafalan.Ayat_mulai}" required min="1">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="editAyat_selesai${hafalan.id}">Ayat Selesai</label>
                                                    <input type="number" class="form-control" id="editAyat_selesai${hafalan.id}" name="Ayat_selesai" value="${hafalan.Ayat_selesai}" required min="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="editTanggal_setor${hafalan.id}">Tanggal Setor</label>
                                            <input type="date" class="form-control" id="editTanggal_setor${hafalan.id}" name="Tanggal_setor" value="${tanggalSetor}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editStatus_setor${hafalan.id}">Status</label>
                                            <select class="form-control" id="editStatus_setor${hafalan.id}" name="Status_setor" required>
                                                <option value="lulus" ${hafalan.Status_setor === 'lulus' ? 'selected' : ''}>Lulus</option>
                                                <option value="belum lulus" ${hafalan.Status_setor === 'belum lulus' ? 'selected' : ''}>Belum Lulus</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalHtml);
            });

            // --- Generate Modal Edit Psikologi ---
            psikologiSantrisData.forEach(psikologi => {
                const tanggalKonseling = psikologi.Tanggal_konseling ? new Date(psikologi.Tanggal_konseling).toISOString().split('T')[0] : '';
                const modalHtml = `
                    <div class="modal fade dynamic-edit-modal" id="editPsikologiModal${psikologi.id}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title">Edit Konseling Psikologi</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editPsikologiForm${psikologi.id}" class="edit-form" action="/dashboard/psikologi/${psikologi.id}"> {{-- PERBAIKAN: action --}}
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="Santri_id" value="{{ $santri->id }}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="editTanggal_konseling${psikologi.id}">Tanggal Konseling</label>
                                            <input type="date" class="form-control" id="editTanggal_konseling${psikologi.id}" name="Tanggal_konseling" value="${tanggalKonseling}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editHasil_psikologi${psikologi.id}">Hasil Psikologi</label>
                                            <textarea class="form-control" id="editHasil_psikologi${psikologi.id}" name="Hasil_psikologi" required>${psikologi.Hasil_psikologi}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="editCatatan${psikologi.id}">Catatan Tambahan</label>
                                            <textarea class="form-control" id="editCatatan${psikologi.id}" name="Catatan">${psikologi.Catatan || ''}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalHtml);
            });

            // --- Generate Modal Edit Pembayaran ---
            pembayaransData.forEach(pembayaran => {
                const tanggalBayar = pembayaran.Tanggal_bayar ? new Date(pembayaran.Tanggal_bayar).toISOString().split('T')[0] : '';
                const jatuhTempo = pembayaran.Jatuh_tempo ? new Date(pembayaran.Jatuh_tempo).toISOString().split('T')[0] : '';
                const modalHtml = `
                    <div class="modal fade dynamic-edit-modal" id="editPembayaranModal${pembayaran.id}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title">Edit Pembayaran</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="editPembayaranForm${pembayaran.id}" class="edit-form" action="/dashboard/pembayaran/${pembayaran.id}"> {{-- PERBAIKAN: action --}}
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="Santri_id" value="{{ $santri->id }}">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="editJenis_pembayaran${pembayaran.id}">Jenis Pembayaran</label>
                                            <select class="form-control" id="editJenis_pembayaran${pembayaran.id}" name="Jenis_pembayaran" required>
                                                <option value="SPP Bulanan" ${pembayaran.Jenis_pembayaran === 'SPP Bulanan' ? 'selected' : ''}>SPP Bulanan</option>
                                                <option value="Daftar Ulang" ${pembayaran.Jenis_pembayaran === 'Daftar Ulang' ? 'selected' : ''}>Daftar Ulang</option>
                                                <option value="Seragam" ${pembayaran.Jenis_pembayaran === 'Seragam' ? 'selected' : ''}>Seragam</option>
                                                <option value="Lainnya" ${pembayaran.Jenis_pembayaran === 'Lainnya' ? 'selected' : ''}>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editJumlah${pembayaran.id}">Jumlah</label>
                                            <input type="number" class="form-control" id="editJumlah${pembayaran.id}" name="Jumlah" value="${pembayaran.Jumlah}" required min="0">
                                        </div>
                                        <div class="form-group">
                                            <label for="editTanggal_bayar${pembayaran.id}">Tanggal Bayar</label>
                                            <input type="date" class="form-control" id="editTanggal_bayar${pembayaran.id}" name="Tanggal_bayar" value="${tanggalBayar}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editMetode_bayar${pembayaran.id}">Metode Bayar</label>
                                            <select class="form-control" id="editMetode_bayar${pembayaran.id}" name="Metode_bayar" required>
                                                <option value="Tunai" ${pembayaran.Metode_bayar === 'Tunai' ? 'selected' : ''}>Tunai</option>
                                                <option value="Transfer" ${pembayaran.Metode_bayar === 'Transfer' ? 'selected' : ''}>Transfer</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editStatus_bayar${pembayaran.id}">Status</label>
                                            <select class="form-control" id="editStatus_bayar${pembayaran.id}" name="Status_bayar" required>
                                                <option value="lunas" ${pembayaran.Status_bayar === 'lunas' ? 'selected' : ''}>Lunas</option>
                                                <option value="belum lunas" ${pembayaran.Status_bayar === 'belum lunas' ? 'selected' : ''}>Belum Lunas</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editJatuh_tempo${pembayaran.id}">Jatuh Tempo (jika ada)</label>
                                            <input type="date" class="form-control" id="editJatuh_tempo${pembayaran.id}" name="Jatuh_tempo" value="${jatuhTempo}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                `;
                document.body.insertAdjacentHTML('beforeend', modalHtml);
            });

            // Setelah semua modal baru ditambahkan, lampirkan kembali event listener ke semua form
            attachFormEventListeners();
        }

        // --- Fungsi untuk Melampirkan Event Listener ke Form ---

        // Fungsi untuk melampirkan event listener submit pada form tambah dan edit
        function attachFormEventListeners() {
            // Hapus listener yang sudah ada untuk menghindari duplikasi
            document.querySelectorAll('form.edit-form, form#tambahHafalanForm, form#tambahPsikologiForm, form#tambahPembayaranForm').forEach(form => {
                form.removeEventListener('submit', handleFormSubmit);
            });

            // Tambahkan listener baru
            document.querySelectorAll('form.edit-form, form#tambahHafalanForm, form#tambahPsikologiForm, form#tambahPembayaranForm').forEach(form => {
                form.addEventListener('submit', handleFormSubmit);
            });
        }

        // Handler generik untuk submit form (tambah dan edit)
        async function handleFormSubmit(event) {
            event.preventDefault(); // Mencegah submit form bawaan
            const form = event.target;
            let url = form.action; // Ambil URL dari atribut action form
            let method = form.querySelector('input[name="_method"]')?.value || 'POST'; // Ambil method dari _method hidden input, default POST

            const formData = new FormData(form); // Buat FormData dari form

            try {
                const response = await fetch(url, {
                    method: 'POST', // Selalu POST untuk Laravel dengan _method override
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    let errorMessage = errorData.message || `Gagal menyimpan: ${response.statusText}`;
                    if (errorData.errors) {
                        for (const key in errorData.errors) {
                            errorMessage += `\n- ${errorData.errors[key].join(', ')}`;
                        }
                    }
                    throw new Error(errorMessage);
                }

                const result = await response.json();
                showGlobalMessage('Sukses', result.message || 'Data berhasil disimpan!');
                form.reset(); // Reset form setelah sukses
                // Tutup modal tempat form berada
                $(form.closest('.modal')).modal('hide');
                fetchAndUpdateData(); // Perbarui data setelah operasi sukses
            } catch (error) {
                console.error('Error submitting form:', error); // Log error lebih detail
                showGlobalMessage('Error', error.message || 'Gagal menyimpan data.', false);
            }
        }

        // --- Fungsi Utama untuk Mengambil dan Memperbarui Semua Data ---

        // Fungsi untuk mengambil dan memperbarui semua bagian data
        async function fetchAndUpdateData() {
            const santriId = {{ $santri->id ?? 'null' }};
            if (!santriId) {
                console.error('Santri ID not found.');
                return;
            }

            try {
                // Mengambil semua data dari satu endpoint JSON
                const response = await fetch(`/dashboard/admin/santri/${santriId}/akademik/data-json`, {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) {
                    throw new Error(`Gagal memuat data: ${response.statusText}`);
                }
                const data = await response.json();

                // Render dan update pagination untuk Hafalan
                renderHafalans(data.progressHafalans.data);
                const hafalanPaginationDiv = document.getElementById('pagination');
                const hafalanFooterDiv = document.getElementById('hafalan-footer');
                if (hafalanPaginationDiv && hafalanFooterDiv) {
                    hafalanPaginationDiv.innerHTML = data.progressHafalans.links || '';
                    hafalanFooterDiv.style.display = data.progressHafalans.hasPages ? '' : 'none';
                }

                // Render dan update pagination untuk Psikologi
                renderPsikologi(data.psikologiSantris.data);
                const psikologiPaginationDiv = document.getElementById('psikologi-pagination');
                const psikologiFooterDiv = document.getElementById('psikologi-footer');
                if (psikologiPaginationDiv && psikologiFooterDiv) {
                    psikologiPaginationDiv.innerHTML = data.psikologiSantris.links || '';
                    psikologiFooterDiv.style.display = data.psikologiSantris.hasPages ? '' : 'none';
                }

                // Render dan update pagination untuk Pembayaran
                renderPembayaran(data.pembayarans.data);
                const pembayaranPaginationDiv = document.getElementById('pembayaran-pagination');
                const pembayaranFooterDiv = document.getElementById('pembayaran-footer');
                if (pembayaranPaginationDiv && pembayaranFooterDiv) {
                    pembayaranPaginationDiv.innerHTML = data.pembayarans.links || '';
                    pembayaranFooterDiv.style.display = data.pembayarans.hasPages ? '' : 'none';
                }

                // Panggil untuk membuat dan melampirkan modal edit baru dan event listenernya
                addDynamicEditModals(data.progressHafalans.data, data.psikologiSantris.data, data.pembayarans.data);

            } catch (error) {
                console.error('Error fetching and updating data:', error);
                showGlobalMessage('Error', error.message || 'Gagal memuat data.', false);
            }
        }

        // --- Event Listener untuk Pagination ---

        // Event listener untuk pagination (delegasi event)
        $(document).on('click', '.card-footer a', async function(e) { // Lebih spesifik ke a dalam card-footer
            e.preventDefault();
            const url = $(this).attr('href');
            if (!url) return; // Pastikan URL ada

            const parentFooterId = $(this).closest('.card-footer').attr('id');

            try {
                const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
                if (!response.ok) {
                    throw new Error(`Gagal memuat halaman: ${response.statusText}`);
                }
                const data = await response.json();

                // Perbarui hanya bagian yang relevan
                if (parentFooterId === 'hafalan-footer') {
                    renderHafalans(data.data);
                    $('#pagination').html(data.links || '');
                } else if (parentFooterId === 'psikologi-footer') {
                    renderPsikologi(data.data);
                    $('#psikologi-pagination').html(data.links || '');
                } else if (parentFooterId === 'pembayaran-footer') {
                    renderPembayaran(data.data);
                    $('#pembayaran-pagination').html(data.links || '');
                }
                // Setelah pagination diperbarui, pastikan modal edit juga diperbarui
                fetchAndUpdateData(); // Panggil ulang untuk sinkronisasi penuh
            } catch (error) {
                console.error('Error loading pagination:', error);
                showGlobalMessage('Error', error.message, false);
            }
        });

        // --- Event Listener untuk Tombol Hapus ---

        // Event listener untuk tombol Hapus (delegasi event)
        $(document).on('click', '.delete-btn', function() {
            const id = $(this).data('id');
            const type = $(this).data('type'); // hafalan, pembayaran, psikologi
            let deleteUrl = '';

            if (type === 'hafalan') {
                deleteUrl = `/dashboard/hafalan/${id}`;
            } else if (type === 'pembayaran') {
                deleteUrl = `/dashboard/pembayaran/${id}`;
            } else if (type === 'psikologi') {
                deleteUrl = `/dashboard/psikologi/${id}`;
            }

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(deleteUrl, {
                        method: 'POST', // Akan ditimpa oleh _method('DELETE') di Laravel
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: new FormData() // Kirim FormData kosong jika tidak ada data tambahan
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => { throw new Error(err.message || 'Gagal menghapus data.'); });
                        }
                        return response.json();
                    })
                    .then(data => {
                        showGlobalMessage('Sukses', data.message || 'Data berhasil dihapus!');
                        fetchAndUpdateData(); // Perbarui tabel setelah penghapusan
                    })
                    .catch(error => {
                        console.error('Error deleting data:', error);
                        showGlobalMessage('Error', error.message, false);
                    });
                }
            });
        });

        // --- Inisialisasi Saat Dokumen Dimuat ---

        // Setup awal saat dokumen dimuat
        // Data ini berasal dari controller yang dilewatkan ke view Blade
        const initialHafalans = @json($progressHafalansJson);
        const initialPsikologiSantris = @json($psikologiSantrisJson);
        const initialPembayarans = @json($pembayaransJson);

        // Render data awal
        renderHafalans(initialHafalans.data);
        const hafalanPaginationDivInitial = document.getElementById('pagination');
        const hafalanFooterDivInitial = document.getElementById('hafalan-footer');
        if (hafalanPaginationDivInitial && hafalanFooterDivInitial) {
            hafalanPaginationDivInitial.innerHTML = initialHafalans.links || '';
            hafalanFooterDivInitial.style.display = initialHafalans.hasPages ? '' : 'none';
        }

        renderPsikologi(initialPsikologiSantris.data);
        const psikologiPaginationDivInitial = document.getElementById('psikologi-pagination');
        const psikologiFooterDivInitial = document.getElementById('psikologi-footer');
        if (psikologiPaginationDivInitial && psikologiFooterDivInitial) {
            psikologiPaginationDivInitial.innerHTML = initialPsikologiSantris.links || '';
            psikologiFooterDivInitial.style.display = initialPsikologiSantris.hasPages ? '' : 'none';
        }

        renderPembayaran(initialPembayarans.data);
        const pembayaranPaginationDivInitial = document.getElementById('pembayaran-pagination');
        const pembayaranFooterDivInitial = document.getElementById('pembayaran-footer');
        if (pembayaranPaginationDivInitial && pembayaranFooterDivInitial) {
            pembayaranPaginationDivInitial.innerHTML = initialPembayarans.links || '';
            pembayaranFooterDivInitial.style.display = initialPembayarans.hasPages ? '' : 'none';
        }

        // Panggil ini pertama kali untuk memastikan semua modal edit dinamis dan event listenernya terpasang
        addDynamicEditModals(initialHafalans.data, initialPsikologiSantris.data, initialPembayarans.data);
    });
</script>
@endsection