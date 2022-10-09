import { API_URL } from '@/helpers/globalVariables'
import API from '@/api/Http'

class WalletAPIModel {
  async sendCurrency(public_key: string, amount: number | string) {
    const requestData = {
      attributes: {
        amount,
      },
    }

    return await API.Http(
      'PUT',
      `${API_URL}/wallet/digital_ruble/${public_key}`,
      true,
      requestData,
    )
      .then(({ data }) => {
        return data
      })
      .catch((error) => {
        throw new error()
      })
  }
}

export const WalletAPI = new WalletAPIModel()
