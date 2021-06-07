<template>
  <div>
    <h2>Perfil:</h2>
    <br />

    <form class="overflow-hidden" @submit.prevent="onSubmit">
      <div class="row">
        <div class="mb-3 col-12 col-md-5 col-lg-5">
          <label for="name" class="form-label">Name</label>
          <input
            type="text"
            class="form-control form-control-sm"
            id="name"
            v-model="perfil.name"
          />
        </div>

        <div class="mb-3 col-12 col-md-5 col-lg-4">
          <label for="email" class="form-label">E-mail</label>
          <input
            type="text"
            class="form-control form-control-sm"
            id="email"
            v-model="perfil.email"
            disabled="disabled"
          />
        </div>

        <div class="mb-3 col-12 col-md-4 col-lg-2">
          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            class="form-control form-control-sm"
            id="password"
            v-model="perfil.password"
          />
        </div>
      </div>

      <br />

      <button type="submit" class="btn btn-sm btn-primary">
        <i class="fas fa-save"></i>
      </button>
      <button type="button" class="btn btn-sm btn-danger" @click="perfilDel">
        <i class="fas fa-trash-alt"></i>
      </button>
    </form>
  </div>
</template>

<script>
import { api } from "../../service/api";
export default {
  data() {
    return {
      perfil: {
        id: "",
        name: "",
        password: "",
      },
    };
  },
  mounted() {
    this.perfil = { ...this.perfil, ...this.$store.state.user };
  },

  methods: {
    async onSubmit() {
      const { status, message, data } = await api({
        method: "PUT",
        url: `/perfil/${this.perfil.id}`,
        body: { ...this.perfil },
      });

      this.$store.commit("SET", { key: "user", val: data });

      this.$store.commit("SET", {
        key: "alert",
        val: {
          message,
          type: status == 201 ? "ok" : "error",
        },
      });

      this.$router.push({ name: "Home" });
    },
    async perfilDel() {
      const confirmDel = confirm(
        "Ao excluir será deletado sua conta e suas tasks (caso tenha), deseja continuar?"
      );

      if (confirmDel) {
        const { status, message } = await api({
          method: "DELETE",
          url: `/perfil/${this.perfil.id}`,
        });

        this.$store.commit("SET", {
          key: "alert",
          val: {
            message,
            type: status == 201 ? "ok" : "error",
          },
        });

        await this.$store.dispatch("signOut");

        this.$router.push({ name: "Login" });
      }
    },
  },
};
</script>

<style scoped>
</style>