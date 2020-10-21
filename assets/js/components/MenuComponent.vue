<template>
  <div class="container-fluid">
    <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>My App</header>
      <ul>
        <li><a href="#"><i class="fa fa-qrcode"></i>Dashbord</a></li>
        <li><a href="#"><i class="fa fa-link"></i>Text</a></li>
        <li><a href="#"><i class="fa fa-stream"></i>Text</a></li>
        <li><a href="#"><i class="fa fa-sliders-h"></i>Text</a></li>
        <li><a href="#"><i class="fa fa-envelope"></i>Text</a></li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
name: "MenuComponent"
}
</script>

<style scoped>
*{
  margin: 0;
  padding: 0;
  list-style: none;
  text-decoration: none;
}
.sidebar{
  position: fixed;
  left: -15.625em;
  width: 15.625em;
  height: 100%;
  background: #042331;
  transition: all .5s ease;
}

.sidebar header{
  font-size: 1.375em;
  color: #fff;
  text-align: center;
  line-height: 4.375em;
  background: #063146;
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
  border-top: 0.0625em solid rgba(255,255,255,.1);
  border-bottom: 0.0625em solid black;
  transition: .4s;
}

ul li:hover a{
  padding-left: 3.125em;
}

.sidebar ul a i{
  margin-right: 1em;
}

#check{
  display:none;
}

label #btn,label #cancel{
  position: absolute;
  cursor: pointer;
  background: #042331;
  border-radius: 0.1875em;
}

label{
  position: absolute;
}

label #btn{
  left: 1.1428em;
  top: 1.5625em;
  font-size: 2.1875em;
  color: #fff;
  padding: 0.375em 0.75em;
  transition: all .5s;
}

label #cancel{
  z-index: 1111;
  left: -5.1em;
  top: 1.0625em;
  font-size: 1.875em;
  color: #0a5275;
  padding: 0.25em 0.5625em;
  transition: all .5s ease;
}

#check:checked ~ .sidebar{
  left:0;
}

#check:checked ~ label #btn{
  left:15.625em;
  opacity: 0;
  pointer-events: none;
}
#check:checked ~ label #cancel{
  left: 5.1em;
}
</style>