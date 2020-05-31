<template>
  <div>
    <h1>Profile</h1>
  </div>
</template>

<script>
export default {
  name: "Profile",
  data() {
    return {
      email: ""
    };
  },
  methods: {
    getProlile() {
      fetch("https/localhost/8000/profile");
    }
  }
};
</script>

<style>
</style>