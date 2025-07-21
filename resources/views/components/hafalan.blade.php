<div class="card shadow-sm mb-4">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 font-weight-bold">Progress Hafalan</h6>
        <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#tambahHafalanModal">
            <i class="fas fa-plus mr-1"></i> Tambah
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="bg-light">
                    <tr>
                        <th>Juz</th>
                        <th>Surah</th>
                        <th>Ayat</th>
                        <th>Tanggal Setor</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="hafalan-body">
                    {{-- Data akan diisi oleh JavaScript --}}
                </tbody>
            </table>
        </div>
        <div class="card-footer" id="hafalan-footer">
            <div id="pagination"></div>
        </div>

        <!-- Modal Tambah Hafalan -->
        <div class="modal fade" id="tambahHafalanModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tambah Hafalan</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="tambahHafalanForm" action="/dashboard/hafalan"> {{-- PERBAIKAN: action="/dashboard/hafalan" --}}
                        @csrf
                        <input type="hidden" name="Santri_id" value="{{ $santri->id ?? '' }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Juz">Juz</label>
                                <input type="number" class="form-control" name="Juz" required min="1" max="30">
                            </div>
                            <div class="form-group">
                                <label for="Surah">Surah</label>
                                <input type="text" class="form-control" name="Surah" required>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Ayat_mulai">Ayat Mulai</label>
                                        <input type="number" class="form-control" name="Ayat_mulai" required min="1">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="Ayat_selesai">Ayat Selesai</label>
                                        <input type="number" class="form-control" name="Ayat_selesai" required min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Tanggal_setor">Tanggal Setor</label>
                                <input type="date" class="form-control" name="Tanggal_setor" required>
                            </div>
                            <div class="form-group">
                                <label for="Status_setor">Status</label>
                                <select class="form-control" name="Status_setor" required>
                                    <option value="lulus">Lulus</option>
                                    <option value="belum lulus">Belum Lulus</option>
                                </select>
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