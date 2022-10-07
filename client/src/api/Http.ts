import axios from 'axios'

const Http = async (
  method: string,
  url: string,
  data?: any,
  /* responseType: string, */
) => {
  // axios.defaults.withCredentials = true
  try {
    return await axios({
      method: method,
      // responseType: responseType,
      url: `${process.env.api_url}${url}`,
      data: data,
      // headers: {
      // }
    })
  } catch (e) {
    console.error(e)
    return Promise.reject(e)
  }
}

export default {
  Http,
}
