$(function () {
    function periksaChecklist() {
        $('input[type=checkbox]').prop('checked', false);
        $('#tombolHapus').addClass('disabled');

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
        $('input[type=checkbox]').change('click', function () {
            if ($('input[type=checkbox]:checked').length > 0) {
                $('#tombolHapus').removeClass('disabled');
            } else {
                $('#tombolHapus').addClass('disabled');
            }
        })
    }

    function tampilkanTabel(q = '') {
        var header = '';
        var rows = '';
        var footer = '';
        $.ajax({

            url: '/beranda/getDataTabel',
            data: { q: q },
            method: 'post',
            dataType: 'json'
        }).done(function (data) {
            if (data.length > 0) {
                header = `<table class='table table-striped overflow-auto'>
                            <thead>
                                <tr>
                                    <th scope='col' style='min-width:2.68%; max-width:2.68%; width:2.68%;'><input class='form-check-input pilih-semua' type='checkbox'></th>
                                    <th scope='col' style='min-width:15%; max-width:15%; width:15%;'>NIK</th>
                                    <th scope='col' style='min-width:21%; max-width:21%; width:21%;'>Nama</th>
                                    <th scope='col' style='min-width:51.82%; max-width:51.82%; width:51.82%;'>Alamat</th>
                                    <th scope='col' style='min-width:9.5%; max-width:9.5%; width:9.5%;'>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>`;
                $.each(data, function (i, data) {
                    rows += `<tr class='align-middle'>
                            <th scope='row'><input class='form-check-input tabel-check' type='checkbox' value='` + data.hashId + `' name='penduduk'></th>
                            <td>` + data.nik + `</td>
                            <td>` + data.nama + `</td>
                            <td>` + data.alamatRumah + `</td>
                            <td class='text-center'>
                                <a class=' link-primary text-decoration-none fw-bold' href='`+ baseurl + `/beranda/detail/penduduk?=` + data.hashId + `'>Detail</a>
                                <a class=' link-dark text-decoration-none fw-bold' href='`+ baseurl + `/beranda/ubah/penduduk?=` + data.hashId + `'>Ubah</a>
                            </td>
                            </tr >`
                })
                footer = `</tbody >
                    </table >`;
            } else {
                header = `<table class='table table-striped overflow-auto'>
                            <thead>
                                <tr>
                                    <th scope='col'><input class='form-check-input pilih-semua' disabled type='checkbox'></th>
                                    <th scope='col'>NIK</th>
                                    <th scope='col'>Nama</th>
                                    <th scope='col'>Alamat</th>
                                    <th scope='col'>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>`
                rows = `</tbody ></table >`;
                footer = `<p class='display-6 mt-5'>Tidak ada data</p>`;
            }


            $('.tabel-container').append(header + rows + footer);
            periksaChecklist();
        })
    }

    function gantiTabel(q) {
        var rows = '';
        $.ajax({

            url: '/beranda/getDataTabel',
            data: { q: q },
            method: 'post',
            dataType: 'json'
        }).done(function (data) {
            if (data.length > 0) {
                $.each(data, function (i, data) {
                    rows += `<tr class='align-middle'>
                            <th scope='row'><input class='form-check-input tabel-check' type='checkbox' value='` + data.hashId + `' name='penduduk'></th>
                            <td>` + data.nik + `</td>
                            <td>` + data.nama + `</td>
                            <td>` + data.alamatRumah + `</td>
                            <td class='text-center'>
                                <a class=' link-dark text-decoration-none fw-bold' href='`+ baseurl + `/beranda/ubah/penduduk?=` + data.hashId + `'>Ubah</a>
                                <a class=' link-primary text-decoration-none fw-bold' href='`+ baseurl + `/beranda/detail/penduduk?=` + data.hashId + `'>Detail</a>
                            </td>
                            </tr >`
                })
                $('#message').empty();
                $('tbody').html(rows);
            } else {
                rows = `<p class='display-6 mt-5'>Tidak ada data</p>`;
                $('tbody').html('');
                $('#message').empty();
                $('#message').append(rows);
            }
            periksaChecklist();
        })
            .fail(function () {
                $('.tabel-container').append(
                    `<p class='display-6 mt-5'>Tidak ada data</p>`);
            });
    }

    tampilkanTabel();

    $('#cari').on('keyup', function () {
        gantiTabel($('#cari').val());
    })
});