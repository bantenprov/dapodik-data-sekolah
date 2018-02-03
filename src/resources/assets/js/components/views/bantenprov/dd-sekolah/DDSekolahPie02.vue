<template>
  <div style="width: 100%; height: 400px;">
    <IEcharts :option="pie" :resizable="true"></IEcharts>
  </div>
</template>

<script>
export default {
  data () {
    return {
      pie: {
        title: {
          show: true,
          text: '',
          x: 'center',
          textStyle: {
            fontSize: 16,
            fontWeight: 'normal',
            fontStyle: 'normal',
            color: '#fff'
          }
        },
        tooltip: {
          show: true
        },
        toolbox: {
          show : true,
          orient : 'horizontal',
          bottom: 0,
          x: 'center',
          feature : {
            dataView: {
              show: true,
              lang: ['Data view', 'Cancel', ''],
              readOnly: true,
              backgroundColor: 'rgba(0,0,0,.65)',
              textareaColor: 'rgba(0,0,0,.5)',
              textareaBorderColor: 'rgba(0,0,0,.5)',
              textColor: '#fff',
              buttonColor: '#ddd',
              buttonTextColor: '#333'
            },
            saveAsImage: {
              show: true,
              backgroundColor: 'transparent',
              excludeComponents: ['toolbox', 'visualMap']
            }
          },
          iconStyle: {
            borderWidth: 1,
            borderType: 'solid',
            borderColor: '#fff'
          }
        },
        visualMap: {
          show: true,
          type: 'continuous',
          orient: 'horizontal',
          bottom: 30,
          x: 'center',
          min: 100,
          max: 700,
          text: ['High', 'Low'],
          calculable : false,
          inRange: {
            color: ['#B9F6CA', '#69F0AE', '#00C853'],
          },
          textStyle: {
            color: '#fff'
          }
        },
        series: [{
          type:'pie',
          data:[].sort(function (a, b) { return a.value - b.value; }),
          radius: '55%',
          roseType: 'rose',
          cursor: 'default',
          itemStyle: {
            color: '#CDDC39'
          },
          label: {
            show: true,
            fontSize: 8,
            fontWeight: 'normal',
            fontStyle: 'normal',
            color: '#fff'
          },
          labelLine: {
            show: true,
            length: 10,
            lineStyle: {
              width: 1,
              type: 'solid',
              color: '#fff'
            }
          },
          animationType: 'scale',
          animationEasing: 'elasticOut',
          animationDelay: function (idx) {
            return Math.random() * 200;
          }
        }]
      }
    }
  },
  mounted: function () {

    axios.get('/json/bantenprov/dd-sekolah/dd-sekolah-pie-020.json').then(response => {

      let ke = 0;

      var res = response.data;

      this.pie.series[0].data = res[0].series[0].data;
      this.pie.title.text = res[0].xAxis.region + ' ' + res[0].xAxis.name + ' ' + res[0].xAxis.category;

      // interval
      let i = 0;

      setInterval(() => {

        this.pie.series[0].data = res[i].series[0].data;
        this.pie.title.text = res[i].xAxis.region + ' ' + res[i].xAxis.name + ' ' + res[i].xAxis.category;

        i++;

        if(i == res.length)
        {
          i = 0;
        }

      },4000);

    })
    .catch(function(error) {
      // error
    });
  }
}
</script>
