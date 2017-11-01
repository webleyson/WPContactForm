jQuery(function($) {
    /* You can safely use $ in this code block to reference jQuery */

    $('#submit').click(function(e) {
        e.preventDefault();
        $('.error').empty();
        $errors = false;
        $('#contactForm .required').each(function(k, v) {
            if (this.value == "") {
                $(this).next('.error').html("<p class='bg-danger text-center'>This is a required field</p>");
                $errors = true;
            }
        })
        if ($errors == false) {
            var spinner = '<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>';

            $('.spinner').append(spinner);
            $.ajax({
                type: "POST",
                url: "/wp-content/plugins/WPContactForm/sendContact.php",
                data: $('#contactForm').serialize(),
                success: function(data) {
                    if (data.status === "success") {
                        $('#contactForm').slideUp().after("Message Sent!  One of our team will be in touch soon.");
                    } else {
                        $('.emailResponse').html('<p class="bg-success">There is a problem sending your email.</p>' + data.message + '.</p>');
                    }
                }
            });
        }
    })
    document.getElementById("submit").disabled = true;


});

function enableBtn() {
    document.getElementById("submit").disabled = false;
}