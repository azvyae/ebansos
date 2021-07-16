<div id='wadahTabel' style='width: 50%;' class="container position-relative">
    <h1 id='cetakTabel' class='fs-5'>Cetak Tabel Pengguna</h1>
    <p class='fs-6'>Petugas :</p>
    <table class="table table-striped table-bordered table-sm">
        <thead>
            <tr>
                <th scope="col" class='text-center'>#</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data['arrayData'] as $d) : ?>
                <tr>
                    <th scope="row" class='text-center'><?= $i++ ?></th>
                    <td><?= $d['nama'] ?></td>
                    <td><?= $d['userId'] ?></td>
                    <td><?= $d['password'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button type="button" id='cetak' class="btn btn-primary">Cetak</button>
</div>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) {
        $('#cetak').on('click', function() {
            window.print()
            setTimeout(function() {
                window.location.href = '<?= BASEURL ?>/admin'
            }, 1000)


        })
    })
</script>