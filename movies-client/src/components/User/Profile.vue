<template>
  <div>
    <h1>Profile</h1>
  </div>
</template>

<script>
import authAxios from "@/axios-auth";
export default {
  name: "Profile",
  data() {
    return {
      email: ""
    };
  },
  created: function() {
    authAxios
      .get("/profile")
      .then(res => console.log(res))
      .catch(err => console.log(err));
  }
};
</script>

<style>
</style>