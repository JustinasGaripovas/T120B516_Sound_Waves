<template>
  <div class="container-fluid profileTabContents">
    <div class="col-5 profilePicture">
      <img class="img-fluid" src="https://static.vets-now.com/uploads/2017/01/Common-emergencies-in-kittens-Vets-Now.jpg">
      <a class="pictureOverlay" href="#">
        <div class="overlayText">
          Change
        </div>
      </a>
    </div>
    <div class="col-7 profileName">
      <a href="#">
        Username
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "ProfileMenuTab"
}
</script>

<style scoped>
.profileTabContents{
  background-color: #176585;
  display: flex;
  height: 100%;
  padding: 0;
}

.profilePicture{
  box-shadow: 0.25em 0 1.2em 0 rgba(0,0,0,0.25);
  text-align: center;
  display: flex;
}

.profilePicture img{
  margin: auto;
  height: 75%;
  border-radius: 50%;
}

.pictureOverlay {
  position: absolute;
  margin: auto;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 75%;
  width: 75%;
  opacity: 0;
  transition: .5s ease;
  color: #fff;
  background-color: #525252;
  border-radius: 50%;
}

.overlayText{
  color: white;
  font-size: 14px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
}

.profilePicture:hover .pictureOverlay{
  opacity: 0.75;
}

.profileName{
  display: block;
  text-align: center;
  font-family:arial,courier,helvetica;
  height: 100%;
  display: inherit;
}

.profileName a {
  margin: auto;
  font-size: 20px;
  color: #fff;
  transition: .5s ease;
}

.profileName a:hover{
  text-decoration: none;
  font-size: 21px;
}

</style>