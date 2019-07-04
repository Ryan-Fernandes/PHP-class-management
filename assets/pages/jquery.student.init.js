var pageNumber = 1;
var key = "";

function studentPaginationLinkClicked(page) {
    pageNumber = page;
    loadStudentsData();
}

function search(searchKey) {
    key = searchKey;
    loadStudentsData();
}
function notification(){
    toastr.info('Student Inserted')
    toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
}
function loadStudentsData() {
    var choice = document.getElementById("num-rows-choice");
    var numRows = choice.options[choice.selectedIndex].value;

    $.ajax({
        type: 'POST',
        url: 'includes/process-ajax-request.php',
        data: 'rows=' + numRows + "&page=" + pageNumber + "&key=" + key + "&manage=student" 
    }).done(function (response) {

        document.getElementById("student-info").innerHTML = response;

        pageNumber = 1;

        ! function (t) {
            "use strict";
            var n = function () {};
            n.prototype.init = function () {
                t(".delete-student").click(function () {
                    var sid = $(this).attr('data-student-id');
                    swal({
                        title: "Are you sure, you wanna delete this student entry?",
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
                            data: 'sid=' + sid + '&manage=student'
                        }).done(function (response) {

                            swal({
                                title: "Deleted !",
                                text: "Student has been deleted!",
                                type: "success",
                                confirmButtonClass: "btn btn-confirm mt-2"
                            }).then(function () {
                                self.location = "student.php";
                            })
                        }).fail(function () {
                            swal({
                                title: "Issue !",
                                text: "There was issue deleteing student, please try again later!",
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
loadStudentsData();

$(document).ready(function () {
    $('form').parsley();
    $("#datepicker-autoclose").datepicker({
        autoclose: !0,
        todayHighlight: !0
    });
});
/*
The below function is used to create a modal when we press the delete button to delete a student entry.
This is using SweetAlert plugin to create a user friendly modal!
 */