<div class="row">
    <div class="col-lg-10">
        <div class="p-5">
            <div class="text-left">
                <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
            </div>
            <form method="POST" action="<?= base_url('admin/edit_thanks/') . $banner_utama['id']; ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $banner_utama['id']; ?>">
                <div class="form-group">
                    <label for="nama">Nama Gambar</label>
                    <input type="text" class="form-control form-control-user" id="nama" name="nama" value="<?= $banner_utama['nama']; ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="link">Text</label>
                    <input type="text" class="form-control form-control-user" id="link" name="link" value="<?= $banner_utama['link']; ?>">
                    <?= form_error('link', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Gambar</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('/wedding-2/images/wedding/wedding-1/thanks/') . $banner_utama['image']; ?>" class="img-thumbnail" alt="">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">
                                        Pilih Gambar
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-sm btn-info text-decoration-none" href="<?= base_url('admin/thanks') ?>">Back</a>
                <button type="submit" class="btn btn-sm btn-success my-3">
                    Save
                </button>
            </form>
        </div>
    </div>
</div>