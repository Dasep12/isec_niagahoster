 <select style="margin-bottom: 5px;width:100%" class="form-control text-dark" name="titik" id="titik_lokasi" is="ms-dropdown">
     <?php foreach ($data->result() as $tk) : ?>
         <?php if ($tk->status == 0) { ?>
             <option data-image="https://img.icons8.com/emoji/20/000000/red-circle-emoji.png" value="<?= $tk->id ?>"> <?= $tk->lokasi ?> </option>
         <?php } else { ?>
             <option data-image="<?= base_url('assets/img') ?>/enabled.gif" value="<?= $tk->id ?>"> <?= $tk->lokasi ?> </option>
         <?php } ?>
     <?php endforeach ?>
 </select>


 <?php if ($terlewati->num_rows() == $data->num_rows()) { ?>
     <a id="infoUpdate" data-refresh="<?= base_url('Ipatrol/Patrolv2') ?>" data-url="<?= base_url("Ipatrol/Patrolv2/updateStatus/") ?>" href='javascript:reset()' class="btn btn-sm btn-danger">
         Kirim Hasil Patroli
     </a>
 <?php } else { ?>
     <!--<label class="text-danger small"><i><?= $terlewati->num_rows() . " titik sudah dilewati" ?></i></label>-->
 <?php } ?>