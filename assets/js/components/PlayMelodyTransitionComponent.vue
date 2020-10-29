<template>
  <div class="container initScreen">
    <transition name="component-fade" mode="out-in">
      <component v-bind:is="view" v-on:switch="view='MelodyViewComponent'"></component>
    </transition>
  </div>
</template>

<script>
import MelodyViewComponent from "./MelodyViewComponent";

export default {
 name: "PlaySoundWaveComponent",

 data: function () {
    return {
        view: 'v-a'
    }
  },

  components: {
    MelodyViewComponent,
    'v-a': {
      template: '<button type="button" class="btn initMelodyButton" @click="$emit(\'switch\')">Play Melody~</button>'
    }
  }

}
</script>

<style scoped>
*{
  margin: 0;
  padding: 0;
  list-style: none;
  text-decoration: none;
  user-select: none;
}

*:focus {
  outline: none;
}

.initScreen {
    margin: auto;
    width: 100%;
    height: 100%;
    text-align: center;
}

.initMelodyButton {
    margin: auto;
    margin-top: 40%;
    font-size: 3em;
    text-align: center;
    background-color: transparent;
    transition: all .5s ease;
}

.initMelodyButton:hover {
    font-size: 3.5em;
}

.initMelodyButton:focus {
    outline: none;
}

.component-fade-enter-active, .component-fade-leave-active {
  transition: opacity .3s ease;
}
.component-fade-enter, .component-fade-leave-to
/* .component-fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

</style>