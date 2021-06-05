<template>
  <div class="h-100 d-flex flex-column">
    <Header />
    <Content>
      <router-view></router-view>
    </Content>
    <Footer />
  </div>
</template>

<script>
import Header from "./layout/Header.vue";
import Content from "./layout/Content.vue";
import Footer from "./layout/Footer.vue";
export default {
  components: {
    Header,
    Content,
    Footer,
  },
};
</script>

<style scoped>
</style>