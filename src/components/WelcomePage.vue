<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <p>{{name}}</p>
  </div>
</template>

<script>
// import { bus } from "../main";
import Store from "../store/store";
export default {
  name: "WelcomePage",
  props: {
    msg: String,
  },
  data(){
    return{
      name:null,
      getUserData: null,
    }
  },
  methods: {


getData(){
  this.name = Store.userData;
}

    // emitData() {
    //   bus.$on("name", (data) => {
    //     this.name = data;
    //     console.log("data", data);
    //   });
    //   // bus.$emit("data");
    // },



  },
  mounted() {
    // this.emitData();
    this.getData();
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>
