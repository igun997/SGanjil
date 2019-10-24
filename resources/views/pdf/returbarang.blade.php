<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Nlai Siswa</title>
    <style media="screen">
        body {
            font-family: "Open Sans", sans-serif;
            line-height: 1.25;
        }

        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                /*
  * aria-label has no advantage, it won't be read inside a table
  content: attr(aria-label);
  */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }
    </style>
</head>

<body>
  <h3 align="center">GARAGE KUSTOM</h3>
  <h3 align="center">LAPORAN RETUR BARANG</h3>
  <h4 align="center">Per {{date("d-m-Y",strtotime($mulai))}} - {{date("d-m-Y",strtotime($sampai))}}</h4>
    <table>
        <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Tanggal</th>
              <th scope="col">No Retur</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Warna</th>
              <th scope="col">Kategori</th>
              <th scope="col">Harga Satuan</th>
              <th scope="col">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $k => $v)
            <tr>
              <td>{{$k+1}}</td>
              <td>{{date("d-m-Y",strtotime($v->barang->tgl_buat))}}</td>
              <td>{{$v->no_retur}}</td>
              <td>{{$v->barang->nama_barang}}</td>
              <td>{{$v->barang->warna_content->warna}}</td>
              <td>{{$v->barang->kategori_content->kategori}}</td>
              <td>{{$v->barang->harga_satuan}}</td>
              <td>{{$v->barang->stok_awal}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <p>Bandung , {{date("d-m-Y")}}</p>
    <p>Kepala Gudang</p>
    <br>
    <br>
    <br>
    <p>Zaki Ramadhan</p>
</body>

</html>
