$(document).ready(function () {
    var CSRF_TOKEN = $('[name="csrf-token"]').attr('content');

    //user permission's

    $('.vec:checked').each(function () {
        $(this).parent().parent().prevAll().find('input').prop('checked', true);
    });
    $(document).on("change", '.vec', function () {
        $(this).parent().parent().siblings().find('input').prop('checked', false);
        $(this).prop('checked', true);
        $(this).parent().parent().prevAll().find('input').prop('checked', true);
    });
    $(document).on("change", '.role', function () {
        $role = $(this).val();

        $.ajax({
            url: '/public/backend/grd',
            type: 'POST',
            context: {element: $(this)},
            data: {_token: CSRF_TOKEN, id: $role},
            dataType: 'JSON',
            success: function (data) {
                // if (data.length > 0) {
                $des = $('#description').val(data.description);

            },
            error: function (data, textStatus) {
                console.log("Error: ", data.status);
                console.log("Errors", textStatus);
            }
        });
    });

    var t = $('#kt_table_1').dataTable({
        "ordering": true,
        "initComplete": function () {
            // datatabel styles
            $('.kt-font-success td').css('color', '#0abb87');
            $('.pagination').css('justify-content', 'flex-end');
        },
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": 0
        }],
        "language": {
            "sEmptyTable": "Տվյալները բացակայում են",
            "sProcessing": "Կատարվում է...",
            "sInfoThousands": ",",
            "sLengthMenu": "Ցուցադրել _MENU_ արդյունքներ մեկ էջում",
            "sLoadingRecords": "Բեռնվում է ...",
            "sZeroRecords": "Հարցմանը համապատասխանող արդյունքներ չկան",
            "sInfo": "Ցուցադրված են _START_-ից _END_ արդյունքները ընդհանուր _TOTAL_-ից",
            "sInfoEmpty": "Արդյունքներ գտնված չեն",
            "sInfoFiltered": "(ֆիլտրվել է ընդհանուր _MAX_ արդյունքներից)",
            "sInfoPostFix": "",
            "sSearch": "Փնտրել",
            "oPaginate": {
                "sFirst": "Առաջին էջ",
                "sPrevious": "Նախորդ էջ",
                "sNext": "Հաջորդ էջ",
                "sLast": "Վերջին էջ"
            },
            "oAria": {
                "sSortAscending": ": ակտիվացրեք աճման կարգով դասավորելու համար",
                "sSortDescending": ": ակտիվացրեք նվազման կարգով դասավորելու համար"
            }
        }
    }).api();

    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $(document).on("click", ".dashboard", function () {
        $checked = $('.permissions:checked');
        if ($checked.length > 0) {
            $(this).parent().parent().submit();
        } else {
            $('.modal-title').css('color', '#fd397a');
        }
    });

    $(document).on("click", ".delete", function (e) {
        swal.fire({
            title: "Դուք համոզվա՞ծ եք:",
            text: "Դուք չեք կարողանա վերականգնել այն հետագայում:",
            type: "error",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonClass: "btn m-btn--pill m-btn--air btn-danger m-btn--bolder",
            confirmButtonText: "<i class='la la-trash'></i> Այո, հեռացնել",
            cancelButtonClass: "btn m-btn--pill m-btn--air btn-secondary",
            cancelButtonText: "Չեղարկել"
        }).then((result) => {
            if (result.value) {
                $title = $(this).attr('data-title');
                $url = $(this).parent().attr('action');
                if (typeof $title !== 'undefined') {
                    $url = $title + "Check";
                    $_id = $(this).prev('[name=_id]').val();
                    $.ajax({
                        url: '/backend/' + $url,
                        type: 'POST',
                        context: {element: $(this)},
                        data: {_token: CSRF_TOKEN, id: $_id, type: $title},
                        dataType: 'JSON',
                        success: function (data) {
                            if (data.success) {
                                swal.fire({
                                    title: "Հեռացվող տարրը միացած է մեկ այլ գործառույթի: Դուք համոզվա՞ծ եք:",
                                    // text: "Դուք չեք կարողանա վերականգնել այն հետագայում:",
                                    type: "error",
                                    showCancelButton: true,
                                    buttonsStyling: false,
                                    confirmButtonClass: "btn m-btn--pill m-btn--air btn-danger m-btn--bolder",
                                    confirmButtonText: "<i class='la la-trash'></i> Այո, հեռացնել",
                                    cancelButtonClass: "btn m-btn--pill m-btn--air btn-secondary",
                                    cancelButtonText: "Չեղարկել"
                                }).then((result) => {
                                    if (result.value) {
                                        this.element.parent().submit();
                                    }
                                });
                            } else {
                                this.element.parent().submit();
                            }
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                    // } else {
                    //     this.element.parent().submit();
                }else
                    $(this).parent().submit();
            }
        });
    });

});


