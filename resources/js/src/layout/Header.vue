<template>
  <header class="navbar">
    <div class="container">
      <router-link to="/" class="navbar-brand text-white text-decoration-none">Início</router-link>

      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link to="/Login" class="text-white text-decoration-none">Login</router-link>
        </li>
      </ul>
      
    </div>
  </header>
</template>

<script>
export default {
  name: "HeaderPage",
};
</script>

<style scoped>
header {
  min-height: 4rem;
  background: var(--bs-gray);
}
</style>