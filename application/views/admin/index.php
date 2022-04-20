<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->




    <hr class="sidebar-divider">

    <h3><?= $title5; ?></h3>
    <div class="row">

        <div class="card-body">
            <div class="table-responsive table-hover">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <?= $this->session->flashdata('pesan'); ?>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tamu</th>
                            <th>Alamat</th>
                            <th>Hadir/Tidak</th>
                            <th>No Handphone</th>
                            <th>Ucapan</th>
                        </tr>
                    <tbody>
                        <div hidden>
                            <?= $i = 1; ?>
                        </div>
                        <?php foreach ($rsvp as $rs) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $rs['nama']; ?></td>
                                <td><?= $rs['alamat']; ?></td>
                                <td><?= $rs['hadir_tidak']; ?></td>
                                <td><?= $rs['no_hp']; ?></td>
                                <td><?= $rs['ucapan']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->