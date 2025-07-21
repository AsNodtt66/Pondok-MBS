<div class="card shadow-sm mb-4">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 font-weight-bold">Konseling Psikologi</h6>
        <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#tambahPsikologiModal">
            <i class="fas fa-plus mr-1"></i> Tambah
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="bg-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Hasil</th>
                        <th>Konselor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="psikologi-body">
                    {{-- Data akan diisi oleh JavaScript --}}
                </tbody>
            </table>
        </div>
        <div class="card-footer" id="psikologi-footer">
            <div id="psikologi-pagination"></div>
        </div>

        <!-- Modal Tambah Konseling Psikologi -->
        <div class="modal fade" id="tambahPsikologiModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Tambah Konseling Psikologi</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="tambahPsikologiForm" action="/dashboard/psikologi"> {{-- PERBAIKAN: action="/dashboard/psikologi" --}}
                        @csrf
                        <input type="hidden" name="Santri_id" value="{{ $santri->id ?? '' }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Tanggal_konseling">Tanggal Konseling</label>
                                <input type="date" class="form-control" id="Tanggal_konseling" name="Tanggal_konseling" value="{{ now()->format('Y-m-d') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="Hasil_psikologi">Hasil Psikologi</label>
                                <textarea class="form-control" id="Hasil_psikologi" name="Hasil_psikologi" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Catatan">Catatan Tambahan</label>
                                <textarea class="form-control" id="Catatan" name="Catatan"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>