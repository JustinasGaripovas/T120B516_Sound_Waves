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
      currentView: MenuComponent
    }
  },
  components: {MenuComponent},
  methods:{
    changeCurrentView(viewName){
      this.currentView = viewName;
      console.log(viewName);
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