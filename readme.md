# Documentation
## Development

Frontend Project setup

```shell
npm install
```

if you have trouble with npm install, please try as below
```shell
npm install --force

# OR

npm install --legacy-peer-deps
```

Backend Project setup

```shell
cd api/ && composer install
```

Run Backend for development

```shell
cd api/ && composer serve

# OR

npm run start-backend
```
Dont forget to Read backend documentation [README.md](./api/README.md)

<br>
Run Frontend for development 

```shell
npm run start-frontend

# OR start frontend with https

npm run secure-frontend
```

## Production

Compiles and minifies for production

```shell
npm run build
```
Lints and fixes files

```shell
npm run lint
```

## Need Support or Have Issues
please contact me visit https://tamaasrory.com


## Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).
