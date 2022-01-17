<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# SetUp Project 

Pertama buat Sebuah database dengan nama laravel di [PhpMyadmin](https://www.dewaweb.com/blog/cara-membuat-database-di-xampp/), Setelah DataBase di buat, kita create new project mengunakan [composer](https://www.niagahoster.co.id/blog/cara-install-composer/), sebelum itu pastikan terlebih dahulu di komputer kalian sudah terinstall composer caranya ketik composer di cmd/terminal jika muncul logo composer berarti composer sudah terInstall di komputer kalian, pastikan juga kalian mempunyai koneksi internet.   


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

   
# Membuat migration 

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

  - kali ini kita kan mengambil dari dari databse dengan [query bulder](https://laravel.com/docs/8.x/queries) edit file index tadi menjadi seperti ini 
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
  pada function tersebut kita me return sebuah view dengan mengirimkan sebuah array persons dengan valu dari data yang di dapatkan dari tabel persons. atu bisa di tulis seperti ini:
  ```
  public function index(){
       $data_persons= DB::table('persons')->get();
        return view("welcome",[
            'persons'=>$data_persons,
        ]);
    }
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
- lalu pada bagian crud controller buat sebuah fungsi baru bernama Store.
  kalian harus meperhatikan penulisan huruf kecil dan besar. misal Store dan store dianggap berbeda.
  ```
  public function Store(Request $request){
        DB::table('persons')->insert($request->except('_token'));
        return redirect('/');
  }
  ``` 
  pada bagian parameter di isi Variabel $request untuk menangkap data yang dikirimkan dari route /post. pada kode tersebut kita melakukan oprasi Mass Assignment dimana kita langsung menyimpan data dari view, dengan kodisi bahwa name pada form memiliki nama yang sama dengan yang ada pada tabel database. disitu kita juga mengkeculikan **_token** token adalah hasil dari rendering @csrf  yang berada di view. jika ingin melihat data apa saja yang ada pada $request bisa mengunaka cara berikut.
  ```
   public function Store(Request $request){
       dd($request->all());
        DB::table('persons')->insert($request->except('_token'));
        return redirect('/');
  }
  ``` 
  ohya return di sini maksudnya ketika data telah di simpan akan di kembalikan ke route **/** atau route utama.

  # Update Data 
  di wellcome view kan kita udah nambahin button update yang ini
  ```
  <a href="{{'/edit/'.$person->id}}" style="background-color:yellow">edit</a>
  ```
  di sini jika di pencet akan di arahkan ke halaman /edit/param_id.
 - sekarang kita bikin Route untuk edit di bagian routes->web.php seperti yang sebelumnya lalu tambahkan 
   ```
   Route::get('/edit/{id}',[CrudController::class,'edit']);
   ``` 
   disini yang perlu diperhatikan kita menangkap parameter id dengan mengunakan **{id}** lalu kita akan mengarahkan route ke function edit.

 - membuat function edit di CrudController
  ```
  public function edit($id){
        return view('forms',[
            'edit'=>DB::table('persons')->where('id',$id)->first()
        ]);
    }
  ```
  disini kita menambahkan parameter pada bagian function edit sesui dengan nama variabel yang di tangkap di Route contoh di route 
  ```
  Route::get('/edit/{userId}',[CrudController::class,'edit']);
  ``` 
  maka di controller paramnya menjadi **$userId**. disini kita akan mengambil data yang bertujuan untuk di tampilkan di forms.blade.php 
  
- selanjutnya kita akan merubah form.blade.php pada bagian tag form menjadi seperti ini.
  ```
    <form method="POST" @if(isset($edit)) action="{{'/post/edit/'.$edit->id}}" @else action="/post" @endif >
        @csrf
            <label>nama</label>
            <input  type="text"  @if(isset($edit)) value="{{$edit->nama}}" @endif name="nama"><br>
            <label>kelas</label>
            <input type="text"  @if(isset($edit)) value="{{$edit->kelas}}" @endif name="kelas"><br >
            <button type="submit">submit</button>
        </form>
  ```
  disini saya mengunakan if else jika variabel $edit ada maka akan jadi form edit 
  variabel edit kita set saat mereturn view di functioin edit.
  atau jika kamu mau membuat from edit secara tepisah bisa seperti ini.
  ```
  <html>
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        

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
        <form method="POST" action="{{'/post/edit/'.$edit->id}}"  >
        @csrf
            <label>nama</label>
            <input  type="text" value="{{$edit->nama}}"><br>
            <label>kelas</label>
            <input type="text"   value="{{$edit->kelas}}" ><br >
            <button type="submit">submit</button>
        </form>
    </body>
   </html>

  ```
 bisa kita liat tidak jauh berbeda dari form input. bedanya cuma di bagian action routnya sama attribut value pada tag input untuk menampilkan data di kolom input.
 jadi saya sarankan mengunakan cara yang pertama untuk mempersingkat waktu. 

- lalu kita tambahkan route untuk route post/edit/param_id
  ```
   Route::post('/post/edit/{id}',[CrudController::class,'update']);
  ``` 
  di bagian ini seperti pada route /edit kita akan menangkap variabel id
  lalu kita retun ke function update.

- ya pada function update kita mengunakan $request dan $id sebagai parameter 
  ```
   public function update(Request $request, $id){
        DB::table('persons')->where('id', $id)->update($request->except('_token'));
         return redirect('/'); 
    }
  ```
  pada bagian ini kita mengunakan where clause untuk mencari data dengan id yang sama dengan variabel $id lalu jika ketemu kita update. untuk update mirip seperti insert yang sebelumnya ya, lalu kita retrun ke halaman utama.

# Delete data 
pada bagian ini kita juga sudah membuat button nya di view wellcome 
  ``` 
  <a href="{{'/delete/'.$person->id}}" style="background-color:red">delete</a> 
  ```
- pertama2 bikin routnya dulu
  
 ```
Route::get('/delete/{id}',[CrudController::class,'delete']);
 ```
 di bagian ini hampir sama seperti rote /edit disini kita juga akan menangkap Variabel id lalu kia kirimkan di controller.

- di controller  buat sebuah function baru bernama **delete**
```
public function delete($id){
        DB::table('persons')->where('id', $id)->delete();
        return redirect('/');
    }
```   
disini kita cari dulu data di tabel persons yang id nya sama dengan  kolom id 
**where('id',$id)** lau kita pangil fungsi delete **delete()** lalu jika sudah kita retun ke route utama.





