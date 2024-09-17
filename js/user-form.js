$("#btn-login").click(function(event){
    event.preventDefault();
    if(!$("#id").val() || !$("#password").val()) {
        return;
    }
    login($("#id").val(), $("#password").val());
});

function login(id, password) {
    var data = {
        id: id,
        password: password
    };
    $.ajax({
        type: "POST",
        url: './util/login.php',
        data: data,
        success: function(response) {
            var jsonData = JSON.parse(response);
            if(jsonData.success) {
                if("admin" == jsonData.user_type) {
                    location.href = './admin';
                } else {
                    location.href = './user';
                }
            } else {
                alert("Login fail!");
            }
       }
   });
}

$("#btn-regirstartion").click(function(event){

    event.preventDefault();
    if(!$("#email").val() ||
       !$("#reg_id").val() ||
       !$("#password").val() ||
       !$("#nick_name").val() ||
       !$("#gender").val() ||
       !$("#birthday").val()) {
        alert("Please enter all information!");
        return;
    }

    if(!confirm("Are you sure to register an account?")) {
        return;
    }

    var data = {
        email: $("#email").val(),
        id: $("#reg_id").val(),
        password: $("#password").val(),
        nick_name: $("#nick_name").val(),
        gender: $("#gender").val(),
        birthday: $("#birthday").val()
    };

    $.ajax({
        type: "POST",
        url: './util/register.php',
        data: data,
        success: function(response) {
            var jsonData = JSON.parse(response);
            if(jsonData.success) {
                alert("Successfully registered! Welcome.");
                login(data.id, data.password);
            } else {
                if(jsonData.error == "id_exist") {
                    $("#idHelp").attr("hidden", false);
                } else {
                    alert("Regirstartion fail!");
                }
            }
       }
   });
});

$("#reg_id").keydown(function(){
    $("#idHelp").attr("hidden", true);
});