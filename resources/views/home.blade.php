<!DOCTYPE html>
<html>
<head>

<title>Jadwal Piket</title>

<style>

body{
font-family:Arial;
background:#e6e6e6;
margin:0;
}

.container{
width:900px;
margin:80px auto;
text-align:center;
}

h1{
margin-bottom:40px;
}

.list{
display:flex;
gap:20px;
justify-content:center;
flex-wrap:wrap;
}

.card{
background:#2f2f2f;
color:white;
padding:20px 30px;
text-decoration:none;
font-size:20px;
border-radius:5px;
}

.card:hover{
background:#444;
}
</style>

</head>
<body>
<div class="container">

<h1>JADWAL HARIAN
    HUMAS-AKPOL
</h1>

<div class="list">
@foreach($orang as $nama)
<a class="card" href="/orang/{{ $nama }}">
{{ strtoupper($nama) }}
</a>
@endforeach
</div>
</div>
</body>
</html>