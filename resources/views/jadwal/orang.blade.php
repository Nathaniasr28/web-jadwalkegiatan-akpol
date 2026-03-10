<!DOCTYPE html>
<html>
<head>

<title>Jadwal Piket</title>

<style>

body{
margin:0;
font-family:Segoe UI, Arial;
background:#e6e6e6;
}

.container{
width:1000px;
margin:40px auto;
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
}

.date{
font-size:14px;
color:#333;
}

.nama{
font-size:40px;
font-weight:bold;
font-style:italic;
}

.title{
background:#2f2f2f;
color:white;
padding:18px 40px;
font-size:26px;
border-radius:8px;
}

/* DATE PICKER */

.form-tanggal{
margin-top:20px;
margin-bottom:20px;
}

input[type=date]{
padding:8px;
font-size:14px;
border-radius:6px;
border:1px solid #ccc;
}

button{
padding:8px 14px;
background:#2f2f2f;
color:white;
border:none;
border-radius:6px;
cursor:pointer;
}

/* TABLE STYLE */

table{
width:100%;
border-collapse:separate;
border-spacing:0;
background:white;
border-radius:10px;
overflow:hidden;
box-shadow:0 4px 15px rgba(0,0,0,0.15);
}

th{
background:#2f2f2f;
color:white;
padding:14px;
font-size:14px;
letter-spacing:1px;
}

td{
border-bottom:1px solid #eee;
height:60px;
text-align:center;
}

tr:nth-child(even){
background:#fafafa;
}

tr:hover{
background:#f2f2f2;
transition:0.2s;
}

/* INPUT */

input[type=text]{
width:85%;
padding:8px;
border:1px solid #ddd;
border-radius:6px;
font-size:14px;
outline:none;
}

input[type=text]:focus{
border-color:#2f2f2f;
}

/* CHECKBOX */

input[type=checkbox]{
width:18px;
height:18px;
cursor:pointer;
}

/* STATUS ICON */

.check{
background:#2f2f2f;
color:white;
border-radius:50%;
padding:6px 8px;
}

.cross{
background:#ff4b4b;
color:white;
border-radius:50%;
padding:6px 8px;
}

/* SAVE BUTTON */

.save-btn{
margin-top:25px;
padding:12px 26px;
font-size:14px;
border-radius:8px;
background:#2f2f2f;
color:white;
border:none;
cursor:pointer;
}

.save-btn:hover{
background:#444;
}

</style>

</head>

<body>

<div class="container">

<div class="header">

<div>

<div class="date">
DATE: {{ date('d/m/Y', strtotime($tanggal)) }}
</div>

<div class="nama">
{{ $nama }}
</div>

</div>

<div class="title">
JADWAL PIKET HARIAN
</div>

</div>

<div class="form-tanggal">

<form method="GET">

<label>Pilih Tanggal :</label>

<input type="date" name="tanggal" value="{{ $tanggal }}">

<button type="submit">Lihat</button>

</form>

</div>


<form method="POST" action="/simpan-jadwal">

@csrf

<input type="hidden" name="nama" value="{{ strtolower($nama) }}">
<input type="hidden" name="tanggal" value="{{ $tanggal }}">

<table>

<tr>
<th width="70">NO</th>
<th width="150">JAM</th>
<th>TUGAS</th>
<th>TEMPAT</th>
<th width="120">
<span class="cross">✖</span>
<span class="check">✔</span>
</th>
</tr>

@for($i=1;$i<=5;$i++)

<tr>

<td><b>{{ $i }}</b></td>

<td>
<input type="text" name="jam[]" placeholder="07:00">
</td>

<td>
<input type="text" name="tugas[]" placeholder="Isi tugas">
</td>

<td>
<input type="text" name="tempat[]" placeholder="Lokasi">
</td>

<td>
<input type="checkbox" name="status[{{ $i }}]">
</td>

</tr>

@endfor

</table>

<button class="save-btn" type="submit">
SIMPAN JADWAL
</button>

</form>

</div>

</body>
</html>