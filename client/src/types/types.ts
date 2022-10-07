export type Validator =
  | ((value: string) => string)
  | ((value: number) => string)
