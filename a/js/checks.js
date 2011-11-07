$(document).ready(function(){
    $(".aj_check_status_list").load("/aj_elements/aj_check_status_list");
    $.get('/a/sensor.php?u=http%3A%2F%2Fwww.hj.com&s=sensor01&c=check01&t=json', function(data) {
        console.log(data);
    });
});
