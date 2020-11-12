<template>
  <div class="container-fluid center">
    <div>
      <button @click="passLevel(0)">Beginner</button>
      <button @click="passLevel(1)">Intermediate</button>
      <button @click="passLevel(2)">Expert</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "LevelComponent",

  methods: {
    passLevel(level) {
      this.$emit('passLevel', level);
    }
  }
}
</script>

<style scoped>
.center{
  text-align-last: center;
}
</style>