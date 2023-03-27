    <div class="table-responsive mt-3">
        <table class="table table-small table-striped small">
            <thead>
                <tr>
                    <th>TANGGAL</th>
                    <th>IN</th>
                    <th>OUT</th>
                    <th>IN OT</th>
                    <th>OUT OT</th>
                    <th>KETERANGAN</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            $t = new Grei\TanggalMerah();
            $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            for ($i = 1; $i < $tanggal + 1; $i++) {
                if ($i < 9) {
                    $i = "0" . $i;
                } else {
                    $i;
                }
                $d = $tahun . "-" . $bulan . "-" . $i; ?>
                <tr>
                    <td><?= $d ?></td>
                    <?php
                    $dr = $tahun . '-' . $bulan . '-' . $i;
                    $cek = $this->db->get_where($tabel, ['in_date' => $dr, 'npk' => $npk]);
                    if ($cek->num_rows() > 0) {
                        foreach ($cek->result() as $r) {
                            echo "<td>" . $r->in_time . "</td>";
                            echo "<td>" . $r->out_time . "</td>";
                            echo "<td>" . $r->over_time_start . "</td>";
                            echo "<td>" . $r->over_time_end . "</td>";
                            echo "<td>" . $r->ket . "</td>";
                        }
                    } else {
                        echo "<td>  </td>";
                        echo "<td>  </td>";
                        echo "<td>  </td>";
                        echo "<td>  </td>";
                        echo "<td>  </td>";
                        echo "<td>  </td>";
                    }
                    ?>
                </tr>
            <?php }
            ?>
        </table>
    </div>