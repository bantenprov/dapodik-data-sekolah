<template>
  <div style="width: 100%; height: 400px;">
    <IEcharts :option="bar" :loading="loading" :resizable="true"></IEcharts>
  </div>
</template>

<script>
export default {
  data () {
    return {
      loading: false,
      bar: {
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
        xAxis: {
          show: true,
          data: [],
          axisLabel: {
            show: true,
            fontSize: 8,
            fontWeight: 'normal',
            fontStyle: 'normal',
            color: '#fff'
          },
          axisLine: {
            show: true,
            lineStyle: {
              width: 1,
              type: 'solid',
              color: '#fff'
            }
          },
          axisTick: {
            show: true
          },
          splitArea: {
            show: true
          },
          splitLine: {
            show: true,
            lineStyle: {
              width: 1,
              type: 'solid',
              color: '#eee'
            }
          }
        },
        yAxis: {
          show: true,
          axisLabel: {
            show: true,
            fontSize: 8,
            fontWeight: 'normal',
            fontStyle: 'normal',
            color: '#fff'
          },
          axisLine: {
            show: true,
            lineStyle: {
              width: 1,
              type: 'solid',
              color: '#fff'
            }
          },
          axisTick: {
            show: true
          },
          splitArea: {
            show: true
          },
          splitLine: {
            show: true,
            lineStyle: {
              width: 1,
              type: 'solid',
              color: '#eee'
            }
          }
        },
        series: [{
          type: 'bar',
          data: [],
          barWidth: 30,
          barGap: '30%',
          cursor: 'default',
          itemStyle: {
            color: '#FFEB3B'
          }
        }],
        label: {
          show: true,
          position: 'top',
          fontSize: 8,
          fontWeight: 'normal',
          fontStyle: 'normal',
          color: '#fff'
        }
      }
    }
  },
  mounted: function () {
    axios.get('/json/bantenprov/dd-sekolah/dd-sekolah-010.json').then(response => {

      let ke = 0;

      var res = response.data;

      /**
       * response :
       * console.log(res)
       *
       * xAxis
       * console.log(res[0].xAxis.data)
       * console.log(Object.values(res[0].xAxis.data))
       *
       * series data
       * console.log(res[0].series[0].data)
       *
       * region
       * console.log(res[0].xAxis.region)
       *
       * length
       * console.log(res.length);
       */

      this.bar.xAxis.data = Object.values(res[0].xAxis.data);
      this.bar.series[0].data = res[0].series[0].data;
      this.bar.title.text = res[0].xAxis.title;

      // interval
      let i = 0;

      setInterval(() => {

        this.bar.xAxis.data = Object.values(res[i].xAxis.data);
        this.bar.series[0].data = res[i].series[0].data;
        this.bar.title.text = res[i].xAxis.title;

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