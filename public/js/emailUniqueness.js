$(function () {
    $('#checkEmailUniqueness').click(function () {

        var $checkEmailButton = $(this);
        var $currentText = $checkEmailButton.html();
        var $loadingText = 'Checking...';
        var $emailAddress = $('#email').val();

        if ($checkEmailButton.html() != $loadingText) {
            if (IsEmail($emailAddress)) {


                $checkEmailButton.html($loadingText);
                $checkEmailButton.removeClass('btn-primary').addClass('btn-default');
                
                $.ajax({
                    url: "/user/checkEmailIsUnique?email=" + $emailAddress,
                    dataType: 'json',
                    cache: false
                }).done(function ($r) {

                    $checkEmailButton.removeClass('btn-default').addClass('btn-primary');
                    $checkEmailButton.html($currentText)

                    if ($r == true) {
                        $('#email').parent().parent().removeClass('alert-danger').removeClass('alert-warning').addClass('alert-success');
                    } else {
                        $('#email').parent().parent().removeClass('alert-success').addClass('alert-danger');
                    }
                });

            } else {
                $('#email').parent().parent().removeClass('alert-success').addClass('alert-danger');
            }

        }
    });


    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
});
