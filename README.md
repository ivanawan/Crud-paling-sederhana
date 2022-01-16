<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## SetUp Project 

Pertama buat Sebuah database dengan nama laravel di [PhpMyadmin](http://tutorbuatdb), Setelah DataBase di buat, kita create new project mengunakan [composer](http://composer), sebelum itu pastikan terlebih dahulu di komputer kalian sudah terinstall composer caranya ketik composer di cmd/terminal jika muncul logo composer berarti composer sudah terInstall di komputer kalian, pastikan juga kalian mempunyai koneksi internet.   


- Buka cmd/terminal kalian lalu ketikan perintah berikut:
 ``` 
 mkdir  Project 

cd Project 

composer create-project laravel/laravel Crud_laravel

 ```
- Setelah project berhasil dibuat kalian buka mengunakan vs code / code editor lain.  
- Lalu kita buka file **.ENV** pada bagian <span style="background-color:#fff4">DB_DATABASE=nama_db</span> secara default menggunakan database dengan nama laravel, jadi kita tidak perlu merubah nama database. tapi jika kamu membuat databse dengan nama DB_perpustakaan misalkan maka kodenya akan menjadi seperti ini <span style="background-color:#fff4">DB_DATABASE=DB_perpustakaan</span>.
- Buka terminal->new terminal atau <span style="background-color:#ff24 ;">Ctrl + shift +`</span> kita coba  menjalankan laravel dengan perintah : 
``` 
php  artisan serve 
``` 

   
## Membuat migration 

 migration adalah suatu fitur pada laravel yang memungkin kan kita, mengelola databse dengan lebih mudah dan cepat.

 - pertama buka <span style="background-color:#ff24 ;">Terminal-> New Terminal</span> ketik perintah:
  
  ``` 
  php artisan make:migration persons
  ```
- lalu akan tergenerate sebuah file secara otomatis di folder 
   <span style="background-color:#ff24 ;">Database->migration</span>. di bagian paling bawah terdapat sebuah file migration yang terdapat kata persons, contoh <span style="background-color:#ff24 ;">2022_01_12_000633_persons.php</span>. kemudian buka file tersebut dan edit menjadi seperti ini:
 ``` 
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // tambahin baris ini
        Schema::Create('persons',function(Blueprint $table){ 
        $table->id();
        $table->String('nama');
        $table->String('kelas');
        });
        // sampe sini
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   // sama yang ini juga
        Schema::drop('persons');
    }
}
```
 - setelah file migration selesai  di buat  dan di simpan. kemudian kita migarte ke database, caranya buka terminal seperti tadi ketik:
  ```
  php artisan migrate 
  ```
 - jika semuanya  langkah2 nya benar maka akan ada tabel baru di database laravel kita.
  # Get data 

 - setelah kita melakukan migration sekarang kita akan 
 membuat CrudController.php yang nantinya menjadi tempat kita melakukan crud, untuk membuat controller cara nya sama dengan migration mengunakan terminal.

  ```
  php artisan make:controller CrudController
  ```
- setelah itu akan ada file baru di folder **App->Http->controller**
  lalu kita akan membuat sebuah function baru bernama index. disini kita akan menampilakan data persons dari database dengan view wellcome yang nanti kita ubah :

  ```
  public function index(){
        return view("welcome");
    }
  ```

- kemudian kita ubah sedikit routnya agar terhubung ke CrudController. file route berada di folder **routes->web.php** lalu import class CrudCotroller  dengan cara menempatkan code berikut di bagian atas file :
  ```
  use App\Http\Controllers\CrudController;
  ```
  kemudian ubah routnya menjadi seperti ini.
  ```
  Route::get('/',[CrudController::class,'index']);
  ```
  disini route utama akan di arahkan ke dalam CrudController function index. coba refresh page browserjika tidak error maka route sudah berhasil terhubung ke controller.

  - kali ini kita kan mengambil dari dari databse dengan [query bulder](http://sjdhfgkjsdha) edit file index tadi menjadi seperti ini 
  ```
  public function index(){
        return view("welcome",[
            'persons'=>DB::table('persons')->get(),
        ]);
    }
  ```
  jangan lupa menambahkan kode ini di atas class CrudeController
  ```
  use Illuminate\Support\Facades\DB;
  ```
- kemudian kita edit view wellcome.blade.php menjadi seperti ini 
  ```
  <!DOCTYPE html>
   <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
      

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            table,th,td{
                border:1px solid black;
            }
        </style>
    </head>
    <body >
    <a href="/add" style="background-color:green">add</a>

      <table >
          <thead>
          <tr>
              <td>id</td>
              <td>nama</td>
              <td>kelas</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
              @foreach ($persons as $person)
           <tr>
           <td>{{$person->id}}</td>
           <td>{{$person->nama}}</td>
           <td>{{$person->kelas}}</td>
           <td style="pading: 3px"> 
               <a href="{{'/edit/'.$person->id}}" style="background-color:yellow">edit</a>
               <a href="{{'/delete/'.$person->id}}" style="background-color:red">delete</a>
           </td>
           </tr>
             @endforeach
          </tbody>
      </table>
    </body>
  </html>
  ```  
  - pada bagian view kita mengunakan fungsi @foreach untuk me looping array yang berada di dalam variabel persons. di dalam fungsi tersebut setiap array person akan membuat 1 baris table baru / setiap kali looping kode yang berda didalam fungsi @foreach akan di jalankan lagi. 
  - untuk mengambil data dari variabel person seperti ini, jika ingin id pada kolom id dengan cara : 
  ```
   <td>{{$person->id}}<td> 
  ```
   ketika sudah di render browser akan menjadi seperti ini misal looping pertama memiliki id = 1  
  ```
   <td>1<td> 
  ```
    



  # Insert data ke dalam database


-  Step pertama buat view baru bernama forms.blade.php di folder resources->view dan edit menjadi seperti ini. 
  ```
  <html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            input{
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        <form method="POST" action="/post"  >
        @csrf
            <label>nama</label>
            <input  type="text" name="nama"><br>
            <label>kelas</label>
            <input type="text"  name="kelas"><br >
            <button type="submit">submit</button>
        </form>
    </body>
</html>
```
- dari kode tersebut ada beberapa hal yang harus di perhatikan.
  yang pertama pada tag form .
  ``` 
  <form method="POST" action="/post" >
  ``` 
  di sini kita mendefinisikan bahwa kita akan mengunakan **method post** untuk mengrim data. action disini kita  mendefinisikan lokasi tujuan data dkirim kemana? disini kita akan mengirim data ke url  **/post**, jadi action nya di isi **/post**.

  kemudian di bagian :
  ``` 
  @csrf 
  ```
  csrf pada laravel adalah sebuah token yang di generate secara otomatis, pengunaan  @csrf  ini wajib ya jika tidak maka akan error **419 PAGE EXPIRED**.
  
  setelah itu pada bagian.
  ```
  <input  type="text" name="nama">
  ``` 
  yang penting disini adalah atribute name. data yang di inputkan akan dikirim dalam betuk array [key=>value]. isi atribut name akan menjadi key sedangkan data yang dimputkan akan menjadi value.
 seperti ini:
   
   **["nama"=>"data yang di inputkan kedalam field"]**

   **["kelas"=>"data yang di inputkan kedalam field"]**



- langkah selanjunya adalah mendefinisikan route di <span style="background-color:#ff24 ;">routes->web.php</span> dengan menambahkan route /post untuk post datanya.
```
Route::post('/post',[CrudController::class,'Store']);
```
  
 