<!DOCTYPE html>
<html>
<head>

<title>Dashboard Jadwal</title>

<style>

body{
margin:0;
font-family:Segoe UI, Arial;
background:#e6e6e6;
}

/* HEADER */

.header{
background:#2f2f2f;
color:white;
padding:20px 40px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

.logo{
font-size:22px;
font-weight:bold;
letter-spacing:1px;
}

.sub{
font-size:13px;
color:#ccc;
}

/* CONTAINER */

.container{
width:1050px;
margin:50px auto;
}

/* TITLE */

.title{
font-size:32px;
font-weight:bold;
color:#2f2f2f;
margin-bottom:10px;
}

.desc{
color:#666;
margin-bottom:35px;
}

/* GRID */

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:25px;
}

/* CARD */

.card{
background:white;
border-radius:12px;
padding:25px;
text-align:center;
box-shadow:0 6px 18px rgba(0,0,0,0.12);
transition:0.25s;
}

.card:hover{
transform:translateY(-6px);
box-shadow:0 10px 25px rgba(0,0,0,0.18);
}

/* AVATAR */

.avatar{
width:70px;
height:70px;
border-radius:50%;
background:#2f2f2f;
color:white;
display:flex;
align-items:center;
justify-content:center;
font-size:26px;
margin:0 auto 15px auto;
}

/* NAME */

.name{
font-size:20px;
font-weight:bold;
margin-bottom:15px;
color:#2f2f2f;
}

/* BUTTON */

.btn{
display:inline-block;
padding:8px 16px;
background:#2f2f2f;
color:white;
text-decoration:none;
border-radius:6px;
font-size:14px;
transition:0.2s;
}

.btn:hover{
background:#444;
}

/* FOOTER */

.footer{
text-align:center;
margin-top:60px;
color:#888;
font-size:13px;
}

</style>

</head>

<body>

<div class="header">

<div>
<div class="logo">
SISTEM JADWAL PENUGASAN HARIAN</div>
<div class="sub">
Pengelolaan Jadwal Harian
</div>
</div>

</div>


<div class="container">

<div class="title">
Dashboard Jadwal
</div>

<div class="desc">
Pilih nama untuk melihat atau mengisi jadwal harian.
</div>


<div class="grid">

@foreach($orang as $o)

<div class="card">

<div class="avatar">
{{ strtoupper(substr($o,0,1)) }}
</div>

<div class="name">
{{ strtoupper($o) }}
</div>

<a class="btn" href="/orang/{{ $o }}">
Lihat Jadwal
</a>

</div>

@endforeach

</div>

<div class="footer">
Jadwal Tugas Harian
</div>

</div>

</body>
</html>