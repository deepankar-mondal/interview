<template>
  <div class="row">
    <div class="col-md-12">
      <h3>
        <small>Total Saving is</small>
        {{ totalSavings | toCurrency}}
        <small>in</small>
        {{totalTenture}}
        <small>Yrs</small>
      </h3>
      <hr />
    </div>
    <div class="col-md-6">
      <table class="table table-sm text-center">
        <thead class="thead-light">
          <tr>
            <th>Year</th>
            <th>Invested Amount</th>
            <th>Yearly Yield</th>
            <th>Accumulated Yield</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="data in savingResultData" :key="data">
            <td>{{ data.year }}</td>
            <td>{{ data.investedAmount | toCurrency}}</td>
            <td>{{ data.yearly_yield | toCurrency }}</td>
            <td>{{ data.accumulated_yield | toCurrency}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6">
      <barChart
        v-if="pension_amount_month_wise > 0 & calculated_amount_month_wise >0"
        :pension_amount_month_wise="pension_amount_month_wise"
        :calculated_amount_month_wise="calculated_amount_month_wise"
      ></barChart>
      <h1>Save the information</h1>

      <form action @submit.prevent="saveData">
        <div class="form-group">
          <label for>Name</label>
          <input class="form-control" type="text" placeholder="Enter Your Name" v-model="form.name" />
        </div>
        <button class="btn btn-primary btn-sm">Save the Info</button>
      </form>
    </div>
  </div>
</template>
<script>
import barChart from "@/components/bar-chart";
import axios from 'axios';
export default {
  props: ["data1"],
  components: {
    barChart: barChart
  },
  data() {
    return {
      showSavingResultTable: false,
      savingResultData: [],
      RetirementAge: 65,
      RetirementDuration: 25,
      target: 0,
      totalSavings: 0,
      totalTenture: 0,
      form: {
        name: ""
      },
      pension_amount_month_wise: 0,
      accumulated_yield: 0,
      calculated_amount_month_wise: 0
    };
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
  mounted() {
    this.calculateResult();
  },
  methods: {
    saveData(){
      var form = {
          name       : this.form.name,
          input_data : this.data1,
          output_data : this.savingResultData,
          calculated_amount_month_wise: this.calculated_amount_month_wise,
          accumulated_yield: this.accumulated_yield,
          desired_pension_amount_month_wise: this.pension_amount_month_wise
      }
      console.log(form);
      axios.post('http://127.0.0.1:8000/api/save-info',form)
      .then(resp => {
        console.log(resp);
      })
    },
    calculateResult() {
      this.setTotalSaving();
      this.setSavingResultTableData();
      this.setDesiredAndTargetData();
    },
    setDesiredAndTargetData() {
      let month_wise =
        (this.data1.income * this.data1.pension_amount * 0.01) / 12;
      let acc_month_wise = this.accumulated_yield / (12 * 25);
      this.pension_amount_month_wise = Math.round(month_wise);
      this.calculated_amount_month_wise = Math.round(acc_month_wise);
    },
    setTotalSaving() {
      this.totalTenture = this.RetirementAge - this.data1.age;
      this.totalSavings =
        this.totalTenture *
        parseInt(this.data1.saving_amount * this.data1.income * 0.01);
    },
    setSavingResultTableData() {
      let year = 0;
      let invested_amount = 0;
      let invest = parseInt(this.data1.saving_amount * this.data1.income * 0.01);
      let current_age = this.data1.age;
      while (current_age <= this.RetirementAge) {
        current_age++;
        year++;
        invested_amount += invest;
        var yearly_yield =
          parseFloat(this.accumulated_yield) *
          (this.data1.yield_on_saving_fund * 0.01);
        this.accumulated_yield = invested_amount + parseFloat(yearly_yield);

        var UserRowData = {
          year: year,
          investedAmount: invest,
          yearly_yield: yearly_yield,
          accumulated_yield: this.accumulated_yield
        };

        this.savingResultData.push(UserRowData);

        if (this.RetirementAge <= current_age) break;
      }
      this.showSavingResultTable = true;
    }
  }
};
</script>