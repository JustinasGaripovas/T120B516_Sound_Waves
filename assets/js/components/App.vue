<template>
  <div class="container-fluid background">
    <MenuComponent v-on:passInformation="passInformation" v-bind:categories="categories"></MenuComponent>
    <div v-if="showButtons">
      <LevelComponent v-on:passLevel="passLevel" v-if="this.show === true"></LevelComponent>
      <PackageListComponent v-bind:level="levelName" v-bind:category="categoryId"></PackageListComponent>
    </div>
    <router-view v-on:flag="flag"></router-view>
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
      levelName: null,
      showButtons: true
    }
  },
  components: {PackageListComponent, LevelComponent, MenuComponent},
  created() {
    this.getCategories()
  },
  methods:{
    flag() {
      this.showButtons = !this.showButtons;
    },
    getCategories() {
      let request = new Request('/category', {method: 'GET'});
      fetch(request).then(function(response) {
        return response.text();
      }).then((responseText) => {
        this.categories = JSON.parse(responseText).categories
      });
    },
    passInformation(id, showBool) {
      this.show = showBool;
      this.categoryId = id;
      console.log(this.categoryId);
      if (!this.showButtons) {
        this.showButtons = true;
      }
    },
    passLevel(level) {
      this.levelName = level;
      console.log(level != null);
      console.log(level);
    }
  },
}
</script>

<!--<style scoped>-->
<!--.background{-->
<!--  height: 30em;-->
<!--  background: url("/files/unnamed.png") no-repeat;-->
<!--&lt;!&ndash;}&ndash;&gt;-->
<!--</style>-->