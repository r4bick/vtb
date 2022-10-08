FROM node:14.18.0-alpine as build-stage

WORKDIR /app
COPY package.json .
COPY package-lock.json .

RUN npm install
COPY . .

ARG API_URL="http://62.109.19.231/api"
ARG APP_API_VTB="https://hackathon.lsp.team/hk"

RUN echo "VUE_APP_BASE_URL=${API_URL}" > .env
RUN echo "VUE_APP_API_VTB=${APP_API_VTB}" > .env
RUN npm run build

FROM nginx:stable-alpine as production-stage
COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY --from=build-stage /app/dist /usr/share/nginx/html
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
