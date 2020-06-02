<template>
  <div id="app">
    <img alt="Vue logo" src="./assets/logo.png" />
    <app-navigation @onAuth="isAuth = $event" :isAuth="isAuth"></app-navigation>
    <router-view @onAuth="isAuth = $event" :isAuth="isAuth"></router-view>
  </div>
</template>

<script>
import AppNavigation from "./components/common/Navigation";
export default {
  name: "App",
  data: function() {
    return {
      isAuth: localStorage.getItem("jwt") !== null
    };
  },
  components: {
    AppNavigation
  }
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
