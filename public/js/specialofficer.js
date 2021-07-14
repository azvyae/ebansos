$(function() {
    $("#periksaData").on("click", function() {
        $('form').attr('action', 'beranda/cekdata')
    });

    $("#tambahSubsidi").on("click", function() {
        $('form').attr('action', 'beranda/tambahsubsidi')
        if ($('#nik').val() && $('#hari').val() && $('#bulan').val() && $('#tahun').val()) {
            confirm('Validasi penerimaan subsidi untuk peserta subsidi tersebut?')
        }
    });

})