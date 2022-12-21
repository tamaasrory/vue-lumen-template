## Documentation

Membuat Migration untuk membuat tabel
```shell
php artisan make:migration CreateJenisSuratTable
```

Run Migration untuk membuat tabel
```shell
php artisan migrate --path=/database/migrations/2021_06_16_085044_create_jenis_surat_table.php
```

Membuat Model berdasarkan tabel
```shell
php artisan make:model Lokasi --table-name=lokasi
```

Membuat Controller
```shell
php artisan make:controller LokasiController --resource --role=surat-keluar --title="Lokasi" --model=Lokasi --force
```

## Use Instant Generator

Auto generate complete frontend and backend by tables
```shell
php artisan instant:app --tables=jadwal_detail

# OR with more tables, do as below :

php artisan instant:app --tables=jadwal_detail,kategori,kelas,lokasi
```

Auto generate backend complete with routes, controller and model by tables
```shell
php artisan instant:backend --tables=jadwal_detail
```

Auto generate vue complate frontend (apis and menus (sidebar & vue router))
```shell
php artisan instant:vue --tables=jadwal_detail
```

Auto generate vue apis, means generate code for communicate with REST Api
```shell
php artisan instant:vue-api --tables=jadwal_detail
```

Auto generate vue menus, means generate code for frontend menus (sidebar) complate with vue router
```shell
php artisan instant:vue-menu --tables=jadwal_detail
```

## Membuat link storage
```shell
ln -rs ./storage/app/public ./public/storage
```

## Melakukan Unit Test

lakukan unit test, pastikan kamu sudah membuat test file di folder ./api/tests. jika sudah jalankan perintah berikut.

```shell
./vendor/bin/phpunit --verbose tests

# OR with spesific file 

./vendor/bin/phpunit --verbose tests/ApiTest.php
```

more about testing https://lumen.laravel.com/docs/8.x/testing
