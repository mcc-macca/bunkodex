$(document).ready(function() {
    $('#test-db-btn').on('click', function() {
        var data = $('#db-form').serialize();
        console.log(data);
        $.ajax({
            type: 'POST',
            url: 'test_db_connection.php',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    document.getElementById("info").innerHTML = "Database connection successful!";
                    document.getElementById("info").style.color = "lime";
                    $('#submit-btn').show();
                    $('#test-db-btn').hide();
                } else {
                    document.getElementById("info").innerHTML = "Error connecting to database";
                    document.getElementById("info").style.color = "red";
                }
            },
            error: function(xhr, status, error) {
                document.getElementById("info").innerHTML = "Error connecting to database";
                document.getElementById("info").style.color = "red";
            }
        });
    });
});

console.log("%cBunkoDEX INSTALLATION - MACCA COMPUTER", "color: lime");