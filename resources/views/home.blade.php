<!DOCTYPE html>
<html>
<head>

<title>Dashboard Humas</title>

<style>

body{
margin:0;
font-family:Segoe UI,Arial;
background:linear-gradient(120deg,#e9e9e9,#f6f6f6);
}

/* HEADER */

.header{
background:linear-gradient(135deg,#2f2f2f,#4a4a4a);
color:white;
padding:28px;
text-align:center;
font-size:30px;
font-weight:bold;
letter-spacing:2px;
box-shadow:0 8px 20px rgba(0,0,0,0.25);
}

/* CONTAINER */

.container{
max-width:1100px;
margin:70px auto;
padding:0 20px;
}

/* GRID */

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
gap:35px;
}

/* CARD */

.card{
background:linear-gradient(145deg,#ffffff,#f3f3f3);
border-radius:20px;
padding:40px 25px;
text-align:center;
box-shadow:0 12px 28px rgba(0,0,0,0.12);
transition:all .3s ease;
position:relative;
}

.card:hover{
transform:translateY(-8px);
box-shadow:0 20px 40px rgba(0,0,0,0.18);
}

/* AVATAR */

.avatar{
width:105px;
height:105px;
border-radius:50%;
margin:auto;
margin-bottom:18px;
display:flex;
align-items:center;
justify-content:center;
font-size:42px;
font-weight:bold;
color:white;
background:linear-gradient(135deg,#2f2f2f,#5a5a5a);
overflow:hidden;
border:5px solid white;
box-shadow:0 10px 22px rgba(0,0,0,0.25);
cursor:pointer;
}

.avatar img{
width:100%;
height:100%;
object-fit:cover;
}

/* MENU FOTO */

.menu{
position:absolute;
top:120px;
left:50%;
transform:translateX(-50%);
background:white;
border-radius:12px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
display:none;
flex-direction:column;
min-width:140px;
z-index:10;
overflow:hidden;
}

.menu button{
border:none;
background:white;
padding:12px;
cursor:pointer;
font-size:13px;
width:100%;
}

.menu button:hover{
background:#f3f3f3;
}

/* NAMA */

.nama{
font-size:22px;
font-weight:600;
margin-bottom:18px;
color:#2f2f2f;
}

/* BUTTON */

.btn{
display:inline-block;
padding:11px 20px;
background:linear-gradient(135deg,#2f2f2f,#4b4b4b);
color:white;
border-radius:10px;
text-decoration:none;
font-size:14px;
transition:.25s;
}

.btn:hover{
transform:translateY(-2px);
box-shadow:0 8px 16px rgba(0,0,0,0.25);
}

input[type=file]{
display:none;
}

</style>

</head>

<body>

<div class="header">
DASHBOARD HUMAS
</div>

<div class="container">

<div class="grid">

@foreach($orang as $o)

<div class="card">

<div class="avatar" onclick="toggleMenu('{{ strtolower($o) }}')">

@if(file_exists(public_path('foto/'.strtolower($o).'.jpg')))
<img src="/foto/{{ strtolower($o) }}.jpg">
@else
{{ strtoupper(substr($o,0,1)) }}
@endif

</div>

<div id="menu-{{ strtolower($o) }}" class="menu">

<form id="form-{{ strtolower($o) }}" action="/upload-foto" method="POST" enctype="multipart/form-data">

@csrf
<input type="hidden" name="nama" value="{{ $o }}">

<input type="file"
id="file-{{ strtolower($o) }}"
name="foto"
onchange="document.getElementById('form-{{ strtolower($o) }}').submit()">

<button type="button"
onclick="document.getElementById('file-{{ strtolower($o) }}').click()">
Ganti Foto
</button>

</form>

<form action="/hapus-foto" method="POST">
@csrf
<input type="hidden" name="nama" value="{{ $o }}">
<button>Hapus Foto</button>
</form>

</div>

<div class="nama">
{{ $o }}
</div>

<a class="btn" href="/orang/{{ strtolower($o) }}">
Lihat Jadwal
</a>

</div>

@endforeach

</div>

</div>

<script>

function toggleMenu(nama){

var menu=document.getElementById("menu-"+nama);

if(menu.style.display=="flex"){
menu.style.display="none";
}else{
menu.style.display="flex";
}

}

</script>

</body>
</html>
