/**
 * Форматирует окончание слова в зависимости от числа
 * 1 порций -> 1 порция
 *
 */
export function formatWordEnding(
  number: number,
  wordWithoutEnding: string,
  endings: string[],
): string {
  const cases = [2, 0, 1, 1, 1, 2]
  return (
    wordWithoutEnding +
    endings[
      number % 100 > 4 && number % 100 < 20
        ? 2
        : cases[number % 10 < 5 ? number % 10 : 5]
    ]
  )
}
