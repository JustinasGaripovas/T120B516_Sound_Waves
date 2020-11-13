<template>
  <div class="container-fluid center">
    <div class="main">
      <button class="level top" @click="passLevel(0)">Beginner</button>
      <button class="level" @click="passLevel(1)">Intermediate</button>
      <button class="level" @click="passLevel(2)">Expert</button>
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

.top{
  margin-top: 3em;
}

.level{
  background-color: grey;
  border: none;
  color: black;
  padding: 0.8em 6.25em;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  margin-bottom: 2em;
  outline-color: #0d3545;
}

.main{
  display: inline-grid;
}
</style>