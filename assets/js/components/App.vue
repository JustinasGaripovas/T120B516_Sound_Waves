<template>
  <div>
    <MainViewComponent v-bind:categories="categories"></MainViewComponent>
  </div>
</template>

<script>
import MainViewComponent from "./MainViewComponent";

export default {
  name: "App",
  components: {MainViewComponent},
  data(){
    return {
      categories: []
    }
  },
  created() {
    this.getCategories()
  },
  methods: {
    getCategories(){
      let request = new Request('http://localhost:8001/category', {method: 'GET'});
      fetch(request).then(function(response) {
        return response.text();
      }).then((responseText) => {
        this.categories = JSON.parse(responseText).categories
        console.log(this.categories)
      });
    }
  }
}
</script>

<style scoped>

</style>