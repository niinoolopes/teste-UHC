<template>
  <div>
    <h2>Task: {{ action == 'add' ? 'new taks' : 'edit task' }}</h2>
    <br />

    <form class="overflow-hidden" @submit.prevent="onSubmit">

      <div class="row">
        <div class="mb-3 col-12 col-md-10">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control" id="description" v-model="task.description" />
        </div>

        <div class="mb-3 col-12 col-md-2">
          <label for="" class="form-label">Status</label>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="enable" v-model="task.enable" />
            <label class="form-check-label" for="enable"> {{task.enable ? 'active' : 'not active'}} </label>
          </div>
        </div>
      </div>

      <br />
      
      <button type="submit" class="btn btn-sm btn-primary">
        <i class="fas fa-save"></i>
      </button>
      <button v-if="action == 'edit'" type="button" class="btn btn-sm btn-danger" @click="taskDel">
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
      action: "",
      task: {
        id: null,
        description: "",
        enable: true,
      },
    };
  },

  mounted() {
    if (this.$route.params.id) {
      this.action = 'edit'
      this.task.id = this.$route.params.id
      this.getID(this.$route.params.id);
    } else {
      this.action = 'add'
    }
  },

  methods: {

    // GET task by id
    async getID() {
      const { data } = await api({
        method: 'GET', 
        url: `/task/${this.task.id}`
      });

      this.task = {...this.task, ...data}
    },
    
    // handleForm
    async onSubmit() {

      if (this.action == "add") {
        await this.$store.dispatch("addTask", { form: { ...this.task }});

      } else {
        await this.$store.dispatch("editTask", { form: { ...this.task }});

      }

      // update all task in store
      await this.$store.dispatch("getTasks");

      this.$router.push({ name: "Home" });
    },

    async taskDel(){
      
      // del task
      await this.$store.dispatch("delTask", {id: this.task.id});

      // update all task in store
      await this.$store.dispatch("getTasks");

      this.$router.push({ name: "Home" });
    }
  },
};
</script>

<style scoped>
</style>