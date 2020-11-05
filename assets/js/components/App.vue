<template>
  <div class="container-fluid">
    <MenuComponent v-on:changeCurrentView="changeCurrentView"></MenuComponent>
    <component :is="dynamicComponent"></component>
  </div>
</template>

<script>
import MenuComponent from "./MenuComponent";
import ExploreViewComponent from "./ExploreViewComponent";
import PlaylistsViewComponent from "./PlaylistsViewComponent";
import SettingsViewComponent from "./SettingsViewComponent";
import ProfileViewComponent from "./ProfileViewComponent";
import MelodyViewComponent from "./MelodyViewComponent";

export default {
  name: "App",
  data(){
    return {
      currentView: MenuComponent,
      categories: []
    }
  },
  components: {MenuComponent},
  created() {
    this.getCategories()
  },
  methods:{
    changeCurrentView(viewName){
      this.currentView = viewName;
      console.log(viewName);
    },
    getCategories(){
      let request = new Request('http://localhost:8000/category', {method: 'GET'});
      fetch(request).then(function(response) {
        return response.text();
      }).then((responseText) => {
        this.categories = JSON.parse(responseText).categories
        console.log(this.categories)
      });
    }
  },
  computed: {
    dynamicComponent() {
      switch (this.currentView) {
        case "tempo":
          return MelodyViewComponent;
        case "explore":
          return ExploreViewComponent;
        case "playlists":
          return PlaylistsViewComponent;
        case "settings":
          return SettingsViewComponent;
        case "profile":
          return ProfileViewComponent;
        default:
          break;
      }
    }
  }
}
</script>

<style scoped>

</style>