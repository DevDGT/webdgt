CURRENT_PATH = ADMIN_PATH + "/clients-orders/";

tableId = "#listClientsOrders"

moveRoom(tableId)

function setStatus(status, id) {
	confirmSweet("Anda yakin ingin merubah status ?").then(result => {
		if (isConfirmed(result)) {
			$.ajax({
				url: CURRENT_PATH + "set/" + id,
				data: {
					_token: TOKEN,
					status: status
				},
				type: "POST",
				dataType: "JSON",
				beforeSend: function () {
					disableButton()
				},
				complete: function () {
					enableButton()
				},
				success: function (result) {
					"ok" == result.status ? (refreshData(), enableButton(), toastSuccess(result.message), socket.emit("affectDataTable",tableId), socket.emit('logoutUser', {userId: id, reason: status}), socket.emit?.("teamChanged")) : (enableButton(), toastError(result.message, "Gagal"))
				},
				error: function (error) {
					errorCode(error)
				}
			})
		}
	})
}

function refreshData() {
	table.ajax.reload(null, !1)
}
$(document).ready((function () {
	$("#statusField").attr('style', 'width:70px')
	$("#actionField").attr('style', 'width:115px; text-align:center')
	table = $(tableId).DataTable({
		processing: !0,
		serverSide: !0,
		order: [],
		ajax: {
			url: API_PATH + "data/clients-orders",
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
			dataSrc: function ( json ) {
				json?.status == '401' && msgSweetWarning("Sesi Anda berakhir !").then(msg=> {
					doLogoutAjax()
				})
				json?.status == "fail" && toastError(json?.message, "Gagal")
                return json.data;
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
			'id', 'clientName', 'icon', 'productName', 'active'
		]),
		columnDefs: [{
			targets: [0],
			orderable: !1,
			sClass: "text-center align-middle",
			render: function (data, type, row) {
				return "<input type='checkbox' id='checkItem-" + row.id + "' value='" + row.id + "'>"
			}
		},{
			targets: [1],
			orderable: !1,
			sClass: "",
			// visible: !1
		},{
			sClass: "align-middle",
			targets: [2],
			orderable: !1,
			render: function (data, type, row){
				return row.productName
			}
		}, {
			sClass: "align-middle text-center",
			targets: [3],
			orderable: !0,
			render: function (data, type, row) {
				return 1 == row.active ? `<button class='btn btn-success btn-sm' id='on' data-id="${row.id}" data-toggle='tooltip' title='Client Aktif'><i class='fas fa-toggle-on'></i> On</button>` : `<button class='btn btn-danger btn-sm' id='off' data-id="${row.id}" data-toggle='tooltip' title='Client Tidak Aktif'><i class='fas fa-toggle-off'></i> Off</button>`
			}
		}, {
			sClass: "align-middle text-center",
			targets: [4],
			orderable: !0,
			render: function (data, type, row) {
				return `<button class='btn my-auto btn-danger btn-sm' id='delete' data-id="${row.id}" data-toggle='tooltip' title='Hapus Data'><i class='fas fa-trash-alt'></i></button> \n <button class='btn btn-warning btn-sm' id='edit' data-id="${row.id}" data-toggle='tooltip' title='Edit Data'><i class='fas fa-pencil-alt'></i></button>`
			}
		}]
	})
})), $(tableId).delegate("#delete", "click", (function () {
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
})), $(tableId).delegate("#edit", "click", (function () {
	let id = $(this).data("id");
	$.ajax({
		url: API_PATH + "row/clients-orders/" + id,
		type: "post",
		data: {_token: TOKEN},
		dataType: "json",
		beforeSend: function() {
			disableButton()
			clearFormInput("#formBody")
			addFormInput("#formBody", [{
				type: "hidden",
				name: "id"
			},{
				type: "select2",
				name: "id_clients",
				label: "Klien",
				api: {
					url: API_PATH + 'data/options/clients',
					option: {
						value: 'id',
						caption: '{name}'
					},
					order: {
						name: "asc"
					},
					where:{
						active: 1
					}
				}
			}, {
				type: "select2",
				name: "id_products",
				label: "Produk",
				api: {
					url: API_PATH + 'data/options/products',
					option: {
						value: 'id',
						caption: '{name}',
					},
					order: {
						name: "asc"
					}
				}
			}])
		}, 
		complete: function() {
			enableButton()
		},
		success: function(result) {
			"ok" == result.status ? ($("#modalForm").modal('show'),$("#modalTitle").html('Edit Pengguna'),$("#formInput").attr('action', CURRENT_PATH + "update"), fillForm(result.data), $("#iconGan").attr("src", `${BASE_URL}/uploads/clients/${result.data.icon}`)) : msgSweetError(result.message)
		},
		error: function(err) {
			errorCode(err)
		}
	})
})), $(tableId).delegate("#on", "click", (function () {
	setStatus("off", $(this).data("id"))
})), $(tableId).delegate("#off", "click", (function () {
	setStatus("on", $(this).data("id"))
})), $("#btnAdd").on('click', function () {
	clearFormInput("#formBody")
	addFormInput("#formBody", [{
		type: "select2",
		name: "id_clients",
		label: "Klien",
		api: {
			url: API_PATH + 'data/options/clients',
			option: {
				value: 'id',
				caption: '{name}'
			},
			order: {
				name: "asc"
			},
			where:{
				active: 1
			}
		}
	}, {
		type: "select2",
		name: "id_products",
		label: "Produk",
		api: {
			url: API_PATH + 'data/options/products',
			option: {
				value: 'id',
				caption: '{name}',
			},
			order: {
				name: "asc"
			}
		}
	}, {
		type: "date",
		name: "time",
		label: "Tahun"
	}])
	$("#modalForm").modal('show')
	$("#modalTitle").html('Tambah Pesanan Klien')
	$("#formInput").attr('action', CURRENT_PATH + "store")
}), $("#formInput").submit(function(e) {
	e.preventDefault()
	let formData = new FormData(this)
	formData.append("_token", TOKEN)
	$.ajax({
		url: $(this).attr('action'),
		type: "post",
		data: formData, 
		processData: !1,
		contentType: !1,
		cache: !1,
		dataType: "JSON",
		beforeSend: function () {
			disableButton()	
		},
		complete: function () {
			enableButton()
		},
		success: function (e) {
			validate(e.validate.input),e.validate.success&&("ok"==e.status?(toastSuccess(e.message),refreshData(),1==e.modalClose&&$("#modalForm").modal("hide"),clearInput(e.validate.input), socket.emit("affectDataTable", tableId), socket.emit?.("teamChanged")):toastWarning(e.message));
		},
		error: function(err) {
			errorCode(err)
		}
	})
})