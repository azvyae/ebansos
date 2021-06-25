$(function () {
    $("#userIdDaftar").on("keydown", function (e) {
        return e.which !== 32;
    });

    $('#userIdDaftar').on('blur', function () {
        const userId = $(this).val();
        $.ajax({
            url: '/register/getUser',
            data: { userId: userId },
            method: 'post',
            dataType: 'json'
        })
        .done(function (data) {
            if (data > 0) {
                $('#messageUsername').html('Username sudah ada').css('color', 'red');
                $('button:submit').addClass('disabled');
            } else {
                $('#messageUsername').html('');
                $('button:submit').removeClass('disabled');
            }
        })
    });

    $('#password, #passwordVerify').on('keyup', function () {
        if ($('#password').val().length >= 8) {
            if ($('#password').val() == $('#passwordVerify').val()) {
                $('#message').html('Password Sama!').css('color', 'green');
            } else {
                $('#message').html('Password Berbeda!').css('color', 'red');
            }
        } else {
            $('#message').html('Minimal 8 karakter').css('color', 'red');
        }
    });

    $('.pilih-semua').change('click', function() {
        if($(this).is(':checked')) {
            $('.tabel-check').prop('checked', true);
        } else {
            $('.tabel-check').prop('checked', false);
        }
        
    })
    $('.tabel-check').change('click', function () {
        if($('.tabel-check:checked').length < $('.tabel-check').length) {
            $('.pilih-semua').prop('checked', false)
        } else {
            $('.pilih-semua').prop('checked', true)
        }

    })
    $('input[type=checkbox]').change('click', function() {
        console.log($('input[type=checkbox]:checked').length )
        if($('input[type=checkbox]:checked').length > 0) {
            $('#tombolHapus').removeClass('disabled');
        } else {
            $('#tombolHapus').addClass('disabled');
        }
    })
})