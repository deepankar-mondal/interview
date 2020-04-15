<template>
  <div class="home">
    <b-container class="bv-example-row">
      <b-row>
        <b-col>
          <b-card-group deck>
            <b-card header="Calculate Retirement" header-tag="header" title="Calculate your saving">
              <b-card-text>
                <retirement-calculator-form @form="calculate"></retirement-calculator-form>
              </b-card-text>            
            </b-card>
          </b-card-group>
        </b-col>       
      </b-row>
      <b-row>
        <b-col v-if="showResult">
          <hr>
          <calculate-result :data1="data1"></calculate-result>
        </b-col>
      </b-row>
       
    </b-container>
  </div>
</template>

<script>
// @ is an alias to /src
import RetirementCalculatorForm from "@/components/form";
import CalculateResult from "@/components/result";
export default {
  name: "Home",
  components: {
    RetirementCalculatorForm,
    CalculateResult
  },
  data(){
    return {
        data1: '',
        showResult:false,
    }
  },
  methods:{
    calculate(formData){
      this.data1 = formData;
      this.showResult = true;
    }
  }
};
</script>
