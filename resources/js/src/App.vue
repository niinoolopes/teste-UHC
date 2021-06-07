<template>
  <div id="layout" class="h-100 d-flex flex-column">
    <Header />
    <Alert />
    <Content>
      <router-view></router-view>
    </Content>
    <Footer />
  </div>
</template>

<script>
import Header from "./layout/Header.vue";
import Alert from "./layout/Alert.vue";
import Content from "./layout/Content.vue";
import Footer from "./layout/Footer.vue";
export default {
  components: {
    Header,
    Alert,
    Content,
    Footer,
  },
  mounted() {
    if (this.$route.name !== "Login" && this.$store.state.login == false) {
      this.$router.push({ name: "Login" });
    }
  },
};
</script>

<style scoped>
#layout {
  position: relative;
}
</style>