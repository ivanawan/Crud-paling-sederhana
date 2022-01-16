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
