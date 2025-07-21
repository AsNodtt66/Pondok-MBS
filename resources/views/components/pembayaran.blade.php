<div class="card shadow-sm mb-4">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 font-weight-bold">Administrasi Keuangan</h6>
        <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#tambahPembayaranModal">
            <i class="fas fa-plus mr-1"></i> Tambah
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="bg-light">
                    <tr>
                        <th>Jenis Pembayaran</th>
                        <th>Jumlah</th>
                        <th>Tanggal Bayar</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="pembayaran-body">
                    {{-- Data akan diisi oleh JavaScript --}}
                </tbody>
            </table>
        </div>
        <div class="card-footer" id="pembayaran-footer">
            <div id="pembayaran-pagination"></div>
        </div>

        <!-- Modal Tambah Pembayaran -->
        <div class="modal fade" id="tambahPembayaranModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">Tambah Pembayaran</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="tambahPembayaranForm" action="/dashboard/pembayaran"> {{-- PERBAIKAN: action="/dashboard/pembayaran" --}}
                        @csrf
                        <input type="hidden" name="Santri_id" value="{{ $santri->id ?? '' }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Jenis_pembayaran">Jenis Pembayaran</label>
                                <input type="text" class="form-control" id="Jenis_pembayaran" name="Jenis_pembayaran" required>
                            </div>
                            <div class="form-group">
                                <label for="Jumlah">Jumlah</label>
                                <input type="number" class="form-control" id="Jumlah" name="Jumlah" required min="0">
                            </div>
                            <div class="form-group">
                                <label for="Tanggal_bayar">Tanggal Bayar</label>
                                <input type="date" class="form-control" id="Tanggal_bayar" name="Tanggal_bayar" required>
                            </div>
                            <div class="form-group">
                                <label for="Metode_bayar">Metode Bayar</label>
                                <select class="form-control" id="Metode_bayar" name="Metode_bayar" required>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Status_bayar">Status</label>
                                <select class="form-control" id="Status_bayar" name="Status_bayar" required>
                                    <option value="lunas">Lunas</option>
                                    <option value="belum lunas">Belum Lunas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Jatuh_tempo">Jatuh Tempo (jika ada)</label>
                                <input type="date" class="form-control" id="Jatuh_tempo" name="Jatuh_tempo">
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