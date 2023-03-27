<div class="container  mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Download Absensi</h4>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url('ARH/Absensi/download') ?>">
                <div class="form-group">
                    <label for="">Tahun</label>
                    <select name="tahun" class="form-control" id="tahun">
                        <?php for ($i = 22; $i < 31; $i++) : ?>
                            <option value="20<?= $i ?>">20<?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Bulan</label>
                    <select name="bulan" class="form-control" id="bulan">
                        <option value="01"><?= strtoupper('Januari') ?></option>
                        <option value="02"><?= strtoupper('Februari') ?></option>
                        <option value="03"><?= strtoupper('Maret') ?></option>
                        <option value="04"><?= strtoupper('April') ?></option>
                        <option value="05"><?= strtoupper('Mei') ?></option>
                        <option value="06"><?= strtoupper('Juni') ?></option>
                        <option value="07"><?= strtoupper('Juli') ?></option>
                        <option value="08"><?= strtoupper('Agustus') ?></option>
                        <option value="09"><?= strtoupper('September') ?></option>
                        <option value="10"><?= strtoupper('Oktober') ?></option>
                        <option value="11"><?= strtoupper('November') ?></option>
                        <option value="12"><?= strtoupper('Desember') ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Wilayah</label>
                    <select name="wilayah" class="form-control" id="wilayah">
                        <option value="WIL1">WILAYAH 1</option>
                        <option value="WIL2">WILAYAH 2</option>
                        <option value="WIL3">WILAYAH 3</option>
                        <option value="WIL4">WILAYAH 4</option>
                    </select>
                </div>

                <button class="btn btn-sm btn-primary mt-2">Unduh Absensi</button>
            </form>

        </div>
    </div>
</div>