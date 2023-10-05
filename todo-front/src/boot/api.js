import { boot } from 'quasar/wrappers'
import axios from 'axios'

const api = axios.create({
  baseURL: process.env.API_URL
})

console.log({url: process.env.API_URL})

export default boot(async ({app}) => {
  app.config.globalProperties.$api = api

  window.$app = app
  window.$api = api
})
