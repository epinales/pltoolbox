var chart = c3.generate({
    data: {
      x: 'x',
      columns: [
        ['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
        ['data1', 30, 200, 100, 400, 150, 250],
        ['data2', 130, 340, 200, 500, 250, 350]
      ]
    },
    axis: {
      x: {
        type: 'timeseries',
        tick: {
            format: '%Y-%m-%d'
        },
        label: {
          text: 'nombre de la grafica',
          position: 'inner-center'
        },
        tick: {
          rotate: -60
        },
        height: 70
      }
    }
});

var chart1 = c3.generate({
    bindto: '#chart1',
    data: {
      columns: [
        ['data1', 30, 200, 100, 400, 150, 250],
        ['data2', 50, 20, 10, 40, 15, 25]
      ]
    }
});

var chart2 = c3.generate({
    bindto: '#chart2',
    data: {
      columns: [
        ['data1', 30, 200, 100, 400, 150, 250],
        ['data2', 50, 20, 10, 40, 15, 25]
      ]
    }
});

var chart3 = c3.generate({
    bindto: '#chart3',
    data: {
      columns: [
        ['data1', 30, 200, 100, 400, 150, 250],
        ['data2', 50, 20, 10, 40, 15, 25]
      ]
    }
});



//2da pagina

var chart4 = c3.generate({
  bindto: '#chart4',
  data: {
    x: 'x',
    columns: [
      ['x', '2013-01-01', '2013-01-02', '2013-01-03', '2013-01-04', '2013-01-05', '2013-01-06'],
      ['data1', 30, 200, 100, 400, 150, 250],
      ['data2', 130, 340, 200, 500, 250, 350]
    ]
  },
  axis: {
    x: {
      type: 'timeseries',
      tick: {
          format: '%Y-%m-%d'
      }
    }
  }
});

var chart5 = c3.generate({
    bindto: '#chart5',
    data: {
      columns: [
        ['data1', 30, 200, 100, 400, 150, 250],
        ['data2', 50, 20, 10, 40, 15, 25]
      ]
    }
});

var chart6 = c3.generate({
    bindto: '#chart6',
    data: {
      columns: [
        ['data1', 30, 200, 100, 400, 150, 250],
        ['data2', 50, 20, 10, 40, 15, 25]
      ]
    }
});

var chart7 = c3.generate({
    bindto: '#chart7',
    data: {
      columns: [
        ['data1', 30, 200, 100, 400, 150, 250],
        ['data2', 50, 20, 10, 40, 15, 25]
      ]
    }
});



setTimeout(function () {
    chart.load({
        columns: [
            ['data1', 230, 190, 300, 500, 300, 400]
        ]
    });

    chart2.load({
        columns: [
            ['data1', 230, 190, 300, 500, 300, 400]
        ]
    });
}, 1000);

setTimeout(function () {
    chart.load({
        columns: [
            ['data3', 130, 150, 200, 300, 200, 100]
        ]
    });

    chart2.load({
        columns: [
            ['data3', 130, 150, 200, 300, 200, 100]
        ]
    });
}, 1500);

setTimeout(function () {
    chart.unload({
        ids: 'data1'
    });
    chart2.unload({
        ids: 'data1'
    });
}, 2000);
