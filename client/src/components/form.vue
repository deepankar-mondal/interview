<template>
  <div>
    <b-form @submit.prevent="onSubmit" v-if="show">
      <div class="form group">
        <div class="row">
          <div class="col-md-9">Age:</div>
          <div class="col-md-3 text-right">
            <b-input-group size="sm" append="Yrs">
              <input type="text"  class="form-control" v-model="form.age" />
            </b-input-group>
          </div>
        </div>

        <b-form-input v-model="form.age" type="range" min="25" max="65" required></b-form-input>
      </div>
      <div class="form group">
        <div class="row">
          <div class="col-md-9">Current earnings per year:</div>
          <div class="col-md-3 text-right">
            <b-input-group size="sm" prepend="$">
              <input type="text"  class="form-control form-control-sm" v-model="form.income" />
            </b-input-group>
          </div>
        </div>
        <b-form-input v-model="form.income" type="range" min="10000" max="100000" required></b-form-input>
      </div>
      <div class="form group">
        <div class="row">
          <div class="col-md-9">Desired pension amount:</div>
          <div class="col-md-3 text-right">
            <b-input-group size="sm" prepend="$">
              <input type="text"  class="form-control" v-model="getDesiredAmount" />
            </b-input-group>
          </div>
        </div>
        <b-form-input v-model="form.pension_amount" type="range" min="10" max="200" required></b-form-input>
      </div>
      <div class="form group">
        <div class="row">
          <div class="col-md-9">Amount of savings per year for the retirement:</div>
          <div class="col-md-3 text-right">
            <b-input-group size="sm" append="%">
              <input type="text"  class="form-control" v-model="form.saving_amount" />
            </b-input-group>
          </div>
        </div>
        <b-form-input v-model="form.saving_amount" type="range" min="10" max="50" required></b-form-input>
      </div>
      <div class="form group">
        <div class="row">
          <div class="col-md-9">Default yield on savings fund:</div>
          <div class="col-md-3 text-right">
            <b-input-group size="sm" append="%">
              <input type="text"  class="form-control" v-model="form.yield_on_saving_fund" />
            </b-input-group>
          </div>
        </div>
        <b-form-input v-model="form.yield_on_saving_fund" type="range" min="0.10" max="20" required></b-form-input>
      </div>

      <b-button type="submit" variant="primary">Calculate</b-button>
    </b-form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        age: 25,
        income: 10000,
        pension_amount: 85,
        saving_amount: 10,
        yield_on_saving_fund: 2
      },
      show: true
    };
  },
  computed:{
     getDesiredAmount(){
       return Math.round(this.form.pension_amount * 0.01 * this.form.income);
     }
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      this.$emit("form", this.form);
    }
  }
};
</script>