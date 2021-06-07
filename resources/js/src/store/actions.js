import { api } from '../service/api'

export default {
  signIn(context, { user }) {
    context.commit('SET', { key: 'login', val: true })
    context.commit('SET', { key: 'user', val: user })
  },
  signOut(context) {
    context.commit('SET', { key: 'login', val: false })
    context.commit('SET', { key: 'user', val: {} })
  },

  async getTasks(context) {

    const { data } = await api({
      method: "GET",
      url: "/task"
    });

    context.commit('SET', { key: 'tasks', val: data })
  },
  async addTask(context, { form }) {

    const { status, message } = await api({
      method: 'POST',
      url: "/task",
      body: form
    });

    context.commit('SET', {
      key: 'alert', val: {
        message,
        type: status == 201 ? 'ok' : 'error'
      }
    })
  },
  async editTask(context, { form }) {

    const { status, message } = await api({
      method: 'PUT',
      url: `/task/${form.id}`,
      body: form
    });

    context.commit('SET', {
      key: 'alert', val: {
        message,
        type: status == 201 ? 'ok' : 'error'
      }
    })
  },
  async delTask(context, { id }) {

    const { status, message } = await api({
      method: 'DELETE',
      url: `/task/${id}`,
    });

    context.commit('SET', {
      key: 'alert', val: {
        message,
        type: status == 201 ? 'ok' : 'error'
      }
    })
  },
}