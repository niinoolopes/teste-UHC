<template>
  <div class="d-flex justify-content-center align-items-center">
    <form class="col-12 col-md-3 p-3 border border-1">
      <h2 class="mb-3">Bem vindo!</h2>
      <input class="mb-2 form-control form-control-sm" type="text" />
      <input class="mb-2 form-control form-control-sm" type="password" />

      <div class="d-flex justify-content-between">
        <button
          type="submit"
          class="btn btn-sm btn-primary me-2"
          @click="onLogin"
        >
          Sign in
        </button>
        <div>
          <button
            type="button"
            class="btn btn-sm btn-primary me-1"
            @click="onGoogle"
          >
            Google
          </button>
          <button
            type="button"
            class="btn btn-sm btn-primary"
            @click="onGithub"
          >
            Github
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  methods: {
    onLogin(event) {
      event.preventDefault();
      
      console.log("onLogin");
    },
    onGoogle() {
      console.log("onGoogle");
    },
    onGithub() {
      console.log("onGithub");
    },
  },
};
</script>

<style scoped>
</style>