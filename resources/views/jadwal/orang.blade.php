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
font-size:42px;
font-weight:bold;
font-style:italic;
}

.title{
background:#2f2f2f;
color:white;
padding:18px 40px;
font-size:24px;
border-radius:12px;
box-shadow:0 6px 15px rgba(0,0,0,0.2);
}

.form-tanggal{
margin-top:20px;
margin-bottom:25px;
}

input[type=date]{
padding:8px;
border-radius:6px;
border:1px solid #ccc;
}

.schedule-box{
background:white;
padding:25px;
border-radius:16px;
box-shadow:0 10px 30px rgba(0,0,0,0.15);
}

table{
width:100%;
border-collapse:separate;
border-spacing:0 15px;
}

th{
background:#2f2f2f;
color:white;
padding:14px;
}

tr{
background:white;
box-shadow:0 4px 10px rgba(0,0,0,0.12);
}

td{
padding:12px;
text-align:center;
}

input[type=text]{
width:90%;
padding:8px;
border-radius:6px;
border:1px solid #ddd;
}

input[type=checkbox]{
width:18px;
height:18px;
}

.btn{
padding:10px 18px;
background:#2f2f2f;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
margin-top:10px;
}

.btn:hover{
background:#444;
}

.add-btn{
margin-bottom:15px;
}
.status-box{
display:flex;
justify-content:center;
align-items:center;
}

.checkmark{
width:22px;
height:22px;
border-radius:50%;
background:#ddd;
display:inline-block;
}

.status-box input{
display:none;
}

.status-box input:checked + .checkmark{
background:#2ecc71;
box-shadow:0 0 6px rgba(46,204,113,0.8);
}

.hapus-btn{
background:#ff4b4b;
border:none;
color:white;
padding:6px 12px;
border-radius:6px;
cursor:pointer;
}

.hapus-btn:hover{
background:#d93636;
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

<button class="btn" type="submit">Lihat</button>

</form>

</div>


<form method="POST" action="/simpan-jadwal">

@csrf

<input type="hidden" name="nama" value="{{ strtolower($nama) }}">
<input type="hidden" name="tanggal" value="{{ $tanggal }}">

<div class="schedule-box">

<button type="button" class="btn add-btn" onclick="tambahRow()">
+ Tambah Slot Jadwal
</button>

<table id="jadwalTable">

<tr>
<th>NO</th>
<th>JAM</th>
<th>TUGAS</th>
<th>TEMPAT</th>
<th>STATUS</th>
<th>AKSI</th>
</tr>

@foreach($jadwal as $i => $j)

<tr>

<form method="POST" action="/edit-jadwal/{{ $j->id }}">
@csrf

<td>{{ $i+1 }}</td>

<td>
<input type="text" name="jam" value="{{ $j->jam }}">
</td>

<td>
<input type="text" name="tugas" value="{{ $j->tugas }}">
</td>

<td>
<input type="text" name="tempat" value="{{ $j->tempat }}">
</td>

<td>
<label class="status-box">
<input type="checkbox" name="status" {{ $j->status ? 'checked' : '' }}>
<span class="checkmark"></span>
</label>
</td>

<td>

<button class="btn" type="submit">
Edit
</button>

</form>

<form method="POST" action="/hapus-jadwal/{{ $j->id }}" style="display:inline;">
@csrf
<button class="hapus-btn">
Hapus
</button>
</form>

</td>

</tr>

@endforeach

<tr>

<td class="no">+</td>

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
<label class="status-box">
<input type="checkbox" name="status[]">
<span class="checkmark"></span>
</label>
</td>

<td>
<button type="button" class="hapus-btn" onclick="hapusRow(this)">
Hapus
</button>
</td>

</tr>

</table>

</div>

<button class="btn" type="submit">
SIMPAN JADWAL
</button>

</form>

</div>

<script>

function tambahRow(){

var table=document.getElementById("jadwalTable");

var rowCount=table.rows.length;

var row=table.insertRow(rowCount);

row.innerHTML=`
<td class="no">${rowCount}</td>

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
<label class="status-box">
<input type="checkbox" name="status[]" onchange="toggleStatus(this)">
<span class="checkmark"></span>
</label>
</td>

<td>
<button type="button" class="hapus-btn" onclick="hapusRow(this)">
Hapus
</button>
</td>
`;

}

function hapusRow(btn){

var row=btn.parentNode.parentNode;

row.remove();

updateNomor();

}

function updateNomor(){

var table=document.getElementById("jadwalTable");

for(var i=1;i<table.rows.length;i++){

table.rows[i].cells[0].innerText=i;

}

}

function toggleStatus(cb){

if(cb.checked){

cb.parentElement.style.transform="scale(1.1)";

}else{

cb.parentElement.style.transform="scale(1)";

}

}

</script>
</body>
</html>