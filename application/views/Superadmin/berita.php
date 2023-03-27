<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

<div class="row mb-3 g-3">
       <div class="col-lg-12 col-xxl-9">
              <div class="card mb-3 d-flex align-items-content-start">
                  <div class="card-header pb-0 d-flex justify-content-between">
                    <h6 class="mb-0 mt-2 d-flex align-items-center">Daftar Berita</h6>
                </div>
                <div class="card-body d-flex justify-content-center"> 
                    <div class="table-responsive scrollbar">
                        <table id="Berita" class="table table-hover " >
                                 <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Headline</th>
                                        <th>Kategori</th>
                                        <th>Tanggal berita</th>
                                        <th>Sumber</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                <?php
                                        $i = 1;
                                        foreach($Berita as $Berita) : ?>
                                        <tr>
                                                <td class="text-left"><?= $i ?></td>
                                                <td class="text-left"><?= $Berita->headline ?></td>
                                                <td class="text-left"><?= $Berita->kategori?></td>
                                                <td class="text-left"><?= $Berita->tanggalberita?></td>
                                                <td class="text-left"><?= $Berita->sumber?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                       endforeach ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>    
</div>

 <script type="text/javascript">
        $(document).ready(function () {
        $('#Berita').DataTable();
        });
   </script>
