    <div class="container">
        <div class="content mt-5">
            <?php if ($this->session->flashdata('info')) { ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('info')  ?>
                    <?php $this->session->unset_userdata("info") ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php  } else if ($this->session->flashdata('fail')) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('fail') ?>
                    <?php $this->session->unset_userdata("fail") ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-header">
                    <h4>Upload Data</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('SA/Crime/post') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Upload File</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary">Upload </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>