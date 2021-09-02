//Open and close menu
$("#menu-toggle").click( function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("menuDispalyed");
});

$(document).ready(function(){
    $("#users").click(function() {
        $("#production").load("modules/user/displayUser.php");
    });
});

$(document).ready(function(){
    $("#clients").click(function() {
        $("#production").load("modules/client/displayClient.php");
    });
});

$(document).ready(function(){
    $("#notification").click(function(){
        $("#production").load("modules/notifications/displayNotification.php");
    });
});

$(document).ready(function(){
    $("#clientsNotification").click(function(){
        $("#production").load("modules/events/displayEvent.php");
    });
});
