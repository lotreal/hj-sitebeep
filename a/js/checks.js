$(document).ready(function(){
    $(".aj_check_status_list").load("/aj_elements/aj_check_status_list");

    $.get('/a/sensor.php?t=json', function(data) {
        console.log(data);
    });
});
