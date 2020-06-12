<template>
  <div>
    <div>
      <h3 class="login-account">
        Login
        <small class="text-muted">Please sign in</small>
      </h3>
    </div>
    <form method="post" v-on:submit.prevent="sendLogin" class="form-group">
      <div class="form-group-row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input
            type="email"
            value
            name="email"
            id="inputEmail"
            class="form-control"
            v-model="email"
            placeholder="Email"
            reqired
            autofocus
          />
        </div>
      </div>
      <div class="form-group-row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input
            type="password"
            value
            name="password"
            id="inputPassword"
            class="form-control"
            v-model="password"
            placeholder="Password"
            reqired
          />
        </div>
      </div>

      <input type="hidden" name="_csrf_token" v-model="csrf_token" />

      <button class="btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
    <div v-if="isError === true">
      <div class="alert alert-danger" role="alert">{{ errorMessage }}</div>
    </div>
  </div>
</template>

<script>
import authAxios from "@/axios-auth";
export default {
  props: ["csrf_token", "last-email"],
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
      isError: false,
      errorMessage: ""
    };
  },
  created() {
    if (this.$props.last_email !== undefined) {
      this.email = this.$props.last_email;
    }
    console.log("Login component: " + this.$store.getters.isAuthenticated);

    if (this.$store.getters.isAuthenticated === true) {
      this.$router.push("/");
    }
  },
  methods: {
    sendLogin() {
      console.log("send login form");
      const payload = {
        email: this.email,
        password: this.password,
        csrfToken: this.$props.csrf_token
      };
      authAxios
        .post("login", payload)
        .then(res => res.json())
        .then(data => {
          if (data === "authenticated") {
            this.$store.commit("change", true);
            console.log(
              "user authenticated successfully " +
                this.$store.getters.isAuthenticated
            );
            this.$router.push("/");
          } else {
            this.isError = true;
            this.errorMessage = data;
          }
        })
        .catch(err => {
          console.error(err);
        })
        .finally(() => this.$router.push("/"), (this.loading = false));
    }
  }
};
</script>