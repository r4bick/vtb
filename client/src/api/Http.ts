import axios from 'axios'
import { useCookies } from 'vue3-cookies'
const { cookies } = useCookies()
const Http = async (
  method: string,
  url: string,
  useToken = true,
  data?: any,
  params?: any,
  /* responseType: string, */
) => {
  if (useToken) {
    axios.defaults.headers.common['Authorization'] =
      'bearer ' + cookies.get('bearer')
  } else {
    delete axios.defaults.headers.common.Authorization
  }

  try {
    return await axios({
      method: method,
      url,
      data,
      params,
    })
  } catch (e) {
    console.error(e)
    return Promise.reject(e)
  }
}

export default {
  Http,
}
