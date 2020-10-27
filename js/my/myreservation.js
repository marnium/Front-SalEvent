var date = new Date();
document.getElementById('showDate').innerHTML = date.getDate() + "-" + date.getMonth() + "-" + date.getFullYear();

function modidyReservation(cell) {
    if (document.getElementById("msg-error-successful")) {
        $("#msg-error-successful").remove();
    }
    $.ajax({
        data: {
            "id": JSON.stringify(cell.parentNode.parentNode.cells[0].innerHTML)
        },
        type: "post",
        dataType: "json",
        url: "../../ajax/my/modifyReservation.php",
    })
        .done(function (data, textStatus, jqXHR) {
            if (parseInt(data) == 1) {
                if (!document.getElementById("msg-error-successful")) {
                    $("#box-confirmpass").append(
                        `<p id="msg-error-successful" class="mb-0 mt-2 alert alert-success 
                  alert-dismissible fade show text-center" role="alert">
                        ¡Vaya! Su reservacion ha sido confirmado, con el fin de ofrecer el mejor servicio, usted no podra
                          modificarlo
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </p>`
                    );
                    $('html, body').animate({
                        scrollTop: $("#box-confirmpass").offset().top - 150
                    }, 500);
                    return false;
                }
            } else {
                document.location.reload();
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) { });
}

function viewStatus(cell) {
    $.ajax({
        data: {
            "id": JSON.stringify(cell.parentNode.parentNode.cells[0].innerHTML)
        },
        type: "post",
        dataType: "json",
        url: "../../ajax/my/viewStatus.php",
    })
        .done(function (data, textStatus, jqXHR) {
            document.location.reload();
        })
        .fail(function (jqXHR, textStatus, errorThrown) { });
}

function deleteReservation(cell) {
    if (document.getElementById("msg-error-successful")) {
        $("#msg-error-successful").remove();
    }
    $.ajax({
        data: {
            "id": JSON.stringify(cell.parentNode.parentNode.cells[0].innerHTML)
        },
        type: "post",
        dataType: "json",
        url: "../../ajax/my/deleteReservation.php",
    })
        .done(function (data, textStatus, jqXHR) {

            var totalRowSelected = cell.parentNode.parentNode.cells[3].innerHTML;
            document.getElementById("total").innerHTML =
                (parseInt(document.getElementById("total").innerHTML) -
                    parseInt(totalRowSelected));
            document.getElementById("tableReservations").deleteRow(cell.parentNode.parentNode.rowIndex);

            if (!document.getElementById("msg-error-successful")) {
                $("#box-confirmpass").append(
                    `<p id="msg-error-successful" class="mb-0 mt-2 alert alert-success alert-dismissible fade show" role="alert">
                        <small>¡Hecho! Se ha eliminado la reservacion con el id =` + data + `</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </p>`
                );
                $('html, body').animate({
                    scrollTop: $("#box-confirmpass").offset().top - 150
                }, 500);
            }
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if (!document.getElementById("msg-error-successful")) {
                $("#box-confirmpass").append(
                    `<p id="msg-error-successful" class="mb-0 mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                        <small>¡Upps! Tu reservacion no fue eliminada</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> 
                    </p>`
                );
            }
        });
}