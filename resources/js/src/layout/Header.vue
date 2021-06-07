<template>
  <header class="navbar bg-light navbar-light">

    <div class="container">
      <router-link :to="$store.state.login ? '/home' : '/'" class="navbar-brand text-decoration-none">
        <i class="text-dark fas fa-home"></i>
      </router-link>

      <ul v-if="$store.state.login" class="d-flex">
        <li class="cursor-pointer me-3" @click="perfil">
          <i class="text-dark fas fa-user-cog"></i>
        </li>

        <li class="cursor-pointer" @click="logout">
          <i class="text-dark fas fa-sign-out-alt"></i>
        </li>
      </ul>
    </div>

  </header>
</template>

<script>
export default {
  name: "HeaderPage",
  methods: {
    perfil() {
      this.$router.push({ name: "Perfil" });
    },
    logout() {
      this.$store.dispatch('signOut')
      this.$router.push({ name: "Login" });
    }
  },
};
</script>

<style scoped>
</style>