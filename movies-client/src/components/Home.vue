<template>
  <div>
    <h1>Home</h1>
  </div>
</template>

<script>
export default {
  props: {
    isAuth: Boolean
  },
  data() {
    return {
      movies: []
    };
  },
  name: "Home",
  beforeCreate() {
    this.$emit("onAuth", localStorage.getItem("jwt") !== null);
  }
};
</script>

<style>
</style>