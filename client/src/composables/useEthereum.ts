import { computed, ref } from 'vue'
// @ts-ignore
import { ethers } from 'ethers'
import API from '@/api/Http'
import { cryptoCurrency } from '@/types/enums'
import { useCookies } from 'vue3-cookies'
import { MAIN_CHAIN } from '@/types/enums'

interface ApiError {
  code: number
  message: string
}

const { cookies } = useCookies()

// export function useEthereum(CONTRACT_ADDRESS: string) {
export function useEthereum() {
  // @ts-ignore
  const { ethereum } = window

  // const currentAccount = ref('')
  const currentChainId = ref('')
  const isTransfering = ref(true)

  const tokenId = ref('')

  const maticBalance = ref(0)
  const coinBalance = ref(0)

  let provider = undefined

  const initSetup = () => {
    if (ethereum) {
      provider = new ethers.providers.Web3Provider(ethereum)
    }
  }

  // listens if chain changed
  const chainListener = async (chainId: string) => {
    currentChainId.value = chainId

    if (chainId !== MAIN_CHAIN || !connected.value) {
      // $toast.error('You are not connected to the Polygon Network!', {
      //   duration: 3000,
      // })
      coinBalance.value = 0
      maticBalance.value = 0
    } else {
      initSetup()

      // await updateBalances()

      // $toast.success('Chain changed to Polygon', {
      //   duration: 3000,
      // })
    }
  }

  const setupEventListener = async () => {
    try {
      if (ethereum) {
        ethereum.on('chainChanged', chainListener)
        // ethereum.on('accountsChanged', accountListener)
      }
    } catch (err) {
      console.log(err)
      // $toast.error('Metamask error', {
      //   duration: 3000,
      // })
    }
  }

  const getBalance = async () => {
    const key = cookies.get('public')
    if (!key) {
      coinBalance.value = 0
      maticBalance.value = 0
      return
    }
    await API.Http(
      'get',
      `${process.env.VUE_APP_POLYGON}/v1/wallets/${key}/balance`,
      false,
    )
      .then(({ data }: any) => {
        coinBalance.value = data.coinsAmount
        maticBalance.value = data.maticAmount
      })
      .catch((err: any) => {
        console.log(err)
      })
  }

  // Для автоматического переключения chain на Polygon
  const switchChain = async () => {
    try {
      await ethereum.request({
        method: 'wallet_switchEthereumChain',
        params: [{ chainId: MAIN_CHAIN }],
      })
    } catch (switchError) {
      if ((switchError as ApiError).code === 4902) {
        try {
          await ethereum.request({
            method: 'wallet_addEthereumChain',
            params: [
              {
                chainId: MAIN_CHAIN,
                rpcUrls: ['https://matic-mumbai.chainstacklabs.com'],
                blockExplorerUrls: ['https://mumbai.polygonscan.com'],
                chainName: 'Mumbai',
              },
            ],
          })

          // $toast.success('New chain added', {
          //   duration: 3000,
          // })
        } catch (err) {
          console.log(err)
          // $toast.error('MetaMask Error: ', {
          //   duration: 3000,
          // })

          return
        }
      }

      console.log(switchError)
    }
  }

  // ---- VTB wallet methods ---
  const privateKey = computed(() => {
    return cookies.get('private') || ''
  })
  const publicKey = computed(() => {
    return cookies.get('public') || ''
  })
  const connected = ref(false)

  //Метод перевода с кошелька на кошелек
  const sendCurrency = async (
    amount: number,
    toPublicKey: string,
    currency: cryptoCurrency,
  ) => {
    await API.Http(
      'post',
      `${process.env.VUE_APP_POLYGON}/v1/transfers/${currency}`,
      false,
      {
        fromPrivateKey: privateKey.value,
        toPublicKey,
        amount,
      },
    ).then(({ data }) => {
      // todo
      // для совершения переводов в валютах Rubles необходимо наличие Matic, т.к. со счета Matic берется комиссия за совершение транзакций.
      // При нулевом балансе Matic транзакция выполнена не будет!
      console.log('currency send: ', currency)
      console.log('сигнатура транзакции', data.transactionHash)
    })
  }

  //Метод запроса статуса выполнения транзакции
  const getTransactionStatus = async (transactionHash: string) => {
    await API.Http(
      'post',
      `${process.env.VUE_APP_POLYGON}/v1/transfers/status/${transactionHash}`,
      false,
    ).then(({ data }) => {
      console.log('status: ', data.status)
    })
  }

  //Метод получения баланса NFT по кошельку
  const getNFTBalance = async (transactionHash: string) => {
    await API.Http(
      'get',
      `${process.env.VUE_APP_POLYGON}/v1/wallets/${publicKey.value}/nft/balance`,
      false,
    ).then(({ data }) => {
      console.log('data: ', data)
    })
  }

  //Метод получения списка сгенерированных NFT
  const getGeneratedNfts = async (transactionHash: string) => {
    await API.Http(
      'get',
      `${process.env.VUE_APP_POLYGON}/v1/nft/generate/${transactionHash}`,
      false,
    ).then(({ data }) => {
      console.log('data: ', data)
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
      `${process.env.VUE_APP_POLYGON}/v1/wallets/${publicKey.value}/history`,
      false,
      {
        page,
        offset,
        sort,
      },
    ).then(({ data }) => {
      console.log('data: ', data)
    })
  }

  initSetup()
  // checkIfWalletIsConnected().then()
  // setupEventListener()
  getBalance().then()

  return {
    currentChainId,
    isTransfering,
    tokenId,
    maticBalance,
    coinBalance,
    setupEventListener,
    switchChain,

    /* VTB methods: */

    sendCurrency,
    getBalance,
    publicKey,
    privateKey,
    connected,
    getTransactionStatus,
    getNFTBalance,
    getGeneratedNfts,
    getWalletHistory,
  }
}
