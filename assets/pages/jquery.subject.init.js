var pageNumber = 1;
var key = "";

function PaginationLinkClicked(page) {
    pageNumber = page;
    loadData();
}

function search(searchKey) {
    key = searchKey;
    loadData();
}

function loadData() {
    var choice = document.getElementById("num-rows-choice");
    var numRows = choice.options[choice.selectedIndex].value;

    $.ajax({
        type: 'POST',
        url: 'includes/process-ajax-request.php',
        data: 'rows=' + numRows + "&page=" + pageNumber + "&key=" + key + "&manage=subject"
    }).done(function (response) {

        document.getElementById("subject-info").innerHTML = response;

        pageNumber = 1;

        ! function (t) {
            "use strict";
            var n = function () {};
            n.prototype.init = function () {
                t(".delete-subject").click(function () {
                    var id = $(this).attr('data-record-id');
                    swal({
                        title: "Are you sure, you wanna delete this Subject entry?",
                        text: "You won't be able to revert this!",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonClass: "btn btn-confirm mt-2",
                        cancelButtonClass: "btn btn-cancel ml-2 mt-2",
                        confirmButtonText: "Yes, delete it!"
                    }).then(function () {
                        $.ajax({
                            type: 'POST',
                            url: 'includes/delete-records.php',
                            data: 'id=' + id + '&manage=subject'
                        }).done(function (response) {

                            swal({
                                title: "Deleted !",
                                text: "Subject has been deleted!",
                                type: "success",
                                confirmButtonClass: "btn btn-confirm mt-2"
                            }).then(function () {
                                self.location = "subject.php";
                            })
                        }).fail(function () {
                            swal({
                                title: "Issue !",
                                text: "There was issue deleteing subject, please try again later!",
                                type: "error",
                                confirmButtonClass: "btn btn-confirm mt-2"
                            })
                        })
                    })
                })
            }, t.SweetAlert = new n, t.SweetAlert.Constructor = n
        }(window.jQuery),
        function (t) {
            "use strict";
            t.SweetAlert.init()
        }(window.jQuery);
    })
}
loadData();

$(document).ready(function () {
    $('form').parsley();
    $("#datepicker-autoclose").datepicker({
        autoclose: !0,
        todayHighlight: !0
    });
});
/*
The below function is used to create a modal when we press the delete button to delete a subject entry.
This is using SweetAlert plugin to create a user friendly modal!
 */