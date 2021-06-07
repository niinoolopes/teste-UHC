<template>
  <div>
    <h2>List Tasks</h2>
    <br />

    <div class="btn-group mb-2">
      <router-link class="btn btn-sm btn-primary" to="/task">Add taks</router-link>
    </div>

    <Table
      :tasks="$store.state.tasks"
      :todoStatus="todoStatus"
      :todoEdit="todoEdit"
      :todoDel="todoDel"
    />
  </div>
</template>

<script>
import Table from "../../components/taskTable.vue";
export default {
  components: {
    Table,
  },

  mounted() {},

  methods: {
    async todoStatus(task) {
      task.enable = !task.enable;

      await this.$store.dispatch("editTask", { form: { ...task } });
      await this.$store.dispatch("getTasks");
    },
    todoEdit(task) {
      this.$router.push({ name: "Task", params: { id: task.id } });
    },
    async todoDel(task) {
      await this.$store.dispatch("delTask", { id: task.id });
      await this.$store.dispatch("getTasks");
    },
  },
};
</script>

<style scoped>
</style>