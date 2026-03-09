<!DOCTYPE html>
<html>
<head>

<title>Jadwal Piket</title>

<style>

body{
margin:0;
font-family:Arial;
background:#e6e6e6;
}

.container{
width:1000px;
margin:40px auto;
}

/* HEADER */

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
}

/* DATE PICKER */

.form-tanggal{
margin-top:20px;
}

input[type=date]{
padding:6px;
font-size:14px;
}

button{
padding:6px 12px;
background:#2f2f2f;
color:white;
border:none;
cursor:pointer;
}

/* TABLE */

table{
width:100%;
border-collapse:collapse;
margin-top:30px;
}

th{
background:#2f2f2f;
color:white;
padding:12px;
}

td{
border:1px solid #bfbfbf;
height:50px;
text-align:center;
}

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

<!-- PILIH TANGGAL -->

<div class="form-tanggal">

<form method="GET">

<label>Pilih Tanggal :</label>

<input type="date" name="tanggal" value="{{ $tanggal }}">

<button type="submit">Lihat</button>

</form>

</div>


<table>

<tr>
<th>NO</th>
<th>JAM</th>
<th>TUGAS</th>
<th>TEMPAT</th>
<th>
<span class="cross">✖</span>
<span class="check">✔</span>
</th>
</tr>

<tr>
<td>1</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td>2</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td>3</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td>4</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td>5</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

</table>

</div>

</body>
</html>