<div class="container  mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Download Absensi</h4>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url('SPV/Absensi/download') ?>">
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
                        <?php for ($i = 0; $i < count($data); $i++) : ?>
                            <option value="<?= $data[$i] ?>">
                                <?php
                                if ($data[$i] == "WIL1") {
                                    echo "WILAYAH 1";
                                } else if ($data[$i] == "WIL2") {
                                    echo "WILAYAH 2";
                                } else if ($data[$i] == "WIL3") {
                                    echo "WILAYAH 3";
                                } else if ($data[$i] == "WIL4") {
                                    echo "WILAYAH 4";
                                }
                                ?></option>
                        <?php endfor ?>
                    </select>
                </div>

                <button class="btn btn-sm btn-primary mt-2">Unduh Absensi</button>
            </form>

        </div>
    </div>
</div>