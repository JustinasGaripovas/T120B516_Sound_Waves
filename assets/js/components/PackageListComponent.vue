<template>
  <div class="container-fluid center">
    <ul>
      <div v-for="soundPackage in soundPackages"
           :key="soundPackage.id" class="center-div">
        <li class="item separate">
          <router-link :to="{ name:'package', params:{ id:soundPackage.id}}" class="router">{{
              soundPackage.title
            }}
          </router-link>
        </li>
      </div>
    </ul>
  </div>
</template>

<script>
export default {
  name: "PackageListComponent",
  data() {
    return {
      soundPackages: [],
    }
  },
  props: {
    level: Number,
    category: Number
  },
  watch: {
    level: function (val) {
      if (val != null) {
        this.getSoundPackages();
      }
    }
  },
  methods: {
    getSoundPackages() {
      // TODO change this into Axios
      const url = "/sound_package";
      var comp = this;
      const data = {
        category_id: this.category.toString(),
        level: this.level.toString()
      };
      var xhr = new XMLHttpRequest();
      xhr.open("POST", url, true);

      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function () { // Call a function when the state changes.
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
          if (this.readyState === XMLHttpRequest.DONE) {
            if (this.status === 200) {
              let response = JSON.parse(xhr.responseText);
              comp.soundPackages = response.sound_packages;
            } else {
              console.log(this.status, this.statusText);
            }
          }
        }
      }
      xhr.send(`category_id=${data.category_id}&level=${data.level}`);
    }
  }
}
</script>

<style scoped>
.center {
  text-align-last: center;
}

ul {
  list-style: none;
}

.item {
  background-color: grey;
  padding: 0.5em;
  width: 24%;
  margin: 0 auto;
  text-decoration: none;
  color: black;
}

.router {
  text-decoration: none;
  color: black;
}

.separate {
  margin-bottom: 0.5em;
}

.center-div {
  margin-right: 40px;
}
</style>