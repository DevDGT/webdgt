$(document).ready(function () {

    $("#sendMail").click(function (e) {
        e.preventDefault();
        var formData = new FormData(document.getElementById('formInbox'));
        $.ajax({
            url: $('#formInbox').attr('action'),
            type: "post",
            data: formData,
            processData: !1,
            contentType: !1,
            cache: !1,
            dataType: "JSON",
            beforeSend: function () {
                // disableButton()	
            },
            complete: function () {
                // enableButton()
            },
            success: function (e) {
                console.log(e.data);
                // validate(e.validate.input),e.validate.success&&("ok"==e.status?(toastSuccess(e.message),refreshData(),1==e.modalClose&&$("#modalForm").modal("hide"),clearInput(e.validate.input),socket.emit?.("affectDataTable", tableId)):toastWarning(e.message));
            },
            error: function (err) {
                // errorCode(err)
            }
        })
    })
})