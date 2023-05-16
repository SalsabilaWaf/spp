<?php include 'koneksi.php';

if(isset($_POST['id_siswa'])) {
    $id_siswa = $_POST['id_siswa'];
    $query = "SELECT siswa.*, angkatan.*, jurusan.*, kelas.* FROM siswa,angkatan,jurusan,kelas WHERE siswa.
        id_angkatan = angkatan.id_angkatan AND siswa.id_jurusan = jurusan.id_jurusan AND siswa.id_kelas =
        kelas.id_kelas and siswa.id_siswa = $id_siswa";
    $exec = mysqli_query($conn,$query);
    $res = mysqli_fetch_assoc($exec);
    ?>

    <form action="editdatasiswa.php" method="POST">
        <input type="hidden" name="id_siswa" value="<?= $res['id_siswa'] ?>">
        <input type="hidden" name="nisn" disabled="" value="<?= $res['nisn'] ?>">
        <input type="text" class="form-control mb-2" name="" disabled="" value="<?= $res['nisn'] ?>">
        <input type="text" class="form-control mb-2" name="nama" disabled="" value="<?= $res['nama'] ?>">
        <select class="form-control mb-2" name="id_angkatan">
            <option selected="">-Pilih Angkatan-</option>
            <?php
            $selected="";
            $exec = mysqli_query($conn,"SELECT * FROM angkatan order by id_angkatan");
            while ($angkatan = mysqli_fetch_assoc($exec)) :
                if($res['id_angkatan'] == $angkatan['id_angkatan']) {
                    $selected = 'selected';
                }else {
                    $selected="";
                }
                echo "<option $selected value=".$angkatan['id_angkatan'].">".$angkatan['nama_angkatan
                ']."</option";
            endwhile;
            ?>
            </select>
            <select class="form-control mb-2" name="id_kelas">
                <option selected="">-Pilih Kelas-</option>
            <?php
                $exec = mysqli_query($conn,"SELECT *FROM kelas order by id_kelas");
                while ($angkatan = mysqli_fetch_assoc($exec)) :
                    if($res['id_kelas'] == $angkatan['id_kelas']) {
                        $selected = 'selected';
                    }else {
                        $selected="";
                    }
                    echo "<option $selected value=".$angkatan['id_kelas'].">".$angkatan['nama_kelas
                    ']."</option";
                    endwhile;
            ?>
                </select>
                <select class="from-control" name="id_jurusan">
                    <option selected="">-Pilih Jurusan-</option>
            <?php
                $exec = mysqli_query($conn,"SELECT *FROM jurusan order by id_jurusan");
                while ($angkatan = mysqli_fetch_assoc($exec)) :
                    if($res['id_jurusan'] == $angkatan['id_jurusan']) {
                        $selected = 'selected';
                    }else {
                        $selected="";
                    }
                    echo "<option $selected value=".$angkatan['id_jurusan'].">".$angkatan['nama_jurusan
                    ']."</option";
                    endwhile;
            ?>
                </select>
                <textarea class="from-control mt-2" name="alamat" placeholder="Alamat Siswa"><?= $res['
                alamat'] ?></textarea>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>
            </form>

        <?php
        if(isset($_POST['id_kelas'])) {
            $id_kelas = $_POST['id_kelas'];
            $exec = mysqli_query($conn,"SELECT * FROM kelas WHERE id_kelas= '$id_kelas'");
            $res =mysqli_fetch_assoc($exec);
            ?>
                <form action="editdatakelas.php" method="POST">
                <input type="hidden" name="id_kelas" value="<?= $res['id_kelas'] ?>">
                <input type="text" name="nama_kelas" class="form-control" value="<?= $res['$nama_kelas']?>">

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="Submit" name="edit" class="btn btn-primary">Simpan</button>
            </form>

        <?php }

        ?>

                <?php }?>
