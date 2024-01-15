<h3>
    <center>LAPORAN DATA PEMINJAMAN BUKU</center>
</h3> 
<br/>
<table border="1" width="100%">
    <tr>
        <th>No</th>
        <th>Nama Anggota</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Tanggal Pengembalian</th>
        <th>Total Denda</th>
        <th>Status</th>
    </tr>
    <?php
    $no = 1;
    foreach($laporan as $l){
    ?>
    <tr>
        <td scope="row"><?= $no++; ?></td> 
        <td><?= $l['nama']; ?></td>
        <td><?= $l['judul_buku']; ?></td>
        <td><?= $l['tgl_pinjam']; ?></td>
        <td><?= $l['tgl_kembali']; ?></td>
        <td><?= $l['tgl_pengembalian']; ?></td>
        <td><?= $l['total_denda']; ?></td> 
        <td><?= $l['status']; ?></td> 
    </tr>
    <?php
    }
    ?>
</table>