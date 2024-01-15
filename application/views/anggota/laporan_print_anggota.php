<!DOCTYPE html> 
<html> 
<head> 
    <title></title>
    
    <style type="text/css">
        .table-data{
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td{
            border:1px solid black;
            font-size: 11pt;
            font-family:Verdana;
            padding: 10px 10px 10px 10px;
        }
        h3{
            font-family:Verdana;
        }
    </style> 

</head> 
<body> 
    <h3><center>Laporan Data Anggota Perputakaan Online</center></h3> <br/>
    <table class="table-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $no = 1;
        foreach($anggota as $a){ ?>
            <tr>
                <th scope="row"><?= $no++; ?></th> 
                <td><?= $a['nama']; ?></td>
                <td><?= $a['alamat']; ?></td>
                <td><?= $a['email']; ?></td>
                <td><?= ($a['is_active'] == 1) ? 'active' : 'nonaktif' ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table> 
    
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>