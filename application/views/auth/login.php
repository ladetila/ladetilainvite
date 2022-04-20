<?php foreach ($hero_image as $hi) : ?>

    <!-- Over -->
    <br><br><br>
    <link rel="icon" type="image/png" href="assets/img/ring.png" />
    <div class="gla_over" data-color="#fffff" data-opacity="0.9"></div>


    <div class="container text-center">
        <p><img src="<?= base_url('wedding-2/'); ?>images/animations/ourwedding.gif" data-bottom-top="@src:<?= base_url('wedding-2/'); ?>images/animations/ourwedding.gif" height="200" alt=""></p>

        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <p> <?= $this->session->flashdata('pesan'); ?></p>
                <form action="<?= base_url('auth'); ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email*</label>
                            <input type="text" name="email" id="email" class="form-control form-opacity">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label>Password*</label>
                            <input type="password" name="password" id="password" class="form-control form-opacity">
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>


                        <div class="col-md-12">
                            <input type="submit" class="btn submit" value="Login">
                            <a href="<?= base_url('/'); ?>" class="btn submit"> Back to Wedding</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <!-- container end -->

    </section>
<?php endforeach; ?>