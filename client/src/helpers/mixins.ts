/**
 * Calls the passed validators and writes the result
 * @param validators
 * @param value
 * @return {string}
 */
export const validate = (validators: any, value: any) => {
  if (validators.length) {
    let result
    for (const validator of validators) {
      if (validator === undefined) continue
      result = validator(value)
      if (result !== '') return result
    }
  }
  return ''
}

export const getRandomInt = (min: number, max: number) => {
  min = Math.ceil(min)
  max = Math.floor(max)
  return Math.floor(Math.random() * (max - min) + min) // The maximum is exclusive and the minimum is inclusive
}

/**
 * yyyy-mm-dd => dd.mm.yyyy
 * @param input
 */
export const formatDate = (input: string) => {
  const datePart = input.split('-')
  const year = datePart[0] // get only two digits
  const month = datePart[1]
  const day = datePart[2]

  return day + '.' + month + '.' + year
}
