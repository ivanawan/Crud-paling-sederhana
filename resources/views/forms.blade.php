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
        <form method="POST" @if(isset($edit)) action="{{'/post/edit/'.$edit->id}}" @else action="/post" @endif >
        @csrf
            <label>nama</label>
            <input  type="text"  @if(isset($edit)) value="{{$edit->nama}}" @endif name="nama"><br>
            <label>kelas</label>
            <input type="text"  @if(isset($edit)) value="{{$edit->kelas}}" @endif name="kelas"><br >
            <button type="submit">submit</button>
        </form>
    </body>
</html>
