<?php
switch ($data->wilayah) {
    case 'WIL1':
        $wil = "Wilayah 1";
        break;
    case 'WIL2':
        $wil = "Wilayah 2";
        break;
    case 'WIL3':
        $wil = "Wilayah 3";
        break;
    case 'WIL4':
        $wil = "Wilayah 4";
        break;
        $wil  = null;
        break;
}
?>
<div class="container  mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Download Absensi</h4>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url('PIC/Absensi/download') ?>">
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
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Wilayah</label>
                    <select name="wilayah" class="form-control" id="wilayah">
                        <option value="<?= $data->wilayah ?>"><?= $wil ?></option>
                    </select>
                </div>

                <button class="btn btn-sm btn-primary mt-2">Unduh Absensi</button>
            </form>

        </div>
    </div>
</div>