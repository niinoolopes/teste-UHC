import axios from 'axios'
import { store } from '../store'

export const api = async function ({ method, url, body = {} }) {

  store.commit('SET', { key: 'loading', val: true })

  const config = {
    method: method,
    // baseURL: '/teste-UHC/api',
    baseURL: '/portifolio/teste-UHC/api',
    url,
    data: body,
  }

  if (url !== '/login') {
    const tokenStorage = localStorage.getItem('token-teste-UHC') || ''

    config.headers = {
      "Content-Type": "application/json",
      "Authorization": `Bearer ${tokenStorage}`
    }
  }

  const response = await axios(config)

  const data = response.data.data
  const message = response.data.message
  const status = response.status
  const token = response.data.token

  store.commit('SET', { key: 'loading', val: false })

  return { status, message, data, token }
}