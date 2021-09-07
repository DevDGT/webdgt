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
					buttons: ['delete', 'active', 'deactive'],
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
		columns: dataColumnTable(['id', 'name', 'emails','subject', 'message']),
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
				return "<button class='btn btn-danger btn-sm' id='delete' data-id=" + row.id + " title='Hapus Data'><i class='fas fa-trash-alt'></i></button> \n <button class='btn btn-warning btn-sm' id='edit' data-id=" + row.id + " title='Edit Data'><i class='fas fa-pencil-alt'></i></button>"
			}
		}]
	})
})