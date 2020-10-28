$(document).ready(function () {

    $("#event").change(function () {
        if ($("#event").val() === "other") {
            $("#eventother").append(
                `<div id="boxotheranother" class="col-md-8 mb-2 d-flex flex-wrap justify-content-center mb-3">
              <label for="writeanother" class="mr-2 mt-1">Mencionelo: </label>
              <input type="text" name="values[]" 
                id="writeanother" class="mb-1" min="0"  />
            </div>`
            );
        } else {
            if (document.getElementById("boxotheranother")) {
                $("#boxotheranother").remove();
            }
        }
    });
    $("#form-book").submit(function () {
        if (!validateForm()) {
            $('html, body').animate({
                scrollTop: $("#box-confirmpass").offset().top - 100
            }, 500);
            return false;
        } else {
            starthour = (($("#start-time-select").val()).toLowerCase() == "am") ?
                parseInt($("#start-time").val()) :
                parseInt($("#start-time").val()) + 12;
            switch (starthour) {
                case 12:
                case 24:
                    starthour = starthour - 12;
                    break;
            }

            finalhour = (($("#final-time-select").val()).toLowerCase() == "am") ?
                parseInt($("#final-time").val()) :
                parseInt($("#final-time").val()) + 12;
            switch (finalhour) {
                case 12:
                case 24:
                    finalhour = finalhour - 12;
                    break;
            }
            if (starthour >= finalhour) {
                showMessage();
                return false;
            }
        }
    });
});

//validate all form inputs

function validateForm() {
    if (document.getElementById("boxotheranother")) {
        if ($("#writeanother").val() === "") {
            showMessage();
            return false;
        }
    } else {
        if ($("#event").val() == "") {
            showMessage();
            return false;
        }
    }

    if (!validateTime("#start-time")) {
        return false;
    }
    if (!validateTime("#final-time")) {
        return false;
    }

    var boxServices = document.getElementById("boxservices");

    for (var i = 0; i < boxServices.children.length; i++) {
        if (!validateService("#" + boxServices.children[i].children[1].id)) {
            return false;
        }
    }

    return true;
}

//validate validate the hours

function validateTime(id) {
    if (isNaN($(id).val()) || ($(id).val().replace(" ", "").trim() == "")) {
        showMessage();
        return false;
    } else {
        if ((($(id).val()) % 1 != 0) || ($(id).val() < 1) || ($(id).val() > 12)) {
            showMessage();
            return false;
        }
    }
    return true;
}

//validate validate the services

function validateService(id) {
    if (isNaN($(id).val()) || ($(id).val().replace(" ", "").trim() == "")) {
        showMessage();
        return false;
    } else {
        if ((($(id).val()) % 1 != 0) || ($(id).val() < 0)) {
            showMessage();
            return false;
        }
    }
    return true;
}

//in case of wrong data in the inputs, this message will be displayed

function showMessage() {
    if (!document.getElementById("msg-error-successful")) {
        $("#box-confirmpass").append(
            `<p id="msg-error-successful" class="mb-0 mt-2 alert alert-danger alert-dismissible fade show" role="alert">
                      ¡Vaya! Rellene o corrija los datos
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button> 
                  </p>`
        );
    }
    document.getElementById('total').value="";
}

//clean button repair

function restore() {
    if (document.getElementById("boxotheranother")) {
        $("#boxotheranother").remove();
    }
}

//quote services without reloading the page

function quote() {
    if (validateForm()) {
        var finalhour;

        starthour = (($("#start-time-select").val()).toLowerCase() == "am") ?
            parseInt($("#start-time").val()) :
            parseInt($("#start-time").val()) + 12;
        switch (starthour) {
            case 12:
            case 24:
                starthour = starthour - 12;
                break;
        }

        finalhour = (($("#final-time-select").val()).toLowerCase() == "am") ?
            parseInt($("#final-time").val()) :
            parseInt($("#final-time").val()) + 12;
        switch (finalhour) {
            case 12:
            case 24:
                finalhour = finalhour - 12;
                break;
        }
        if (starthour < finalhour) {
            if (document.getElementById('msg-error-successful')) {
                $('#msg-error-successful').remove();
            }

            var datesForm = [starthour, finalhour];
            var boxServices = document.getElementById("boxservices");
            for (var i = 0; i < boxServices.children.length; i++) {
                datesForm.push(boxServices.children[i].children[1].id);
                datesForm.push(boxServices.children[i].children[1].value);
            }
            console.log(datesForm);
            $.ajax({
                data: {
                    datesForm
                },
                type: "post",
                dataType: "json",
                url: "../../ajax/my/quoteRental.php",
            })
                .done(function (data, textStatus, jqXHR) {
                    document.getElementById("total").value = data;
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.log("mal");
                });
        } else {
            showMessage();
        }
    }
}