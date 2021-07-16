$(function() {
    $("#periksaData").on("click", function() {
        $('form').attr('action', 'beranda/cekdata')
    });

    $("#tambahBansos").on("click", function() {
        $('form').attr('action', 'beranda/tambahbansos')
        if ($('#nik').val() && $('#hari').val() && $('#bulan').val() && $('#tahun').val()) {
            confirm('Validasi penerimaan bansos untuk peserta bansos tersebut?')
        }
    });

})