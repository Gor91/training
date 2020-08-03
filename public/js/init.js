$(document).ready(function () {
    var CSRF_TOKEN = $('[name="csrf-token"]').attr('content');

    var lang = {
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
    };
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
        "language": lang,


    }).api();

    var groupColumn = 1, topColumn = 2;
    var t = $('#example').DataTable({
        "columnDefs": [
            {"visible": false,
                "targets": [topColumn,groupColumn]}
        ],
        "order": [[topColumn, 'asc'], [groupColumn, 'asc']],
        "language": lang,
        "rowGroup": {
            dataSrc: [ topColumn, groupColumn ]
        },

        "drawCallback": function (settings) {
            var api = this.api();
            var rows = api.rows({page: 'current'}).nodes();
            var last = null;

            // api.column(groupColumn, {page: 'current'}).data().each(function (group, i) {
            //     if (last !== group) {
            //         $(rows).eq(i).before(
            //             '<tr class="group"><td colspan="5">' + group + '</td></tr>'
            //         );
            //
            //         last = group;
            //     }
            // });
        }
    });

    // Order by the grouping
    $('#example tbody').on('click', 'tr.group', function () {
        var currentOrder = t.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            t.order([groupColumn, 'desc']).draw();
        } else {
            t.order([groupColumn, 'asc']).draw();
        }
    });
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
                console.log(data.spec)

                if ($sub.find('option').length > 1)
                    $sub.find('option').remove();

                for (var i in data.spec) {
                    // $sub.append(' <optgroup class="text-capitalize" label="' + i + '" ></optgroup>');

                    // for (var item in data.spec[i]) {
                        $sub.append(' <option class="text-capitalize" value="' + i + '">' + data.spec[i] + '</option>')

                        // }
                    // }
                }
            },
            error: function (data) {
                console.log(data);
            }
        });

    });
    $(document).on('change', "#type", function () {
        $type_id = $(this).val();
        $.ajax({
            url: '/spec',
            type: 'POST',
            context: {element: $(this)},
            data: {_token: CSRF_TOKEN, id: $type_id},
            dataType: 'JSON',
            success: function (data) {
                $sub = this.element.parent().parent().next().find('#parent_id');
                // alert($sub.find('option').length)

                if ($sub.find('option').length > 0)
                    $sub.html("");
                $sub.append(' <option class="text-capitalize" value="">' + "" + '</option>');
                for (var item in data.spec) {
                    if (data.spec.hasOwnProperty(item))
                        $sub.append(' <option class="text-capitalize" value="' + item + '">' + data.spec[item] + '</option>')
                }
            },
            error: function (data) {
                console.log(data);
            }
        });

    });
    $("#course_videos").select2();
    $("#special").select2({
        placeholder: "Ընտրեք մասնագիտություն",
        tags: true,
        ajax: {
            dataType: "json",
            method: 'GET',
            url: "courses/getSpecialities",
            processResults: function (data) {
                var select_result = [];
                var final_data = {};
                if (data) {
                    $.each(data, function (key, value) {
                        final_data["id"] = key;
                        final_data["text"] = key;
                        final_data["children"] = [];
                        for (var i = 0; i < value.length; i++) {
                            final_data["children"].push(value[i])
                        }
                        select_result.push(final_data)
                        final_data = {};

                    })
                }
                return {results : select_result }
            }
        }
    });

    $(document).on('click', '.edit', function () {

        $(this).parent().parent().siblings().children().attr('disabled', false).css('border','1px solid #7197ec');
        $(this).nextAll().css('display', 'none');
        $(this).siblings('.save').css('display', 'inline-block');

        $(this).siblings('.save_app').css('display', 'inline-block');
        $(this).siblings('.save_prop').css('display', 'inline-block');

        $(this).siblings('.cancel').css('display', 'inline-block');
        $(this).css('display', 'none');
    });
    $(document).on('click', '.save', function () {
        $id = $(this).siblings('.id').val();
        $url = $(this).siblings('.url').val();

        $siblings = $(this).parent().parent().prev().children();
        var name = $siblings.val();
        console.log(name);
        $.ajax({
            url: $url,
            type: 'POST',
            context: {element: $(this)},
            data: {
                _token: CSRF_TOKEN,
                id: $id,
                name: name
            },
            dataType: 'JSON',
            success: function (data) {
                this.element.parent().parent().siblings('td').children().attr('disabled', true);
                this.element.siblings('').css('display', 'inline-block');
                this.element.siblings('.cancel').css('display', 'none');
                this.element.css('display', 'none');
                location.reload();
            },
            error: function (data) {
                console.log(data)
            }
        });
    });
    $(document).on('click', '.cancel', function () {
        $(this).parent().siblings('td').children().attr('disabled', true);
        $(this).siblings('').css('display', 'inline-block');
        $(this).siblings('.save').css('display', 'none');

        $(this).siblings('.save_app').css('display', 'none');
        $(this).siblings('.save_prop').css('display', 'none');

        $(this).css('display', 'none');
    })
})
;


