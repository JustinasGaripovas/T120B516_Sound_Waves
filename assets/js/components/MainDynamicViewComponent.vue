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
        case "melody":
          return ExploreViewComponent;
        case "rhythm":
          return PlaylistsViewComponent;
        case "dynamics":
          return SettingsViewComponent;
        case "timbre":
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