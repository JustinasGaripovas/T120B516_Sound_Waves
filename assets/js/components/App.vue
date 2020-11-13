<template>
  <div class="container-fluid">
    <MenuComponent v-on:passInformation="passInformation" v-bind:categories="categories"></MenuComponent>
    <div class="container-fluid">
      <p class="main-title">Sound Waves</p>
    </div>
    <div v-if="showButtons">
      <LevelComponent v-on:passLevel="passLevel" v-if="this.show === true && this.showSub === false"></LevelComponent>
      <PackageListComponent v-bind:level="levelName" v-bind:category="categoryId"></PackageListComponent>
    </div>
    <router-view v-on:flag="flag"></router-view>
    <div class="footer"></div>
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
      showButtons: true,
      showSub: false
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
      if (!this.showButtons) {
        this.showButtons = true;
      }
    },
    passLevel(level, boolean) {
      this.levelName = level;
      this.showSub = !this.showSub;
    }
  },
}
</script>

<style scoped>
.main-title{
  font-size: 5em;
  text-align: center;
  border-bottom: 0.03em solid grey;
}
</style>