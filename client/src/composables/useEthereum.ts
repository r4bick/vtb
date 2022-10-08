import { computed, ref } from 'vue'
import API from '@/api/Http'
import { cryptoCurrency } from '@/types/enums'
import { useCookies } from 'vue3-cookies'
import { API_POLYGON } from '@/helpers/globalVariables'

const { cookies } = useCookies()

export function useEthereum() {
  const maticBalance = ref(0)
  const coinBalance = ref(0)

  const getBalance = async () => {
    const key = cookies.get('public')
    if (!key) {
      coinBalance.value = 0
      maticBalance.value = 0
      return
    }
    await API.Http('get', `${API_POLYGON}/v1/wallets/${key}/balance`, false)
      .then(({ data }: any) => {
        coinBalance.value = data.coinsAmount
        maticBalance.value = data.maticAmount
      })
      .catch((err: any) => {
        console.log(err)
      })
  }

  const publicKey = cookies.get('public') || ''

  //Метод перевода с кошелька на кошелек
  const sendCurrency = async (
    amount: number,
    toPublicKey: string,
    fromPrivateKey: string,
    currency: cryptoCurrency,
  ) => {
    await API.Http('post', `${API_POLYGON}/v1/transfers/${currency}`, false, {
      fromPrivateKey,
      toPublicKey,
      amount,
    }).then(({ data }) => {
      // для совершения переводов в валютах Rubles необходимо наличие Matic, т.к. со счета Matic берется комиссия за совершение транзакций.
      // При нулевом балансе Matic транзакция выполнена не будет!
      // console.log('currency send: ', currency)
      // console.log('сигнатура транзакции', data.transactionHash)
    })
  }

  //Метод запроса статуса выполнения транзакции
  const getTransactionStatus = async (transactionHash: string) => {
    await API.Http(
      'post',
      `${API_POLYGON}/v1/transfers/status/${transactionHash}`,
      false,
    ).then(({ data }) => {
      // console.log('status: ', data.status)
    })
  }

  //Метод получения баланса NFT по кошельку
  const getNFTBalance = async (transactionHash: string) => {
    await API.Http(
      'get',
      `${API_POLYGON}/v1/wallets/${publicKey}/nft/balance`,
      false,
    ).then(({ data }) => {
      // console.log('data: ', data)
    })
  }

  //Метод получения списка сгенерированных NFT
  const getGeneratedNfts = async (transactionHash: string) => {
    await API.Http(
      'get',
      `${API_POLYGON}/v1/nft/generate/${transactionHash}`,
      false,
    ).then(({ data }) => {
      // console.log('data: ', data)
    })
  }

  //Получение истории транзакций по кошельку
  const getWalletHistory = async (
    page: number,
    offset: number,
    sort: 'asc' | 'desc',
  ) => {
    await API.Http(
      'post',
      `${API_POLYGON}/v1/wallets/${publicKey}/history`,
      false,
      {
        page,
        offset,
        sort,
      },
    ).then(({ data }) => {
      // console.log('data: ', data)
    })
  }

  getBalance().then()

  return {
    maticBalance,
    coinBalance,
    sendCurrency,
    getBalance,
    publicKey,
    getTransactionStatus,
    getNFTBalance,
    getGeneratedNfts,
    getWalletHistory,
  }
}
