$(document).ready(function () {

    var CSRF_TOKEN = $('[name="csrf-token"]').attr('content');
    var url = '/js/hy_table.json';

    var lang = getJSONData(url);

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
            {
                "visible": false,
                "targets": [topColumn, groupColumn]
            }
        ],
        "order": [[topColumn, 'asc'], [groupColumn, 'asc']],
        "language": lang,
        "rowGroup": {
            dataSrc: [topColumn, groupColumn]
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
        var url_swal = '/js/hy_swal.json';
        var _swal = getJSONData(url_swal);
        swal.fire(_swal.ready).then((result) => {
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
                                swal.fire(_swal.delete).then((result) => {
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
    $(document).on('change', "#prof, #type", function () {
        $spec_id = $(this).val();
        $.ajax({
            url: '/edu',
            type: 'POST',
            context: {element: $(this)},
            data: {_token: CSRF_TOKEN, id: $spec_id},
            dataType: 'JSON',
            success: function (data) {
                $sub = this.element.parent().parent().next().find('#edu');
                console.log(data.spec)

                if ($sub.find('option').length > 0)
                    $sub.find('option').remove();

                for (var i in data.spec) {
                    if (data.spec.hasOwnProperty(i))
                        $sub.append(' <option class="text-capitalize" value="' + data.spec[i].id + '">' + data.spec[i].name + '</option>')
                }
            },
            error: function (data) {
                console.log(data);
            }
        });

    });
    $(document).on('change', "#edu", function () {
        $edu_id = $(this).val();
        $.ajax({
            url: '/spec',
            type: 'POST',
            context: {element: $(this)},
            data: {_token: CSRF_TOKEN, id: $edu_id},
            dataType: 'JSON',
            success: function (data) {
                $sub = this.element.parent().parent().next().find('#spec');
                // alert($sub.find('option').length)

                if ($sub.find('option').length > 0)
                    $sub.html("");
                $sub.append(' <option class="text-capitalize" value="A">' + "" + '</option>');
                for (var item in data.edu) {
                    if (data.edu.hasOwnProperty(item))
                        $sub.append(' <option class="text-capitalize" value="' + data.edu[item].id + '">' + data.edu[item].name + '</option>')
                }
            },
            error: function (data) {
                console.log(data);
            }
        });

    });

    $("#course_videos,#course_books").select2();
    $("#special").select2({
        placeholder: "Ընտրեք մասնագիտություն",
        tags: true,
        ajax: {
            dataType: "json",
            method: 'GET',
            url: "/backend/specialty/list",
            processResults: function (data) {
                let select_result = [];
                let final_data = [];
                if (data) {
                    $.each(data, function (key, value) {
                        final_data["id"] = value['id'];
                        final_data["text"] = value['name'];
                        final_data["children"] = [];

                        if (value['children'] && value['children'].length) {
                            let children_value = value['children'];

                            for (let i in children_value) {
                                let children = [];

                                children["id"] = children_value[i]['id'];
                                children["text"] = children_value[i]['name'];
                                final_data["children"].push(children)
                            }
                        }
                        select_result.push(final_data);
                        final_data = [];
                    })
                }
                return {results: select_result}
            }
        }
    });

    $('#fileuploader-image').on('change', function () {
        let fileReader = new FileReader();
        let view_image = $('#view_image');
        let show_cert_image = $('#show_cert_image');

        if ($(this).prop('files').length == 0) {
            view_image.attr('src', '');
            view_image.attr('hidden', 'hidden');
            show_cert_image.attr('hidden', 'hidden');
            return;
        }

        fileReader.readAsDataURL($(this).prop('files')[0]);
        fileReader.onload = function () {
            var data = fileReader.result;
            if (fileReader.result.indexOf('data:image') !== -1) {
                view_image.attr('src', data);
                view_image.removeAttr('hidden');
                show_cert_image.removeAttr('hidden');
            }
        };
    });

    function init_editor() {
        new FroalaEditor('textarea.froala-editor', {
            imageUploadToS3: {
                bucket: 'natmedpalace',
                uploadURL: 'https://natmedpalace.s3.amazonaws.com',
                region: 'us-west-2',
                keyStart: 'uploads/test/images',
                params: {
                    acl: 'public-read', // ACL according to Amazon Documentation.
                    accessKey: 'AKIA4BPCYKMDDCLDSJVK',
                    secretKey: 'WtAyUoUcXgUykRTkXUAUP8gY1ibnHyGFUGdmNERm'
                }
            },
            placeholderText: $(this).attr('placeholder'),
            imageEditButtons: ['imageDisplay', 'imageAlign', 'imageRemove']
        })
    }

    FroalaEditor.DefineIcon('imageInfo', {NAME: 'info', SVG_KEY: 'help'});
    FroalaEditor.RegisterCommand('imageInfo', {
        title: 'Info',
        focus: false,
        undo: false,
        refreshAfterCallback: false,
        callback: function () {
            var $img = this.image.get();
            alert($img.attr('src'));
        }
    });

    init_editor();

    $("#courses").select2({
        placeholder: $('#courses').data('placeholder'),
        tags: true,
        ajax: {
            dataType: "json",
            method: 'GET',
            url: "test/getCourses",
            processResults: function (data) {
                var select_result = [];
                var final_data = {};
                if (data) {
                    $.each(data, function (key, value) {
                        final_data["children"] = [];
                        for (var i = 0; i < value.length; i++) {
                            final_data["children"].push(value[i])
                        }
                        select_result.push(final_data);
                        final_data = {};

                    })
                }
                return {results: select_result}
            }
        }
    });

    $(".select2-selection__arrow").hide();
    $("#select2-courses-container").css("display", "inline");

    $(function () {
        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();
            var t = $('.custom_counter_g').length;

            var template = '<div class="entry input-group custom_counter_g"><div class="col-sm-10">\
                        <textarea class="form-control froala-editor"\
                    name="fields[' + t + '][inp]"\
                    placeholder="Պատասխան"\
                    type="text"></textarea></div>\
                        <div class="col-sm-1">\
                        <span class="input-group-btn">\
                        <button class="btn btn-danger btn-remove" type="button">\
                        <span class="fa fa-minus"></span>\
                        </button>\
                        </span>\
                        </div>\
                        <div class="col-sm-1">\
                        <input type="checkbox" name="fields[' + t + '][check]" id="check_' + t + '" value="1" class="form-check-input">\
                        <label class="form-check-label" title="Նշել որպես ճիշտ" for="check_' + t + '"></label>\
                        </div>\
                        </div>\
                        </div>';
            var dynaForm = $('.dynamic-wrap:first');
            $($.parseHTML(template)).appendTo(dynaForm);
            init_editor();
        }).on('click', '.btn-remove', function (e) {
            $(this).parents('.entry:first').remove();
            e.preventDefault();
            return false;
        });
    });

    $('input, select, textarea').on('change', function () {
        if ($(this).hasClass('is-invalid')) {
            $(this).removeClass('is-invalid')
        }
    });

    $(document).on('click', '.edit', function () {

        $(this).parent().parent().siblings().children().attr('disabled', false).css('border', '1px solid #7197ec');
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
    });
    $(document).on('click', '.remove_diploma', function () {
        $diploamas = $(this).parent().siblings('.diplomas');
        $diploma = $(this).next().find('img').attr('src');
        $i = $diploma.slice($diploma.lastIndexOf('/') + 1);
        $diploamas.val($diploamas.val().replace($i, ''));
        $(this).parent().remove();
    });

    $(document).on('click', ".unread", function () {
        $comment_id = $(this).attr('id');
        $.ajax({
            url: '/commentstatus',
            type: 'POST',
            context: {element: $(this)},
            data: {_token: CSRF_TOKEN, id: $comment_id},
            dataType: 'JSON',
            success: function (data) {
                alert(data);

            },
            error: function (data) {
                console.log(data);
            }
        });

    })

    function getJSONData(data_url) {
        var result;
        $.ajax({
            async: false,
            url: data_url,
            dataType: 'json',
            success: function (r) {
                result = r;
            }
        });

        return result;
    }
})
;


