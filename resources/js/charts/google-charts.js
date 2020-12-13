"use strict";
// Class definition

let _token = $('meta[name=csrf-token]').attr('content');


let initPieChart = (result, id) => {
    let data = google.visualization.arrayToDataTable(result);

    let options = {
        colors: ['#2abe81', '#593ae1', '#fe3995', '#f6aa33', '#6e4ff5', '#2abe81', '#c7d2e7', '#593ae1']
    };

    let chart = new google.visualization.PieChart(document.getElementById(id));
    chart.draw(data, options);
};

let initColumnChart = (result, id) => {
    let data = google.visualization.arrayToDataTable(result);

    let options = {
        hAxis: {
            title: 'Դասընթացի տեսակներ',
        },
        vAxis: {
            title: 'Դասընթացի քանակ'
        },
        legend: {position: 'none'}
    };

    let chart = new google.visualization.ColumnChart(document.getElementById(id));
    chart.draw(data, options);
};

var GoogleCharts = function () {
    var main = function () {
        google.load('visualization', '1', {
            packages: ['corechart', 'bar', 'line']
        });

        google.setOnLoadCallback(function () {
            GoogleCharts.runDemos();
        });
    };

    let courseTypes = function () {
        $.ajax({
            url: '/backend/course/result-speciality',
            data: {
                _token
            },
            success: function (data) {
                let table = [['Տեսակ', 'Քանակ', {role: 'style'}]];
                if (data.length) {
                    for (let k in data) {
                        table.push(data[k]);
                    }
                    initColumnChart(table, 'kt_gchart_1');
                }
            }
        });
    };

    let paidAccounts = function () {
        $.ajax({
            url: '/backend/course/result',
            data: {
                _token,
                paid: true
            },
            success: function (data) {
                let table = [['Տեսակ', 'Մասնակիցներ']];

                if (data.length) {
                    for (let k in data) {
                        if (data[k]['paid'] == 1) {
                            table.push(['Վճարովի', data[k]['total']]);
                        } else {
                            table.push(['Անվճար', data[k]['total']]);
                        }
                    }
                    initPieChart(table, 'kt_gchart_3');
                }
            }
        });
    };

    let courseResultsTime = function () {
        $.ajax({
            url: '/backend/course/result',
            data: {
                _token,
                time: true
            },
            success: function (data) {
                let table = [['Տեսակ', 'Մասնակիցներ']];

                if (data) {
                    for (let k in data) {
                        table.push([`Հաղթահարել են ${data[k]['count']} անգամից`, data[k]['total']]);
                    }

                    initPieChart(table, 'kt_gchart_5');
                }
            }
        });
    };

    let courseResults = function () {
        $.ajax({
            url: '/backend/course/result',
            data: {
                _token
            },
            success: function (data) {
                let table = [['Տեսակ', 'Մասնակիցներ']];
                if (data) {
                    for (let k in data) {
                        if (data[k].status == 'success') {
                            table.push(['Հաղթահարել են', data[k]['total']]);
                        } else {
                            table.push(['Կտրվել են', data[k]['total']]);
                        }
                    }

                    initPieChart(table, 'kt_gchart_4');
                }
            }
        });
    };

    return {
        init: function () {
            main();
        },

        runDemos: function () {
            courseTypes();
            paidAccounts();
            courseResults();
            courseResultsTime();
        }
    };
}();

GoogleCharts.init();