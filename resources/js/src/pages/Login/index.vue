<template>
  <div class="d-flex">
    <form class="m-auto col-12 col-sm-10 col-md-6 col-lg-4 p-3 border border-1">
      <h2 class="mb-3">Wellcome!</h2>
      <input class="mb-2 form-control form-control-sm" type="text" v-model="email" required="required" />
      <input class="mb-2 form-control form-control-sm" type="password" v-model="password" required="required" />
      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-sm btn-primary me-2" @click="onLogin" >
          <i class="fas fa-sign-in-alt"></i>
        </button>
        <div>
          <button type="button" class="btn btn-sm btn-primary me-1" @click="onGoogle" >
            <i class="fab fa-google"></i>
          </button>
          <button type="button" class="btn btn-sm btn-primary" @click="onGithub" >
            <i class="fab fa-github"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { api } from "../../service/api";
import { socialMediaAuth } from "../../service/auth";

export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    async onLogin(event) {
      event.preventDefault();

      const { message, data, token } = await api({
        method: "POST",
        url: "/login",
        body: {
          email: this.email,
          password: this.password,
        },
      });

      if (message == "usuário encontrado.") {
        this.handleLogin({ user: data, token });
      } else {
        this.$store.commit("SET", {
          key: "alert",
          val: { message, type: "error" },
        });
      }
    },

    async onGoogle() {
      const { displayName, email } = await socialMediaAuth("googleProvider");

      const { message, data } = await this.validaEmail(email);

      if (message == "usuário encontrado.") {
        this.handleLogin({ user: data });
      } else {
        this.createNewUser({ name: displayName, email });
      }
    },

    async onGithub() {
      const { email } = await socialMediaAuth("githubProvider");

      const { message, data, token } = await this.validaEmail(email);

      if (message == "usuário encontrado.") {
        this.handleLogin({ user: data, token });
      } else {
        this.createNewUser({ email });
      }
    },

    async validaEmail(email) {
      return await api({
        method: "POST",
        url: "/login",
        body: {
          email: email,
          auth: true,
        },
      });
    },

    async createNewUser({ name, email }) {
      await api({
        method: "POST",
        url: "/register",
        body: {
          name: name || "",
          password: "",
          email: email,
        },
      });

      const { data, token } = await this.validaEmail(email);

      await this.handleLogin({ user: data, token });
    },

    handleLogin({ user, token }) {
      localStorage.setItem("token-teste-UHC", token);

      this.$store.dispatch("getTasks");

      this.$store.dispatch("signIn", { user });
      this.$router.push({ name: "Home" });
    },
  },
};
</script>

<style scoped>
</style>