function siapkanHalaman(q = '', tipeAkun = null) {
    var top = '';
    $.ajax({
        url: '/admin/getHalaman',
        data: {
            tipeAkun: tipeAkun,
            q: q
        },
        method: 'post',
        dataType: 'json'
    })
        .done(function (data) {
            top = bot = '';
            $('#halaman').empty();
            bot += `<option selected value="1">1</option>`
            for (let i = 2; i <= Math.ceil(data / 10); i++) {
                bot += `<option value="` + i + `"> ` + i + `</option>`
            }
            $('#halaman').prepend(top + bot);
            periksaChecklist();
            cekStatusKonfirmasi();

        })
}

function tampilkanTabelUser(q = '', tipeAkunParams = null, halaman = 1, init = 0) {
    if ($('#loading').is(':empty')) {

        $('#loading').prepend(
            `<div class="spinner-border text-primary mt-3" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>`
        );
    }
    var top = mid = bot = tipeAkunTampilan = checked = '';
    $.ajax({
        url: '/admin/getDataTabelUser',
        data: {
            q: q,
            tipeAkun: tipeAkunParams,
            halaman: halaman
        },
        method: 'post',
        dataType: 'json'
    })
        .done(function (data) {
            if (data.length > 0) {
                top = `<table class='table table-striped overflow-auto'>
                <thead>
                    <tr>
                        <th scope='col' style='min-width:2.68%; max-width:2.68%; width:2.68%;'><input class='form-check-input pilih-semua usercheckbox' type='checkbox'></th>
                        <th scope='col' style='min-width:18%; max-width:18%; width:18%;'>User ID</th>
                        <th scope='col' style='min-width:30%; max-width:30%; width:30%;'>Nama</th>
                        <th scope='col' style='min-width:39.82%; max-width:39.82%; width:39.82%;'>Jenis Akun</th>
                        <th scope='col' style='min-width:9.5%; max-width:9.5%; width:9.5%;'>Aktif</th>
                    </tr>
                </thead>
                <tbody>`;
                $.each(data, function (i, data) {
                    switch (data.tipeAkun) {
                        case '0':
                            tipeAkunTampilan = 'Pendaftar';
                            break;
                        case '1':
                            tipeAkunTampilan = 'Petugas RT';
                            break;
                        case '2':
                            tipeAkunTampilan = 'Petugas RW';
                            break;
                        case '3':
                            tipeAkunTampilan = 'Petugas Kelurahan/Khusus';
                            break;
                        case '4':
                            tipeAkunTampilan = 'Petugas Pemrosesan Subsidi';
                            break;
                        default:
                            tipeAkunTampilan = 'Pendaftar';
                            break;
                    }
                    switch (data.statusKonfirmasi) {
                        case '1':
                            checked = 'checked';
                            break;
                        default:
                            checked = '';
                            break;
                    }
                    mid += `<tr class='align-middle'>
                            <th scope='row'><input class='form-check-input tabel-check usercheckbox' type='checkbox' value='` + data.userId + `' name='user[]'></th>
                            <td>` + data.userId + `</td>
                            <td>` + data.nama + `</td>
                            <td>` + tipeAkunTampilan + `</td>
                            <td class='text-center'>
                            <span class='form-check form-switch'>
                                <input class="form-check-input statusKonfirmasi" ` + checked + ` value='` + data.userId + `' type="checkbox">
                            </span>
                            </td>
                            </tr >`
                })
                bot = `</tbody >
        </table >`;
                $('#message').addClass('hidden')
                $('#message').empty();
                if (init == 0) {
                    $('#tabel-container').append(top + mid + bot);
                } else {
                    $('tbody').html(mid);
                }
                $('#tabel-container').prop('hidden', false)
            } else {
                bot = `<p class='display-6 mt-5'>Tidak ada data</p>`
                $('#tabel-container').prop('hidden', true)
                $('tbody').html('');
                $('#message').empty();
                $('#message').append(bot);
                $('#message').removeClass('hidden')
            }
            $('#loading').empty()
            periksaChecklist();
            cekStatusKonfirmasi();
        })
}

