CURRENT_PATH = ADMIN_PATH + "/profile/";
tableId = "#listSocials"
moveRoom(tableId)

htmlEditor = ''
cssEditor = ''
jsEditor = ''

$(document).ready(function(){
    addFormProfile()
    getProfile()
    getSocials()
})

$("#reset").on('click', function() {
    getProfile()
})

function getSocials() {
    $(document).ready((function () {
        $(".statusField").attr('style', 'width:50')
        $(".actionField").attr('style', 'width:115px; text-align:center')
        table = $(tableId).DataTable({
            processing: !0,
            serverSide: !0,
            order: [],
            ajax: {
                url: API_PATH + "data/user-socials",
                type: "POST",
                data: {
                    _token: TOKEN
                },
                complete: function () {
                    // checkPilihan({
                    //     table: tableId,
                    //     buttons: ['delete', 'active', 'deactive'],
                    //     path: CURRENT_PATH
                    // })
                },
                dataSrc: function ( json ) {
                    json?.status == '401' && msgSweetWarning("Sesi Anda berakhir !").then(msg=> {
                        doLogoutAjax()
                    })
                    json?.status == "fail" && toastError(json?.message, "Gagal")
                    return json.data;
                },
                error: function (error) {
                    errorCode(error)
                }
            },
            fnCreatedRow: function (nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData.id)
                // $(nRow).addClass('')
            },
            columns: dataColumnTable([
                'id', 'social', 'link'
            ]),
            columnDefs: [{
                targets: [0],
                orderable: !1,
                sClass: "text-center align-middle",
                render: function (data, type, row) {
                    return "<input type='checkbox' id='checkItem-" + row.id + "' value='" + row.id + "'>"
                },
                visible: !1
            },{
                targets: [1],
                orderable: !1,
                sClass: "text-center",
                render: function (data, type, row) {
                    return row.social
                }
            }, {
                sClass: "align-middle text-center",
                targets: [2],
                orderable: !0,
                render: function (data, type, row) {
                    return `<a href='${row.link}' target='_blank'>${row.link}</a>`
                }
            }, {
                sClass: "align-middle text-center",
                targets: [3],
                orderable: !0,
                render: function (data, type, row) {
                    return `<button class='btn my-auto btn-danger btn-sm' id='delete' data-id="${row.id}" data-toggle='tooltip' title='Hapus Data'><i class='fas fa-trash-alt'></i></button> \n <button class='btn btn-warning btn-sm' id='edit' data-id="${row.id}" data-toggle='tooltip' title='Edit Data'><i class='fas fa-pencil-alt'></i></button> `
                }
            }]
        })
    }))
}

$(tableId).delegate("#delete", "click", function () {
    confirmSweet("Anda yakin ingin menghapus data ?").then((result) => {
		if (isConfirmed(result)) {
			let id = $(this).data("id")
			result && $.ajax({
				url: CURRENT_PATH + "delete",
				data: {
					_token: TOKEN,
					id: id
				},
				type: "POST",
				dataType: "JSON",
				beforeSend: function () {
					disableButton()
				},
				success: function (result) {
					"ok" == result.status ? (enableButton(), toastSuccess(result.message), refreshData(), socket.emit("affectDataTable", tableId), socket.emit?.("teamChanged")) : toastError(result.message, "Gagal")
				},
				error: function (error) {
					errorCode(error)
				}
			})
		}
	})
})

$("#nav-page-tab").click(function() {
    // alert("asdsad")
    console.log(htmlEditor);
    
    if (htmlEditor == '') {
        htmlEditor = CodeMirror.fromTextArea(document.getElementById("EditorHtml"), {
            mode: "htmlmixed",
            theme: "monokai",
            lineNumbers: true,
        });
    }
    // console.log(html);
    // html.getTextArea()
    // CodeMirror.fromTextArea(document.getElementById("EditorCss"), {
    //     lineNumbers: true,
    //     mode: "css",
    //     theme: "monokai"
    // });
    // CodeMirror.fromTextArea(document.getElementById("EditorJs"), {
    //     lineNumbers: true,
    //     mode: "javascript",
    //     theme: "monokai"
    // });
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
            type: "post",
            url: API_PATH + 'data/profile',
            data: {
                _token: TOKEN
            },
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
            result.validate.success && "ok" == result.status ? (toastSuccess(result.message),getProfile(), socket.emit?.("teamChanged"), $(`input[name="photo"]`).val(''), updateInfo()) : toastWarning(result.message)
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
		$("#rotiId").html($(data).find('#rotiId').html())
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
    let data = new FormData(this)
    data.append('_token', TOKEN)
    $.ajax({
        url: `${CURRENT_PATH}set-password`,
		type: "post",
		data: data,
        dataType: "json",
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
            console.log(result)
            if (result.status == "ok") {
                msgSweetSuccess(result.message)
                $("#passBaru").val('')
                $("#passLama").val('')
                $("#confirmPass").val('')
                // socket.emit?.("teamChanged")
            }
            if (result.status == "fail") {
                // msgSweetError(response.message)
            }
            // if (response.status == "salah") {
            //     isInvalid("#passLama")
            // } else {
            //     noValid("#passLama")
            // }
        },
        error: function(error){
            errorCode(error)
        }
    })
})

// function passCheck(pass) {
//     var strength = 1;
//     var arr = [/.{5,}/, /[a-z]+/, /[0-9]+/, /[A-Z]+/];
//     jQuery.map(arr, function (regexp) {
//         if (pass.match(regexp))
//             strength++;
//     });
//     console.log(strength);
// }

// $("#passBaru").on('change', function(){
//     let pass = $(this).val()
//     passCheck(pass)
// })

// setInterval(() => {
//     let passBaru = $("#passBaru").val()
//     if (passBaru != '' && passBaru?.length >= 6) {
//         isValid("#passBaru")
//         cekPassBaru()
//     } else {
//         isInvalid("#passBaru")
//         isInvalid("#confirmPass")
//         cekPassBaru()
//     }
// }, 500);

// function cekPassBaru() {
//     $("#btnUbahPass").attr('disabled', true)
//     if ($("#confirmPass").val() != "") {
//         let passBaru = $("#passBaru").val()
//         let passConf = $("#confirmPass").val()
//         if (passBaru == passConf) {
//             isValid("#confirmPass")
//             $("#btnUbahPass").removeAttr("disabled")
//         } else {
//             isInvalid("#confirmPass")
//             $("#btnUbahPass").attr('disabled', true)
//         }
//     } else {
//         noValid("#confirmPass")
//         $("#btnUbahPass").attr('disabled', true)
//     }
// }