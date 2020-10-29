<template>
  <div class="container-fluid">
   <MenuComponent v-bind:categories="categories" @changeCurrentView="changeView($event)"></MenuComponent>
   <MainDynamicViewComponent v-bind:currentView="currentView"></MainDynamicViewComponent>
  </div>
</template>

<script>
import MenuComponent from "./MenuComponent";
import MainDynamicViewComponent from "./MainDynamicViewComponent";

export default {
  name: "MainViewComponent",
  props:[
    'categories'
  ],
  data: function () {
    return {
        currentView: ""
    }
  },

  methods: {
    changeView: function (viewName) {
      this.currentView = viewName;
    }
  },

  components: {MenuComponent, MainDynamicViewComponent}
}
</script>

<style scoped>

</style>