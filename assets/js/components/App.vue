<template>
  <div class="container-fluid">
    <MenuComponent v-on:passInformation="passInformation" v-bind:categories="categories"></MenuComponent>
    <LevelComponent v-on:passLevel="passLevel" v-if="this.show === true"></LevelComponent>
    <PackageListComponent v-bind:level="levelName" v-bind:category="categoryId" v-if="levelName !== null"></PackageListComponent>
  </div>
</template>

<script>
import MenuComponent from "./MenuComponent";
import LevelComponent from "./LevelComponent";
import PackageListComponent from "./PackageListComponent";

export default {
  name: "App",
  data(){
    return {
      categories: [],
      show: false,
      categoryId: null,
      levelName: null
    }
  },
  components: {PackageListComponent, LevelComponent, MenuComponent},
  created() {
    this.getCategories()
  },
  methods:{
    getCategories() {
      let request = new Request('http://localhost:8000/category', {method: 'GET'});
      fetch(request).then(function(response) {
        return response.text();
      }).then((responseText) => {
        this.categories = JSON.parse(responseText).categories
      });
    },
    passInformation(id, showBool) {
      this.show = showBool;
      this.categoryId = id;
    },
    passLevel(level) {
      this.levelName = level;
      console.log(level != null);
    }
  },
}
</script>

<style scoped>

</style>