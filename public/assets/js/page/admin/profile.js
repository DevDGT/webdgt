CURRENT_PATH = ADMIN_PATH + "/profile/";
tableId = "#listSocials"
moveRoom(tableId)

$(document).ready(function(){
    addFormProfile()
    getProfile()
    CodeMirror.fromTextArea(document.getElementById("EditorHtml"), {
        lineNumbers: true,
        mode: "htmlmixed",
        theme: "monokai"
    });
    CodeMirror.fromTextArea(document.getElementById("EditorCss"), {
        lineNumbers: true,
        mode: "css",
        theme: "monokai"
    });
    CodeMirror.fromTextArea(document.getElementById("EditorJs"), {
        lineNumbers: true,
        mode: "javascript",
        theme: "monokai"
    });
})

$("#reset").on('click', function() {
    getProfile()
})

function isInvalid(idNa) {
  $(idNa).removeClass("is-valid")
  $(idNa).addClass("is-invalid")
}

function isValid(idNa) {
  $(idNa).removeClass("is-invalid")
  $(idNa).addClass("is-valid")
}

function noValid(idNa) {
  $(idNa).removeClass("is-invalid is-valid")
}
function addFormProfile() {
    addFormInput("#formBody", [{
        type: "text",
        name: "username",
        label: "Username"
    }, {
        type: "text",
        name: "name",
        label: "Nama"
    }, {
        type: "email",
        name: "email",
        label: "Email"
    }, {
        type: "text",
        name: "quotes",
        label: "Quotes"
    }, {
        type: "file",
        name: "photo",
        label: "Foto Profile (pilih untuk merubah)"
    }])
}

function getProfile() {
    return new Promise(resolve => {
        $.ajax({
            dataType: "json",
            url: API_PATH + 'data/profile',
            beforeSend: function(){
                disableButton()
            },
            complete: function(){
                enableButton()
            },
            success: function (result) {
                fillForm(result.data)
                $("#photoProfile").attr('src', result.data.photo != '' ? `${BASE_URL}/uploads/users/${result.data.photo}` : `${BASE_URL}/uploads/users/default.png`)
            }
        }).done(function(result) {
            resolve(result)
        })
    })
}

$("#updateProfile").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: `${CURRENT_PATH}update`,
        type: "post",
        dataType: "json",
		data: new FormData(this),
		processData: false,
		contentType: false,
		cache: false,
        beforeSend: function(){
            disableButton()
        },
        complete: function(){
            enableButton()
        },
        success: function(result){
            validate(result.validate.input)
            result.validate.success && "ok" == result.status ? (toastSuccess(result.message),getProfile(), $(`input[name="photo"]`).val(''), updateInfo()) : toastWarning(result.message)
            // validate(e.validate.input),e.validate.success&&("ok"==e.status?(toastSuccess(e.message),refreshData(),1==e.modalClose&&$("#modalForm").modal("hide"),clearInput(e.validate.input),socket.emit?.("affectDataTable", tableId)):toastWarning(e.message));
        },
        error: function(error){
            errorCode(error)
        }
    })
})

function updateInfo() {
    $.get(CURRENT_PATH, function(data) {
		$("#userLoginInfo").html($(data).find('#userLoginInfo').html())
    }).fail(function(err) {
		$("#contentId").html(`<div class="container">${err.statusText}</div>`)
		nanobar.go(100)
		errorCode(err)
	}).done(function() {
		nanobar.go(100)
	})
}

$("#formPassword").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: `${baseUrl}/admin/profile/set/password`,
		type: "post",
		data: new FormData(this),
		processData: false,
		contentType: false,
		cache: false,
        beforeSend: function(){
            disableButton()
        },
        complete: function(){
            enableButton()
        },
        success: function(result){
            let response = JSON.parse(result)
            if (response.status == "benar") {
                msgSweetSuccess("Berhasil Mengganti Password !")
                $("#passBaru").val('')
                $("#passLama").val('')
                $("#confirmPass").val('')
            }
            if (response.status == "fail") {
                msgSweetError("Password tidak boleh sama dengan sebelumnya")
            }
            if (response.status == "salah") {
                isInvalid("#passLama")
            } else {
                noValid("#passLama")
            }
        },
        error: function(error){
            errorCode(error)
        }
    })
})

function passCheck(pass) {
    var strength = 1;
    var arr = [/.{5,}/, /[a-z]+/, /[0-9]+/, /[A-Z]+/];
    jQuery.map(arr, function (regexp) {
        if (pass.match(regexp))
            strength++;
    });
    console.log(strength);
}

$("#passBaru").on('change', function(){
    let pass = $(this).val()
    passCheck(pass)
})

setInterval(() => {
    let passBaru = $("#passBaru").val()
    if (passBaru != '' && passBaru.length >= 6) {
        isValid("#passBaru")
        cekPassBaru()
    } else {
        isInvalid("#passBaru")
        isInvalid("#confirmPass")
        cekPassBaru()
    }
}, 500);

function cekPassBaru() {
    $("#btnUbahPass").attr('disabled', true)
    if ($("#confirmPass").val() != "") {
        let passBaru = $("#passBaru").val()
        let passConf = $("#confirmPass").val()
        if (passBaru == passConf) {
            isValid("#confirmPass")
            $("#btnUbahPass").removeAttr("disabled")
        } else {
            isInvalid("#confirmPass")
            $("#btnUbahPass").attr('disabled', true)
        }
    } else {
        noValid("#confirmPass")
        $("#btnUbahPass").attr('disabled', true)
    }
}