<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4>
          Report
          <button
            class="btn btn-sm btn-primary"
            type="button"
            @click="generatePdf"
          >Generate PDF</button>
        </h4>
      </div>

      <div class="col-md-8" id="pdf">
        <h4>Name : {{ datas.name.toUpperCase() }}</h4>
        <table class="table table-sm table-stripped">
          <thead>
            <tr>
              <th>Year</th>
              <th>Invested</th>
              <th>Yearly Yield</th>
              <th>Accumulated Yield</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(data,index) in datas.output_data" :key="index">
              <td>{{ data.year }}</td>
              <td>{{ data.investedAmount | toCurrency }}</td>
              <td>{{ data.yearly_yield | toCurrency }}</td>
              <td>{{ data.accumulated_yield | toCurrency }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <barChart
          v-if="datas.desired_pension_amount_month_wise > 0 & datas.calculated_amount_month_wise >0"
          :pension_amount_month_wise="datas.desired_pension_amount_month_wise"
          :calculated_amount_month_wise="datas.calculated_amount_month_wise"
        ></barChart>
        <br />
      </div>
    </div>
  </div>
</template>
<script>
import barChart from "@/components/bar-chart";
import axios from "axios";
import jspdf from "jspdf";

export default {
  components: {
    barChart
  },
  filters: {
    toCurrency(value) {
      if (typeof value !== "number") {
        return value;
      }
      var formatter = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "USD",
        minimumFractionDigits: 2
      });
      return formatter.format(value);
    }
  },
  data() {
    return {
      datas: "",
      isBusy: true
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    generatePdf() {
      var doc = new jspdf();
      var quotes = document.getElementById("pdf");
      // ...
      var specialElementHandlers = {
        "#elementH": function(element, renderer) {
          console.log(element);
          console.log(renderer);
          return true;
        }
      };
      // ...

      doc.fromHTML(quotes, 10, 10, {
        width: 170,
        elementHandlers: specialElementHandlers
      });
      doc.save("a4.pdf");
    },
    getData() {
      var vm = this;

      axios
        .get(`http://127.0.0.1:8000/api/info/${this.$route.params.id}`)
        .then(resp => {
          vm.datas = resp.data;
          vm.isBusy = false;
        });
    }
  }
};
</script>
