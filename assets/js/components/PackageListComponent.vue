<template>
  <div class="container-fluid center">
    <br>
    <br>
    <br>
    <br>
    {{getSoundPackages}}
    TEST
<!--      <ul>-->
<!--        <div v-for="x in x"-->
<!--             :key="x.id"-->
<!--        >-->
<!--          <li><a href="#" @click="x(x)">{{x.title}}</a></li>-->
<!--        </div>-->
<!--      </ul>-->
  </div>
</template>

<script>
export default {
  name: "PackageListComponent",
  props: {
    level: Number,
    category: Number
  },
  created() {
    this.getSoundPackages()
  },
  methods: {
    getSoundPackages() {
      const url = "http://localhost:8000/sound_package";
      const data = {
        category_id: this.category,
        level: this.level
      };

      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
      })
          .then(response => {console.log(response.json()); response.json();})
          .then(data => {
            console.log('Success:', data);
          })
          .catch((error) => {
            console.error('Error:', error);
          });
    }
  }
}
</script>

<style scoped>
.center{
  text-align-last: center;
}
</style>