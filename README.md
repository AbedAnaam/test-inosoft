## Persiapan Pembuatan API (Windows 10 x64)
1.  Instalasi PHP 8 dan sesuaikan dengan pengaturan yang ada di masing-masing Sistem Operasi 
    yang digunakan.
2.  Instalasi MongoDB dan jika sudah selesai. Jalankan perintah berikut ini pada command prompt :
    C:\DirektoriInstalasiMongoDB --dbpath=C:\DirektoriLetakDatabaseDisimpan
3.  Instalasi Laravel 8 seperti pada dokumentasi Laravel.

## Konfigurasi MongoDB
1.  Download file php_mongodb.dll dari website http://pecl.php.net dan sesuaikanlah dengan versi 
    PHP yang digunakan.
2.  Masukkan file php_mongodb.dll yang sudah di-download tadi ke dalam folder instalasi PHP -> 
    ext
3.  Edit file php.ini dan tambahkan baris ' extension=php_mongodb.dll '
4.  Jalankan perintah ' composer require jenssegers/mongodb ' dari proyek Laravel.
5.  Edit file config/database.php, kemudian set pada bagian 'default' menjadi mongodb.
    Dan tambahkan ini pada bagian 'connections'
        'mongodb' => [
            'driver'    => 'mongodb',
            'host'      => env('MONGO_DB_HOST', 'localhost'),
            'port'      => env('MONGO_DB_PORT', '27017'),
            'database'  => env('MONGO_DB_DATABASE', 'backend_inosoft'),
            'username'  => env('MONGO_DB_USERNAME', ''),
            'password'  => env('MONGO_DB_PASSWORD', ''),
            'options'   => ['database' => 'backend_inosoft']
        ]
6.  Copy file .env.example menjadi .env. Kemudian, konfigurasi pada bagian .env-nya seperti berikut :
            MONGO_DB_CONNECTION = mongodb
            MONGO_DB_HOST       = 127.0.0.1
            MONGO_DB_PORT       = 27017
            MONGO_DB_DATABASE   = backend_inosoft
            MONGO_DB_USERNAME   = 
            MONGO_DB_PASSWORD   =
7.  Tambahkan 'providers' di file config/app.php dengan :
        Jenssegers\Mongodb\MongodbServiceProvider::class,

## Download file dari Git menggunakan Git Clone
    * Clone file dengan perintah : git clone https://github.com/AbedAnaam/test-inosoft
    * Hidupkan dbservice mongo seperti bagian Persiapan Pembuatan API (Windows 10 x64) poin ke-2.
    * Buka terminal dan arahkan ke folder hasil clone tadi kemudian jalankan perintah artisan serve
        -- php artisan serve
    * Untuk melihat daftar route bisa mengetikkan 'php artisan route:list'

## Register dan Login API (Menggunakan POSTMAN)
1.  Buka aplikasi POSTMan.
2.  Register User ==> localhost:port/api/register           (METHOD : POST)
        Pada bagian body (pilih raw dan ubah tipe menjadi JSON) silakan tambahkan name, email, password, password_confirmation dan sesuaikan dengan format JSON.
3.  Login User ==> localhost:port/api/login                 (METHOD : POST)
        Pada bagian body (pilih raw dan ubah tipe menjadi JSON) silakan tambahkan email dan password
        dan sesuaikan dengan format JSON.
4.  Lihat user yang active ==> localhost:port/api/get_user  (METHOD : GET)
        Pada bagian body (pilih raw dan ubah tipe menjadi JSON) silakan tambahkan token dan sesuaikan dengan format JSON.
5.  Logout User ==> localhost:port/api/logout               (METHOD : GET)
        Pada bagian body (pilih raw dan ubah tipe menjadi JSON) silakan tambahkan token dan sesuaikan dengan format JSON.

## Request Data Mobil (Pengguna Harus Login untuk Mendapat Token sebagai Autentifikasi)
1.  Tambah Data Mobil ==> localhost:port/api/mobil          (METHOD : POST)
        -   Pada bagian Headers set Key menjadi Authorization dan tambahkan Value yakni Bearer Token.
            Token didaptkan ketika pengguna melakukan login.
        -   Pada bagian body (pilih raw dan ubah tipe menjadi JSON) silakan tambahkan mesin,        
            kapasitas_penumpang dan tipe dan sesuaikan dengan format JSON.

2.  Lihat Data Mobil ==> localhost:port/api/mobil            (METHOD : GET)
        -   Pada bagian Headers set Key menjadi Authorization dan tambahkan Value yakni Bearer Token.
            Token didaptkan ketika pengguna melakukan login.

3.  Lihat Mobil By ID ==> localhost:port/api/mobil/_id      (METHOD : GET)
        -   Pada bagian Headers set Key menjadi Authorization dan tambahkan Value yakni Bearer Token.
            Token didaptkan ketika pengguna melakukan login.

4.  Update Data Mobil ==> localhost:port/api/mobil/_id      (METHOD : PUT)
        -   Pada bagian Headers set Key menjadi Authorization dan tambahkan Value yakni Bearer Token.
            Token didaptkan ketika pengguna melakukan login.
        -   Pada bagian body (pilih raw dan ubah tipe menjadi JSON) silakan ubah mesin,        
            kapasitas_penumpang dan tipe dan sesuaikan dengan format JSON.

5.  Delete Data Mobil By ID ==> localhost:port/api/mobil/_id  (METHOD : DELETE)
        -   Pada bagian Headers set Key menjadi Authorization dan tambahkan Value yakni Bearer Token.
            Token didaptkan ketika pengguna melakukan login.

## Request Data Motor (Pengguna Harus Login untuk Mendapat Token sebagai Autentifikasi)
    Untuk request data motor bisa mengikuti langkah-langkah pada Request Data Mobil. Hanya 
    disesuaikan saja url-nya menjadi localhost:port/api/motor

## Request Data Kendaraan (Pengguna Harus Login untuk Mendapat Token sebagai Autentifikasi)
    Untuk request data kendaraan bisa mengikuti langkah-langkah pada Request Data Mobil. Hanya 
    disesuaikan saja url-nya menjadi localhost:port/api/kendaraan