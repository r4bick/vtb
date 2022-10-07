import { computed, reactive } from 'vue'

/**
 * Композобл для валидации форм
 * @param fieldsCount - количество полей в форме
 */
export const useFormValidation = (fieldsCount: number) => {
  const errors = reactive<boolean[]>(new Array(fieldsCount).fill(false))

  /**
   * Устанавливает ошибку по конкретному индексу поля
   * @param fieldIndex - индекс поля формы
   * @param value - флаг о наличии ошибки
   */
  const setError = (fieldIndex: number, value: boolean): void => {
    errors[fieldIndex] = value
  }

  /**
   * Возвращает true если в массиве указано, что хоть одно поле ошибочное
   * Пример: hasErrors => true, если [false, false, true, false]
   */
  const hasErrors = computed(() => {
    return errors.includes(true)
  })

  return { errors, setError, hasErrors }
}
