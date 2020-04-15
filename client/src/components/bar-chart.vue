<template>
  <div>
    
    <vue-highcharts :highcharts="Highcharts" :options="drilldownOptions" ref="drilldownChart" v-if="load"></vue-highcharts>
  

  </div>
</template>
 
<script>
import VueHighcharts from 'vue2-highcharts'
import Drilldown from "highcharts/modules/drilldown.js";
import Highcharts from "highcharts";
Drilldown(Highcharts);
export default{
    components: {
        VueHighcharts
    },
    props:['calculated_amount_month_wise','pension_amount_month_wise'],
    data(){
      return{
        load: false,
        Highcharts: Highcharts,
        drilldownOptions: {
          chart: {
            type: "column"
          },
          title: {
            text: "Desired vs Calculated Pension"
          },
          xAxis: {
            type: "Pension"
          },
          legend: {
              layout: "vertical",
              align: "right",
              verticalAlign: "top",
              x: -40,
              y: 80,
              floating: true,
              borderWidth: 1,
              backgroundColor:
                (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || "#FFFFFF",
              shadow: true
            },
            plotOptions: {
            series: {
              borderWidth: 0,
              dataLabels: {
                enabled: true
              }
            }
          },
          series: [
            {
              data: [
                {
                  name: "Desired Pension",
                  y: 5,
                  
                },
                {
                  name: "Saving Calculate Pension",
                  y: 2,
                  
                },
               
              ]
            }
          ],
      
        },
        
      }
    },
    mounted(){
      this.setData();
    },
    methods:{
        setData() {
                   
          this.drilldownOptions.series[0].data[1].y  = this.calculated_amount_month_wise;
          this.drilldownOptions.series[0].data[0].y = this.pension_amount_month_wise;
          
          this.load =true;
        }
    }
}
</script>