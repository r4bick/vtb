import { computed, ref } from 'vue'
// @ts-ignore
import { ethers } from 'ethers'
import API from '@/api/Http'
import { cryptoCurrency } from '@/types/enums'
import { useCookies } from 'vue3-cookies'

export const MAIN_CHAIN = '0x13881' // Chain Polygon Mumbai testnet

interface ApiError {
  code: number
  message: string
}

const { cookies } = useCookies()

// export function useEthereum(CONTRACT_ADDRESS: string) {
export function useEthereum() {
  // @ts-ignore
  const { ethereum } = window

  const currentAccount = ref('')
  const currentChainId = ref('')
  const isTransfering = ref(true)

  const tokenId = ref('')

  const maticBalance = ref(0)
  const coinBalance = ref(0)

  let provider = undefined
  let signer = undefined

  const initSetup = () => {
    if (ethereum) {
      provider = new ethers.providers.Web3Provider(ethereum)
      signer = provider.getSigner()
    }
  }

  const chainListener = async (chainId: string) => {
    console.log(chainId)
    currentChainId.value = chainId

    if (chainId !== MAIN_CHAIN) {
      // $toast.error('You are not connected to the Polygon Network!', {
      //   duration: 3000,
      // })
      coinBalance.value = 0
      maticBalance.value = 0
    } else {
      initSetup()

      await updateBalances()

      // $toast.success('Chain changed to Polygon', {
      //   duration: 3000,
      // })
    }
  }

  // listens if account changed
  const accountListener = async (accounts: string[]) => {
    if (!currentAccount.value && accounts.length > 0) {
      // $toast.success('You are connected', {
      //   duration: 3000,
      // })
    } else if (currentAccount.value.length > 0 && accounts.length === 0) {
      // $toast.info('Account is blocked', {
      //   duration: 3000,
      // })
    } else if (currentAccount.value.length > 0 && accounts.length > 0) {
      const accounts = await ethereum.request({ method: 'eth_accounts' })
      await checkAccountAndChain(accounts)

      // $toast.info('Accounts are switched', {
      //   duration: 3000,
      // })
    }
    currentAccount.value = accounts[0]
  }

  const setupEventListener = async () => {
    try {
      if (ethereum) {
        ethereum.on('chainChanged', chainListener)
        ethereum.on('accountsChanged', accountListener)
      }
    } catch (err) {
      console.log(err)
      // $toast.error('Metamask error', {
      //   duration: 3000,
      // })
    }
  }

  const updateBalances = async () => {
    if (currentChainId.value === MAIN_CHAIN) {
      await getBalance()
    }
  }

  const checkAccountAndChain = async (accounts: string[]) => {
    if (accounts.length !== 0 && publicKey.value) {
      currentAccount.value = accounts[0]
      currentChainId.value = await ethereum.request({ method: 'eth_chainId' })

      if (currentChainId.value === MAIN_CHAIN) {
        await updateBalances()
      }
    }
  }

  const getBalance = async () => {
    await API.Http(
      'get',
      `${process.env.VUE_APP_POLYGON}/v1/wallets/${publicKey.value}/balance`,
    )
      .then(({ data }: any) => {
        coinBalance.value = data.coinsAmount
        maticBalance.value = data.maticAmount
      })
      .catch((err: any) => {
        console.log(err)
      })

    //   .then((res: any) => {
    //     maticBalance.value = parseFloat(res) / 1000000
    //   })
  }

  const checkIfWalletIsConnected = async () => {
    if (!ethereum) {
      // $toast.error('Make sure you have metamask!', {
      //   duration: 3000,
      // })
      return
    }

    try {
      if (cookies.get('private') && cookies.get('public')) {
        connected.value = true
      }
      const accounts = await ethereum.request({ method: 'eth_accounts' })
      await checkAccountAndChain(accounts)
    } catch (err) {
      console.log(err)
      // $toast.error('MetaMask Error', {
      //   duration: 3000,
      // })
    }
  }

  // Подключение кошелька к сайту
  const connectWallet = async () => {
    try {
      const accounts = await ethereum.request({ method: 'eth_requestAccounts' })
      await checkAccountAndChain(accounts)
    } catch (err) {
      console.log(err)
      // $toast.error('MetaMask Error', {
      //   duration: 3000,
      // })
    }
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

  // todo не исправлено
  // Добавление токена Digital Rubles
  const addToken = async (token: 'loap' | 'usdc') => {
    let tokenAddress = ''
    let tokenSymbol = ''
    let tokenDecimals = undefined as unknown as number
    let tokenImage = ''

    //TODO
    if (token === 'loap') {
      // tokenAddress = CONTRACT_ADDRESS
      tokenAddress = 'CONTRACT_ADDRESS'
      tokenSymbol = 'LOAP'
      tokenDecimals = 18
    } else if (token === 'usdc') {
      // tokenAddress = USDC_CONTRACT_ADDRESS
      tokenSymbol = 'USDC'
      tokenDecimals = 18
      tokenImage =
        'https://s2.coinmarketcap.com/static/img/coins/64x64/3408.png'
    }

    try {
      const wasAdded = await ethereum.request({
        method: 'wallet_watchAsset',
        params: {
          type: 'ERC20',
          options: {
            address: tokenAddress,
            symbol: tokenSymbol,
            decimals: tokenDecimals,
            image: tokenImage,
          },
        },
      })
    } catch (error) {
      console.log(error)
      // @ts-ignore
      $toast.error('Metamask error', {
        duration: 3000,
      })
    }
  }

  // todo не исправлено
  // Подтверждение транзакции
  const approveTransaction = async (amount: number) => {
    // $toast.clear()
    return new Promise((resolve, reject) => {
      try {
        let _amount = amount

        if (!amount || amount === 0) {
          _amount = 100000 * 1e6
        }

        // if (allowance.value < _amount) {
        //   if (amount === 0) {
        //     _amount = 100000 * 1e6
        //   } else {
        //     _amount = _amount + 100000 * 1e6
        //   }
        // }

        // $toast.info('Pending approval...', {
        //   duration: 0,
        // })
        isTransfering.value = true

        //await
        // const wasApproved = usdcConnectedContract.approve(
        //   LOAP_CONTRACT_ADDRESS,
        //   String(_amount),
        // )

        //await
        // wasApproved.wait()

        // if (wasApproved) {
        // $toast.success('Approve submitted', {
        //   duration: 0,
        // })
        //   resolve(true)
        // } else {
        //   reject(false)
        // }
        // $toast.clear()
      } catch (error) {
        // $toast.clear()

        console.log(error)
        reject(false)
        // $toast.error('Metamask error', {
        //   duration: 3000,
        // })
      }

      // await
      updateBalances()
    })
  }

  // todo не исправлено
  const initTransaction = async (amount: string | number) => {
    // $toast.clear()
    try {
      // $toast.info('Pending...', {
      //   duration: 0,
      // })
      // const wasTransfered = await connectedContract.buy(String(amount))
      // await wasTransfered.wait()
      isTransfering.value = false
      await updateBalances()

      // $toast.clear()
      // $toast.success('Transaction complete', {
      //   duration: 3000,
      // })
    } catch (error) {
      // $toast.clear()
      isTransfering.value = false
      console.log(error)
      // $toast.error('Metamask error', {
      //   duration: 3000,
      // })
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
  // const publicKey = ref('')

  const createWallet = async () => {
    await API.Http(
      'post',
      `${process.env.VUE_APP_POLYGON}/v1/wallets/new`,
    ).then((res: any) => {
      connected.value = true
      cookies.set('private', res.data.privateKey)
      cookies.set('public', res.data.publicKey)
    })
  }

  const sendCurrency = async (
    amount: number,
    toPublicKey: string,
    currency: cryptoCurrency,
  ) => {
    await API.Http(
      'post',
      `${process.env.VUE_APP_POLYGON}/v1/transfers/${currency}`,
      {
        fromPrivateKey: privateKey.value,
        toPublicKey,
        amount,
      },
    ).then((res) => {
      // todo
      // для совершения переводов в валютах Rubles необходимо наличие Matic, т.к. со счета Matic берется комиссия за совершение транзакций.
      // При нулевом балансе Matic транзакция выполнена не будет!
      console.log('send ', currency)
      console.log('сигнатура транзакции', res.data.transactionHash)
    })
  }

  initSetup()
  checkIfWalletIsConnected()
  // setupEventListener()

  return {
    currentAccount,
    currentChainId,
    isTransfering,
    tokenId,
    maticBalance,
    coinBalance,

    setupEventListener,
    checkIfWalletIsConnected,
    connectWallet,
    switchChain,
    addToken,
    approveTransaction,
    initTransaction,

    /* VTB methods: */
    createWallet,
    sendCurrency,
    getBalance,
    publicKey,
    privateKey,
    connected,
  }
}
