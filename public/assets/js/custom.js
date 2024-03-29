$(".dropify").dropify();
$(".selectpicker").selectpicker({
    dropupAuto: false,
});
// show modal function
function showFormModal(modal_title, btn_text) {
    $("#store_or_update_form")[0].reset();
    $("#store_or_update_form #update_id").val("");
    $("#store_or_update_form").find(".is-invalid").removeClass("is-invalid");
    $("#store_or_update_form").find(".error").remove();
    $("#store_or_update_form .dropify-clear").trigger("click");
    $("#store_or_update_form .selectpicker").selectpicker("refresh");
    $("#store_or_update_modal")
        .modal({
            keyboard: false,
            backdrop: "static",
        })
        .modal("show");
    $("#store_or_update_modal .modal-title").html(
        '<i class="fa-solid fa-square-plus"></i> ' + modal_title
    );
    $("#store_or_update_modal #save_btn").text(btn_text);
}

function select_all() {
    if ($("#select_all:checked").length == 1) {
        $(".select_data").prop("checked", true);
        if ($(".select_data:checked").length >= 1) {
            $(".delete_btn").removeClass("d-none");
        }
    } else {
        $(".select_data").prop("checked", false);
        $(".delete_btn").addClass("d-none");
    }
}

function select_single_item(id) {
    let total = $(".select_data").length; //count total checkbox
    let total_checked = $(".select_data:checked").length; //count total checked checkbox
    total == total_checked
        ? $("#select_all").prop("checked", true)
        : $("#select_all").prop("checked", false);
    total_checked > 0
        ? $(".delete_btn").removeClass("d-none")
        : $(".delete_btn").addClass("d-none");
}

// sweetalert notifications
function notification(status, message) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });
    Toast.fire({
        icon: status,
        title: message,
    });
}

// global store funtion with image using ajax, jquery
function store_or_update_data(table, method, url, formData) {
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        dataType: "JSON",
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function () {
            $("#save_btn").addClass(
                "kt-spinner kt-spinner--md kt-spinner--light"
            );
        },
        complete: function () {
            $("#save_btn").removeClass(
                "kt-spinner kt-spinner--md kt-spinner--light"
            );
        },
        success: function (data) {
            $("#store_or_update_form")
                .find(".is-invalid")
                .removeClass("is-invalid");
            $("#store_or_update_form").find(".error").remove();
            if (data.status == false) {
                $.each(data.errors, function (key, value) {
                    $("#store_or_update_form input#" + key).addClass(
                        "is-invalid"
                    );
                    $("#store_or_update_form textarea#" + key).addClass(
                        "is-invalid"
                    );
                    $("#store_or_update_form select#" + key)
                        .parent()
                        .addClass("is-invalid");
                    $("#store_or_update_form #" + key)
                        .parent()
                        .append(
                            '<div class="error text-danger">' + value + "</div>"
                        );
                });
            } else {
                notification(data.status, data.message);
                if (data.status == "success") {
                    if (method == "update") {
                        table.ajax.reload(null, false);
                    } else {
                        table.ajax.reload();
                    }
                    $("#store_or_update_modal").modal("hide");
                }
            }
        },
        error: function (xhr, ajaxOption, thrownError) {
            console.log("error");
            console.log(
                thrownError +
                    "\r n" +
                    xhr.statusText +
                    "\r n" +
                    xhr.responseText
            );
        },
    });
}

// delete data with sweetalert2 and ajax
function delete_data(id, url, table, row, name) {
    Swal.fire({
        title: "Are you sure to delete " + name + " data?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id: id,
                    _token: _token,
                },
                dataType: "JSON",
            })
                .done(function (response) {
                    if (response.status == "success") {
                        Swal.fire("Deleted", response.message, "success").then(
                            function () {
                                table.row(row).remove().draw(false);
                            }
                        );
                    }
                })
                .fail(function () {
                    Swal.fire("Oops....", "Something went wrong!", "error");
                });
        }
    });
}

// bulk action delete function
function bulk_delete(ids, table, url, rows) {
    Swal.fire({
        title: "Are you sure to delete all checked data?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete all!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    ids: ids,
                    _token: _token,
                },
                dataType: "JSON",
            })
                .done(function (response) {
                    if (response.status == "success") {
                        Swal.fire("Deleted", response.message, "success").then(
                            function () {
                                table.rows(rows).remove().draw(false);
                                $("#select_all").prop("checked", false);
                                $(".delete_btn").addClass("d-none");
                            }
                        );
                    }
                })
                .fail(function () {
                    Swal.fire("Oops....", "Something went wrong!", "error");
                });
        }
    });
}
