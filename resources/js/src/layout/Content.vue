<template>
  <div class="container col">
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: "ContentPage",
};
</script>

<style scoped>
div > div {
  height: 100%;
}
</style>