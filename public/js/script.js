// $(function () {
//     $('.checkButton').on('click', function () {
//         if ($('#nik').val() != "" && $('#nik').val().length == 16 && !!$('#tanggalLahir').val()) {
//             const nik = $('#nik').val();
//             const tanggalLahir = $('#tanggalLahir').val();

//             $.ajax({
//                 url: '/beranda/cekData',
//                 data: {
//                     nik: nik,
//                     tanggalLahir: tanggalLahir
//                 },
//                 type: 'POST',
//                 success: function (data) {
//                     console.log(data);
//                 }
//             });
//         }

//     });

// });