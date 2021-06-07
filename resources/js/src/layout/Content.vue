<template>
  <div class="container col p-2 p-sm-3">
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: "ContentPage",
};
</script>

<style scoped>
div {
  position: relative;
}
div > div {
  height: 100%;
}
</style>