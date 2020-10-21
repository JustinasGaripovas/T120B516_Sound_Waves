<template>
  <div class="container-fluid">
   <MenuComponent></MenuComponent>
   <PlayMelodyTransitionComponent></PlayMelodyTransitionComponent>
  </div>
</template>

<script>
import MenuComponent from "./MenuComponent";
import PlayMelodyTransitionComponent from "./PlayMelodyTransitionComponent";

export default {
  name: "App",
  components: {MenuComponent, PlayMelodyTransitionComponent}
}
</script>

<style scoped>

</style>