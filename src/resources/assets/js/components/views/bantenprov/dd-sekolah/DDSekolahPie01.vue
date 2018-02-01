<template>
  <div style="width: 100%; height: 400px;">
    <IEcharts :option="pie"></IEcharts>
  </div>
</template>

<script>
import IEcharts from 'vue-echarts-v3/src/full.js';

export default {
  components: {
    IEcharts
  },
  data () {
    return {
      pie: {
        backgroundColor: '#fff',
        title: {
          text: 'ECharts pie',
          left: 'center',
          top: 20,
          textStyle: {
            color: '#000'
          }
        },
        tooltip: {
          show: true,
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        visualMap: {
          show: false,
          min: 100,
          max: 600,
          inRange: {
            colorLightness: [0, 1]
          }
        },
        series : [
          {
            type:'pie',
            radius : '55%',
            center: ['50%', '50%'],
            /*data:[
                {},
                {},
                {},
                {},
                {},
                {},
            ].sort(function (a, b) { return a.value - b.value; }),*/
            data:[].sort(function (a, b) { return a.value - b.value; }),
            roseType: 'radius',
            label: {
              normal: {
                textStyle: {
                  color: '#444'
                }
              }
            },
            labelLine: {
              normal: {
                lineStyle: {
                  color: '#444'
                },
                smooth: 0.2,
                length: 10,
                length2: 5
              }
            },
            itemStyle: {
              normal: {
                color: '#2196f3',
                shadowBlur: 200,
                shadowColor: 'rgba(255, 205, 210, 0.25)'
              }
            },

            animationType: 'scale',
            animationEasing: 'elasticOut',
            animationDelay: function (idx) {
              return Math.random() * 200;
            }
          }
        ]
      }
    }
  },
  mounted: function () {
    axios.get('/json/bantenprov/dd-sekolah/dd-sekolah-pie-010.json').then(response => {

      let ke = 0;

      var res = response.data;

      this.pie.series[0].data = res[0].series[0].data;
      this.pie.title.text = res[0].xAxis.region + ' ' + res[0].xAxis.name + ' ' + res[0].xAxis.yyyy;

      // interval
      let i = 0;

      setInterval(() => {

        this.pie.series[0].data = res[i].series[0].data;
        this.pie.title.text = res[i].xAxis.region + ' ' + res[i].xAxis.name + ' ' + res[0].xAxis.yyyy;

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
