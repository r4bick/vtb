import { ref } from 'vue'
import { ethers } from 'ethers'
// import loapContract from '../utils/loapContract.json'
// import usdcAbi from '../utils/usdcAbi.json'
import 'mosha-vue-toastify/dist/style.css'

export const MAIN_CHAIN = '0x89' //Chain Polygon Mainnet in hex

// import {
//   LOAP_CONTRACT_ADDRESS,
//   MAIN_CHAIN,
//   USDC_CONTRACT_ADDRESS,
// } from '@/assets/scripts/globalCryptoVariables'

interface ApiError {
  code: number
  message: string
}

export function useEthereum(CONTRACT_ADDRESS: string) {
  // @ts-ignore
  const { ethereum } = window

  const currentAccount = ref('')
  const currentChainId = ref('')
  const isTransfering = ref(true)

  const tokenId = ref('')

  const usdcBalance = ref(0)
  const loapBalance = ref(0)

  const allowance = ref(0)

  let provider = undefined
  let signer = undefined

  // let connectedContract = undefined as any
  // let usdcConnectedContract = undefined as any

  const initSetup = () => {
    if (ethereum) {
      provider = new ethers.providers.Web3Provider(ethereum)
      signer = provider.getSigner()
      // connectedContract = new ethers.Contract(
      //   CONTRACT_ADDRESS,
      //   // loapContract.abi,
      //   signer,
      // )
      // usdcConnectedContract = new ethers.Contract(
      //   USDC_CONTRACT_ADDRESS,
      //   // usdcAbi.abi,
      //   signer,
      // )
    }
  }

  initSetup()

  const chainListener = async (chainId: string) => {
    currentChainId.value = chainId

    if (chainId !== MAIN_CHAIN) {
      // $toast.error('You are not connected to the Polygon Network!', {
      //   duration: 3000,
      // })
      loapBalance.value = 0
      usdcBalance.value = 0
    } else {
      initSetup()

      await updateBalances()
      await checkAllowance()
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
      await getUSDCBalance()
      await getLOAPBalance()
    }
  }

  const checkAllowance = async () => {
    // const allow = await usdcConnectedContract.allowance(
    //   currentAccount.value,
    //   LOAP_CONTRACT_ADDRESS,
    // )
    // allowance.value = parseInt(allow)
  }

  const checkAccountAndChain = async (accounts: string[]) => {
    if (accounts.length !== 0) {
      currentAccount.value = accounts[0]
      currentChainId.value = await ethereum.request({ method: 'eth_chainId' })

      if (currentChainId.value === MAIN_CHAIN) {
        await updateBalances()
        await checkAllowance()
      }
    }
  }

  const getUSDCBalance = async () => {
    // await usdcConnectedContract
    //   .balanceOf(currentAccount.value)
    //   .then((res: any) => {
    //     usdcBalance.value = parseFloat(res) / 1000000
    //   })
    //   .catch((err: any) => {
    //     console.log(err)
    // $toast.error('Metamask error', {
    //   duration: 3000,
    // })
    // })
  }

  const getLOAPBalance = async () => {
    // await connectedContract
    //   .balanceOf(currentAccount.value)
    //   .then((res: any) => {
    //     loapBalance.value = parseFloat(ethers.utils.formatUnits(res, 18))
    //   })
    //   .catch((err: any) => {
    //     console.log(err)
    // $toast.error('Metamask error', {
    //   duration: 3000,
    // })
    // })
  }

  const checkIfWalletIsConnected = async () => {
    if (!ethereum) {
      // $toast.error('Make sure you have metamask!', {
      //   duration: 3000,
      // })
      return
    }

    try {
      const accounts = await ethereum.request({ method: 'eth_accounts' })
      await checkAccountAndChain(accounts)
    } catch (err) {
      console.log(err)
      // $toast.error('MetaMask Error', {
      //   duration: 3000,
      // })
    }
  }

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
                // chainId: ethers.utils.hexValue(137),
                chainName: 'Polygon',
                rpcUrls: ['https://polygon-rpc.com'],
                blockExplorerUrls: ['https://polygonscan.com'],
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

  const addToken = async (token: 'loap' | 'usdc') => {
    let tokenAddress = ''
    let tokenSymbol = ''
    let tokenDecimals = undefined as unknown as number
    let tokenImage = ''

    if (token === 'loap') {
      tokenAddress = CONTRACT_ADDRESS
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

  const approveTransaction = async (amount: number) => {
    // $toast.clear()
    return new Promise((resolve, reject) => {
      try {
        let _amount = amount

        if (!amount || amount === 0) {
          _amount = 100000 * 1e6
        }

        if (allowance.value < _amount) {
          if (amount === 0) {
            _amount = 100000 * 1e6
          } else {
            _amount = _amount + 100000 * 1e6
          }
        }

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
      checkAllowance()
    })
  }

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
      await checkAllowance()

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

  return {
    currentAccount,
    currentChainId,
    isTransfering,
    tokenId,
    usdcBalance,
    loapBalance,
    allowance,
    setupEventListener,
    checkIfWalletIsConnected,
    connectWallet,
    switchChain,
    addToken,
    approveTransaction,
    initTransaction,
  }
}
