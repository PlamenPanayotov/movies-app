<template>
  <div id="app">
    <img alt="Vue logo" src="./assets/logo.png" />
    <app-navigation></app-navigation>
    <router-view></router-view>
  </div>
</template>

<script>
import AppNavigation from "./components/common/Navigation";
export default {
  name: "App",
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
