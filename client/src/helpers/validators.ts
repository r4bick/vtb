import { Validator } from '@/types/types'

import { formatWordEnding } from '@/helpers/formatters'

export function required(value: string): string {
  return !value ? 'Обязательное поле' : ''
}

export function maxString(max: number): Validator {
  return (value: string): string => {
    return value.length > max ? `Максимум ${max} символов ` : ''
  }
}

export function minString(min: number): Validator {
  return (value: string): string => {
    return value.length < min ? `Минимум ${min} символов` : ''
  }
}

export function maxValue(max: number): Validator {
  return (value: string | number): string => {
    return Number(value) > max ? `Максимальное значение ${max}` : ''
  }
}

export function minValue(min: number): Validator {
  return (value: string | number): string => {
    return Number(value) < min ? `Минимальное значение ${min}` : ''
  }
}

export function format(
  format: RegExp,
  errorText = 'Некорректный формат',
): Validator {
  return (value: string): string => {
    return !format.test(value) ? errorText : ''
  }
}

export function onlyNumber(value: string): string {
  if (value) {
    return !/^-?\d+[.,]?\d*$/.test(value) ? 'Только цифры' : ''
  } else return ''
}

/**
 * Количество символов после запятой
 * @param length - Количество знаков после запятой
 * @return {Validator} - Валидатор
 */
export function floatLength(length: number): Validator {
  return (value: string): string => {
    if (value.includes('.')) {
      const symbolWord = formatWordEnding(length, 'знак', ['', 'а', 'ов'])
      const numbersAfterDecimalPoint = value.split('.')[1].length
      return numbersAfterDecimalPoint > length
        ? `Максимум ${length} ${symbolWord} после запятой`
        : ''
    }

    return ''
  }
}

/**
 * Проверяет целое число это или нет
 * @param value - Значение инпута
 * @return {string} - Строка с ошибкой
 */
export function onlyInteger(value: string): string {
  return value.includes('.') ? 'Только целые числа' : ''
}

export function dateEqualOrLessThen(minDate: number): Validator {
  return (value: number): string => {
    return value <= minDate ? 'Некорректная дата' : ''
  }
}

export function dateLessThenNow(date: number): string {
  return date <= Date.now() ? 'Невозможно установить дату раньше текущей' : ''
}

export const email: Validator = (value: string): string => {
  return value.match(
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
  )
    ? ''
    : 'Невалидный e-mail'
}
