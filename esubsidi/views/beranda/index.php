<div class="container">
    <div class="p-5 mb-4 bg-light rounded-32 mt-4 my-auto h-100 ">
        <div class="container py-5">
            <h1 class="display-5 text-center fw-bold">Data Penerima Subsidi</h1>
            <p class="fs-4 text-center">Masukkan NIK dan tanggal lahir anda, lalu tekan tombol konfirmasi untuk mengetahui apakah warga tersebut sudah terdata atau tidak.</p>
            <div class="row">

                <form action="javascript:void(0);" class="col col-md-6 mx-auto">
                    <div class="my-3">
                        <label for="nik" class="form-label fw-bold">Nomor Induk Kependudukan</label>
                        <input type="text" autocomplete="off" class="form-control" id="nik" name='nik' placeholder="3273000011110000" minlength="16" maxlength="16" required>
                    </div>
                    <div class="my-3 datepicker">
                        <label for="tanggalLahir" class="form-label fw-bold">Tanggal Lahir</label>
                        <input required min="1900-01-01" max="<?= date("Y-m-d"); ?>" class="form-control input-groupinput-group-addon" id="tanggalLahir" name="tanggalLahir" placeholder="" type="date" />
                    </div>
                    <div class="mx-auto">
                        <button type="submit" class="checkButton btn mx-auto w-100 btn-primary btn-lg btn-ripple">Periksa Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>