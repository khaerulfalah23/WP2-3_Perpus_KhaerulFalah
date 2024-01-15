<h3>
    <center>Laporan Data Perpustakaan Online</center>
</h3>
<br/>
<table border="1" width="100%">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Email</th>
        <th>Status</th>
    </tr> 
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
</table>