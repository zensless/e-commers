<html>

<head>
    <title>DETAIL PRODUK</title>
    <style type="text/css">
        h1 {
            background-color: red;
            padding: 4px;
        }

        h2 {
            color: white;
            background-color: black;
            padding: 3px;
        }

        .menu {
            text-align: center;
            background-color: black;
            font-size: 18px;
            padding-top: 16pt;
        }

        .button {
            background-color: white;
            padding: 5px;
            border-color: black;
            text-decoration: none;
        }

        .button:hover {
            background-color: blue;
        }
    </style>
</head>

<body>
    @foreach ($produk as $pd)
    <h1 align="center">DAFTAR RIWAYAT HIDUP</h1>
    <table align="center" border="1">
        <tr>
            {{-- @empty($pd->foto)
                <td colspan="2" bgcolor="#fff000"><img src="{{ url('admin/img/no_photo.jpg') }}" width="325px" height="200px" border="2">
            @else
                <td colspan="2" bgcolor="#fff000"><img src="{{ url('admin/img/') }}/{{ $pd->foto }}" width="325px" height="200px" border="2">
            @endempty --}}
            </td>
        </tr>
        <tr align="center">
            <td> 085396717324 </td>
            <td> Lara4store@gmail.com </td>
        </tr>
    </table>
    <h2 id="1">PROFIL</h2>
    <table align="center">
        <tr>
            <td width="1%">Nama</td>
            <td width="10%">: Cristiano</td>
        </tr>
        <tr>
            <td width="1%">Tempat Lahir</td>
            <td width="10%">: Malaysia</td>
        </tr>
        <tr>
            <td width="1%">Umur</td>
            <td width="10%">: 23 Tahun</td>
        </tr>
        <tr>
            <td width="1%">Alamat</td>
            <td width="10%">: Luwu Utara</td>
        </tr>
    </table>
    <h2 id="2">PENDIDIKAN</h2>
    <table align="center">
        <tr>
            <td width="1%">Universitas</td>
            <td width="10%">: Anaktekno</td>
        </tr>
        <tr>
            <td width="1%">Jurusan</td>
            <td width="10%">: Teknik Informatika</td>
        </tr>
        <tr>
            <td width="1%">IPK</td>
            <td width="10%">: 2,75</td>
        </tr>
    </table>
    <h2 id="3">KEAHLIAN</h2>
    <table align="center">
        <tr>
            <td width="1%">Digital Marketing</td>
            <td width="10%">: SEO, SEO, Content Writer, Copywriting</td>
        </tr>
        <tr>
            <td width="1%">Web Development</td>
            <td width="10%">: HTML, CSS, JavaScript, Bootstrap, Codeigniter, Laravel, Etc.</td>
        </tr>
        <tr>
            <td width="1%">Others</td>
            <td width="10%">: C#, Java, .NET, Etc.</td>
        </tr>
    </table>
    <h2 id="4">PENGALAMAN</h2>
    <table align="center">
        <tr>
            <td width="1%">Content Writer</td>
            <td width="10%">: Anaktekno.com, Matatm.com, dll.</td>
        </tr>
    </table>
    <h2 id="5">KONTAK</h2>
    <table align="center">
        <tr>
            <td width="1%">Linkedin</td>
            <td width="10%">: Anaktekno.com</td>
        </tr>
        <tr>
            <td width="1%">Facebook</td>
            <td width="10%">: Anaktekno.com</td>
        </tr>
        <tr>
            <td width="1%">Github</td>
            <td width="10%">: Anaktekno.com</td>
        </tr>
    </table>
    <footer>
        <p align="center">
            <font align="center" font color="blue">
                <b>Copyright&copy; 2022</b> Created with HTML <a href="https://www.anaktekno.com">Anaktekno.com</a>
            </font>
    </footer>
    @endforeach
</body>

</html>
