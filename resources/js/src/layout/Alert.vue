<template>
  <div
    id="alert"
    class="alert"
    :class="type == 'ok' ? 'alert-success' : 'alert-danger'"
    role="alert"
    :status="status ? 'active' : ''"
  >
    {{ message }}
  </div>
</template>

<script>
export default {
  data() {
    return {
      status: false,
      message: "",
      type: "",
    };
  },
  watch: {
    "$store.state.alert"(newValue) {
      if (newValue) {
        this.message = newValue.message;
        this.type = newValue.type;
        this.status = true;

        setTimeout(() => {
          this.$store.commit("SET", { key: "alert", val: false });
          this.status = false;
        }, 2000);
      }
    },
  },
};
</script>

<style scoped>
#alert {
  position: absolute;
  top: 60px;

  left: 2rem;
  right: 2rem;

  transition: all 0.2s;
}
#alert[status=""] {
  z-index: -3;
  opacity: 0;

}
#alert[status="active"] {
  z-index: 3;
  opacity: 1;
}
@media (min-width: 576px) {
  #alert {
    left: 15vw;
    right: 15vw;
  }
}
@media (min-width: 768px) {
  #alert {
    left: 25vw;
    right: 25vw;
  }
}
</style>