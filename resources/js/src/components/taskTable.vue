<template>
  <table class="table table-sm" :class="$store.state.loading ? 'table-loading' : ''">
    <thead>
      <tr>
        <th class="text-capitalize text-center thId" scope="col">#</th>
        <th class="text-capitalize" scope="col">List task</th>
        <th class="text-capitalize text-center thStatus" scope="col">Status</th>
        <th class="text-capitalize text-center thIcon" scope="col">Edit</th>
        <th class="text-capitalize text-center thIcon" scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="task in tasks" :key="task.id">
        <th scope="row" class="text-center">{{task.id}}</th>
        <td>
          <p class="m-0">{{task.description}}</p>
        </td>
        <td class="tdStatus">
          <div class="d-flex">
            <div class="m-auto form-check">
              <input 
                class="cursor-pointer form-check-input" 
                type="checkbox" 
                :checked=" task.enable ? 'checked' : ''"  
                :value="task.enable" 
                @change="todoStatus(task)"
              >
            </div>
          </div>
        </td>
        <td>
          <div class="d-flex">
            <span class="m-auto cursor-pointer" @click="todoEdit(task)">
              <i class="fas fa-edit"></i>
            </span>
          </div>
        </td>
        <td>
          <div class="d-flex">
            <span class="m-auto cursor-pointer text-danger" @click="todoDel(task)">
              <i class="fas fa-trash-alt"></i>
            </span>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
  export default {
    props:['tasks', 'todoStatus', 'todoEdit', 'todoDel']
    
  }
</script>

<style scoped>
th {
  font-size: 0.75rem;
}
td p{
  font-size: 1.25rem;
}
.thId {
  width: 35px;
}
.thStatus ,
.tdStatus {
  width: 35px;
}
.thIcon ,
.tdIcon {
  width: 35px;
}
@media (min-width: 768px) {
  .thStatus ,
  .tdStatus {
    width: 75px;
  }
  .thIcon ,
  .tdIcon {
    width: 75px;
  }
}
.table-loading {
  opacity: 0.75;
}
</style>