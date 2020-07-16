$(document).ready(function () {
    var CSRF_TOKEN = $('[name="csrf-token"]').attr('content');


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

    t.on('order.dt search.dt', function () {
        t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();


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
                } else
                    $(this).parent().submit();
            }
        });
    });
    $(document).on('change', "#w_region, #h_region", function () {

        $region_id = $(this).val();
        $.ajax({
            url: '/territory',
            type: 'POST',
            context: {element: $(this)},
            data: {_token: CSRF_TOKEN, id: $region_id},
            dataType: 'JSON',
            success: function (data) {
                $id = this.element.attr('id');
                $territory = ($id === "h_region") ? '#h_territory' : '#w_territory';
                $sub = this.element.parent().parent().next().find($territory);
                console.log($sub.find('optgroup').length);
                if ($sub.find('optgroup').length > 0)
                    $sub.find('optgroup').remove();


                for (var i in data) {
                    if (data.hasOwnProperty(i)) {
                        for (var item of data[i]) {
                            $sub.append(' <optgroup class="text-capitalize" label="' + item.name + 'ի համայնք" id="' + item.id + '"></optgroup>');

                            if (item.residence.length !== 0) {
                                for (var r of item.residence)

                                    $sub.find('#' + item.id).append(' <option class="text-capitalize" value="' + r.id + '">' + r.name + '</option>')
                            } else
                                $sub.find('#' + item.id).append(' <option class="text-capitalize" value="' + item.id + '">' + item.name + '</option>')


                        }
                    }

                }
            },
            error: function (data) {
                console.log(data);
            }
        });

    });
    $(document).on('change', "#prof", function () {
        $spec_id = $(this).val();
        $.ajax({
            url: '/spec',
            type: 'POST',
            context: {element: $(this)},
            data: {_token: CSRF_TOKEN, id: $spec_id},
            dataType: 'JSON',
            success: function (data) {
                $sub = this.element.parent().parent().next().find('#specialty_id');
                alert($sub.find('option').length)

                if ($sub.find('optgroup').length >0)
                    $sub.html("");

                for (var i in data.spec) {
                    $sub.append(' <optgroup class="text-capitalize" label="' + i + '" id="spec"></optgroup>');

                    for (var item in data.spec[i]) {
                        $sub.find("#spec").append(' <option class="text-capitalize" value="' + item + '">' + data.spec[i][item] + '</option>')

                        // }
                    }
                }
            },
            error: function (data) {
                console.log(data);
            }
        });

    })
});


