"use strict";

// Class definition
var KTSweetAlert2Demo = function () {

    // Demos
    var initDemos = function () {
        $('#kt_sweetalert_demo_9').click(function (e) {
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    // result.dismiss can be 'cancel', 'overlay',
                    // 'close', and 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            });
        });

    };

    return {
        // Init
        init: function () {
            initDemos();
        },
    };
}();

// Class Initialization
jQuery(document).ready(function () {
    KTSweetAlert2Demo.init();
});