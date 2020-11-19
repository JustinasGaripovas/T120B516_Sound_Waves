<template>
  <div class="container-fluid">
    <input type="checkbox" id="sidebarCheck">
    <label for="sidebarCheck">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>Menu</header>
      <ul>
        <div v-for="category in categories"
             :key="category.id"
        >
          <li><router-link to="/level"><i class="fa fa-qrcode"></i>{{category.title}} </router-link></li>
        </div>
      </ul>
    </div>
  </div>
</template>
<!--<a href="" @click="passInformation(category.id, true)"><i class="fa fa-qrcode"></i>{{category.title}}</a>-->
<script>
export default {
  name: "MenuComponent",
  props: {
    categories: Array
  },
  methods: {
    passInformation(id, showBool){
      this.$emit('passInformation', id, showBool);
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
  outline:none;
}

.sidebar{
  position: fixed;
  left: -15.625em;
  width: 15.625em;
  height: 100%;
  background: #0d3545;
  transition: all .5s ease;
}

.sidebar header{
  font-size: 1.8em;
  color: #fff;
  padding-left: 2.5em;
  line-height: 4.6em;
  background: #176585;
  user-select: none;
}

.sidebar ul a{
  display: block;
  height: 100%;
  width: 100%;
  line-height: 4.0625em;
  font-size: 1.25em;
  color: #fff;
  padding-left: 2.5em;
  box-sizing: border-box;
  transition: .3s;
}

ul li:hover a{
  padding-left: 3.5em;
  text-decoration: none;
}

.sidebar ul a i{
  margin-right: 1em;
}

#sidebarCheck{
  display:none;
}

label #btn,label #cancel{
  position: absolute;
  cursor: pointer;
  background: #0d3545;
  border-radius: 0.1875em;
}

label{
  position: absolute;
}

label #btn{
  left: 0;
  top: 0.75em;
  font-size: 2.1875em;
  color: #fff;
  padding: 0.375em 0.75em;
  transition: all .5s;
}

label #cancel{
  z-index: 1111;
  left: -4.8em;
  top: 1.5em;
  font-size: 1.875em;
  color: #fff;
  padding: 0.25em 0.5em;
  transition: all .5s ease;
}

#sidebarCheck:checked ~ .sidebar{
  left:0;
}

#sidebarCheck:checked ~ label #btn{
  left:-2.625em;
  opacity: 0;
  pointer-events: none;
}
#sidebarCheck:checked ~ label #cancel{
  left: 4.8em;
}
</style>