function periksaChecklist() {
    $('input[type=checkbox].usercheckbox').prop('checked', false);
    $('#tombolHapus').attr('disabled', true);
    if ($('input[type=checkbox].usercheckbox').length == 1) {
        $('.pilih-semua').attr('disabled', true);
    } else {
        $('.pilih-semua').removeAttr('disabled');
    }

    $('.pilih-semua').change('click', function () {
        if ($(this).is(':checked')) {
            $('.tabel-check').prop('checked', true);
        } else {
            $('.tabel-check').prop('checked', false);
        }

    })
    $('.tabel-check').change('click', function () {
        if ($('.tabel-check:checked').length < $('.tabel-check').length) {
            $('.pilih-semua').prop('checked', false)
        } else {
            $('.pilih-semua').prop('checked', true)
        }

    })
    $('input[type=checkbox].usercheckbox').change('click', function () {
        if ($('input[type=checkbox].usercheckbox:checked').length > 0) {
            $('#tombolHapus').removeAttr('disabled');
        } else {
            $('#tombolHapus').attr('disabled', true);
        }
    })


}

function cekStatusKonfirmasi() {
    $('.statusKonfirmasi').change('click', function () {
        const userId = $(this).val()
        const toggle = $(this).prop('checked')
        $.ajax({
            url: '/admin/konfirmasiUser',
            data: {
                userId: userId,
                toggle: toggle
            },
            method: 'post'
        })
    })
}
function tampilkanFormPetugasRT() {
    const location = window.location.href
    var options = ''
    $.ajax({
        url: '/admin/getRW',
        data: {
            location: location
        },
        method: 'post',
        dataType: 'json'
    })
        .done(function (data) {
            $.each(data, function (i, data) {
                options += `<option value="` + data.rw + `">RW 0` + data.rw + `</option>`
            })
            $('#judulModal').html('Tambahkan Petugas RT');
            $('.modal-content form').attr('action', 'admin/generateRT')
            $('#isianInput').html(`
                    <div class="mb-3">
                        <label for="nomorRW" class="form-label">Nomor RW</label>
                        <select required class="form-select" id='nomorRW' name='nomorRW' aria-label="Nomor RW">
                            <option disabled value selected>Pilih Nomor RW</option>` +
                options
                + `</select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlahRT" class="form-label">Jumlah Petugas RT</label>
                        <input required class="form-control input-groupinput-group-addon" id="jumlahRT" name="jumlahRT" autocomplete="off" placeholder="Jumlah RT" maxlength="3" min="1" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" />
                    </div>`);
        })
}

function tampilkanFormPetugasRW() {
    $('#judulModal').html('Tambahkan Petugas RW');
    $('.modal-content form').attr('action', 'admin/generateRW')
    $('#isianInput').html(`
                    <div class="mb-3">
                        <label for="jumlahRW" class="form-label">Jumlah Petugas RW</label>
                        <input required class="form-control input-groupinput-group-addon" id="jumlahRW" name="jumlahRW" autocomplete="off" placeholder="Jumlah RW" maxlength="3" min="1" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" />
                    </div>
        `);
}

function tampilkanFormPetugasSubsidi() {
    $('#judulModal').html('Tambahkan Petugas Subsidi');
    $('.modal-content form').attr('action', 'admin/generateSubsidi')
    $('#isianInput').html(`
        <div class="my-3 row">
            <div class="col-sm-12 mb-3">
                <label for="namaSubsidi" class="form-label fw-bold">Nama Subsidi</label>
                <input type="text" autocomplete="off" class="form-control" id="namaSubsidi" name='namaSubsidi' placeholder="Subsidi ABC" required>
            </div>
        </div>`);

}

$(function () {
    $("#aktifkanRegistrasi").on('change', function () {
        setTimeout(function () {
            $("#updateStatusRegistrasi").submit();
        }, 250)
    })

    $('.generateRW').on('click', function () {
        tampilkanFormPetugasRW();
    })

    $('.generateRT').on('click', function () {
        tampilkanFormPetugasRT();
    })

    $('.generateSubsidi').on('click', function () {
        tampilkanFormPetugasSubsidi();
    })


    siapkanHalaman();
    tampilkanTabelUser();

    $('#tipeAkun').on('change', function () {
        $('#tabel-container').prop('hidden', true)
        siapkanHalaman($('#cari').val(), $('#tipeAkun').val());
        $('#cari').val('')
        $('#halaman').val(1)
        tampilkanTabelUser($('#cari').val(), $('#tipeAkun').val(), $('#halaman').val(), 1);
    });

    $('#halaman').on('change', function () {
        $('#tabel-container').prop('hidden', true)
        $('#cari').val('')
        tampilkanTabelUser($('#cari').val(), $('#tipeAkun').val(), $('#halaman').val(), 1);
    });

    $('#cari').on('keyup', function () {
        siapkanHalaman($('#cari').val(), $('#tipeAkun').val());
        $('#halaman').val(1)
        tampilkanTabelUser($('#cari').val(), $('#tipeAkun').val(), $('#halaman').val(), 1);
    })
});