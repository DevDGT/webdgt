CURRENT_PATH = ADMIN_PATH + "/email/";
tableId = "#listImel"
moveRoom(tableId)

function refreshData() {
	table.ajax.reload(null, !1)
}

$(document).ready(function () {
	$(tableId).attr('style', 'width:115px; text-align:center;')
	table = $(tableId).DataTable({
		processing: !0,
		serverSide: !0,
		order: [],
		ajax: {
			url: API_PATH + "data/email",
			type: "POST",
			data: {
				_token: TOKEN
			},
			complete: function () {
				checkPilihan({
					table: tableId,
					buttons: ['delete'],
					path: CURRENT_PATH
				})
			},
			dataSrc: function (json) {
				json?.status == '401' && msgSweetWarning("Sesi Anda berakhir !").then(msg => {
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
		},
		columns: dataColumnTable(['id', 'name', 'emails', 'subject', 'message']),
		columnDefs: [{
			targets: [0],
			orderable: !1,
			sClass: "text-center",
			render: function (data, type, row) {
				return "<input type='checkbox' id='checkItem-" + row.id + "' value='" + row.id + "'>"
			}
		}, {
			targets: [1],
			orderable: !1,
			sClass: "text-center",
		}, {
			targets: [2],
			orderable: !1,
			sClass: "text-center",
		}, {
			targets: [3],
			orderable: !1,
			sClass: "text-center",
		}, {
			targets: [4],
			orderable: !1,
			sClass: "text-center",
		}, {
			sClass: "text-center",
			targets: [5],
			orderable: !0,
			render: function (data, type, row) {
				return "<button class='btn btn-info btn-sm' id='sendMailbox' data-mail=" + row.emails + " data-id=" + row.id + " title='Kirim Email'><i class='fas fa-envelope'></i></button>\n<button class='btn btn-danger btn-sm' id='delete' data-id=" + row.id + " title='Hapus Data'><i class='fas fa-trash-alt'></i></button>"
			}
		}]
	}), $(tableId).delegate("#delete", "click", (function () {
		confirmSweet("Anda yakin ingin menghapus data ?").then((result) => {
			if (isConfirmed(result)) {
				// alert(CURRENT_PATH);
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
						"ok" == result.status ? (enableButton(), toastSuccess(result.message), refreshData(), socket.emit?.("affectDataTable", tableId)) : toastError(result.message, "Gagal")
					},
					error: function (error) {
						errorCode(error)
					}
				})
			}
		})
	})), $(tableId).delegate("#sendMailbox", "click", (function () {
		// confirmSweet("Anda yakin ingin menghapus data ?").then((result) => {
		inboxInput().then((result) => {
			if (isConfirmed(result)) {
				// alert(CURRENT_PATH);
				let id = $(this).data("id");
				let email = $(this).data("mail");
				let subject = JSON.stringify(result.value[0]);
				let pesana = JSON.stringify(result.value[1]);

				// console.log(email);
				// console.log(subject);
				// console.log(pesana);
				// console.log(JSON.stringify(result.value[0]));
				result && $.ajax({
					url: CURRENT_PATH + "sendinbox",
					data: {
						_token: TOKEN,
						// id: id,
						email: email,
						subject: subject,
						pesana: pesana
					},
					type: "POST",
					dataType: "JSON",
					beforeSend: function () {
						// disableButton()
					},
					success: function (result) {
						"200" == result.status ? (toastSuccess(result.message), refreshData(), socket.emit?.("affectDataTable", tableId)) : toastError(result.message, "Gagal")
						// console.log(result)
					},
					error: function (error) {
						errorCode(error)
					}
				})
			}
		})
	}))
})

function inboxInput(options = {
	title: 'Input Subject & Message',
	confirmBtn: "Kirim Imel",
	cancelBtn: "Batal"
}) {
	return Swal.fire({
		icon: "info",
		title: options.title,
		html:
			'<input id="subject" class="swal2-input" placeholder="Cc/Bcc">' +
			'<textarea id="pesana" class="swal2-input" rows="5" placeholder="Message Here"></textarea>',
		showCancelButton: !0,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: options.confirmBtn,
		cancelButtonText: options.cancelBtn,

		focusConfirm: false,
		preConfirm: () => {
			return [
				document.getElementById('subject').value,
				document.getElementById('pesana').value,
			]
		}
	})
}