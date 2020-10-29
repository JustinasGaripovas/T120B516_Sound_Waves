<template>
  <component :is="dynamicComponent"></component>
</template>

<script>
import PlayMelodyTransitionComponent from "./PlayMelodyTransitionComponent";
import ExploreViewComponent from "./ExploreViewComponent";
import PlaylistsViewComponent from "./PlaylistsViewComponent";
import SettingsViewComponent from "./SettingsViewComponent";
import ProfileViewComponent from "./ProfileViewComponent";

export default {
  name: "MainDynamicComponent",
  data: function () {
    return {
        currentViewComponent: ""
    }
  },
  props: {currentView: String},
  components: {PlayMelodyTransitionComponent, ExploreViewComponent},
  computed: {     
    dynamicComponent() {
      switch (this.currentView) {
        case "tempo":
          return PlayMelodyTransitionComponent;
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