<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Peserta Pelatihan BBLM</title>
      <meta name="description" content="Description of your site goes here">
      <meta name="keywords" content="keyword1, keyword2, keyword3">
      <link href="css/style.css" rel="stylesheet" type="text/css">
      <link href="css/table.css" rel="stylesheet" type="text/css">
      <link rel="SHORTCUT ICON" href="images/user.png" />
      <script type="text/javascript" src="js/jquery-1.2.3.min.js"></script>
      <script type="text/javascript">
      $(document).ready(function() {

        $().ajaxStart(function() {
          $('#loading').show();
          $('#result').hide();
        }).ajaxStop(function() {
          $('#loading').hide();
          $('#result').fadeIn('slow');
        });

        $('#formPeserta').submit(function() {
          $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
              $('#result').html(data);
            }
          })
          return false;
        });

      })
      function confirmDelete(delUrl) {
          if (confirm("Yakin mau di hapus ?")) {
            document.location = delUrl;
          }
        }
      </script>
</head>
<body>
  <div id="container">
    <div id="header"> 
      <img src="images/user.png" alt="" id="logo">
      <h1 id="logo-text">Pelatihan BBLM</h1>
    </div>
    <div id="nav">
      <ul>
        <li><a href="index.php">Data Peserta</a></li>
      </ul>
    </div>
    <div id="site-content">
      <div id="col-left">
                <!-- BATAS -->
                <form style="margin-left:75px;" name="cari" method="POST" action="?" class="form-horizontal">
                    <select name="pencariannya">
                        <option value="NIP">NIP</option>
                        <option value="Nama">Nama</option>
                    </select>
                    <input type="text" class="form-control" name="cari" placeholder="Cari...">
                    <input type="submit" class="form-control" value="Cari">
                </form>
                <br/>
                <?php
                if(isset($_POST["cari"])){
                ?>
                <table class="zebra" align="center" class="table table-striped">
                  <tr>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Umur</th>
                      <th>No Telepon</th>
                      <th>Aksi</th>
                  </tr>
                  <?php
                  $cari         = $_POST['cari'];
                  $pencariannya = $_POST['pencariannya'];
                  $data         = file('application/file.txt');
                  $data         = preg_grep('/'.$cari.'/', $data);
                  $ketemu       = false;
                  foreach($data as $datanya){
                  list($nip,$nama,$alamat,$umur,$no_telp) = explode("#", $datanya);
                        if(strpos($datanya, $cari) !== false){
                                if($cari==$nip && $pencariannya=="NIP"){
                                  $ketemu = true; ?>    
                                <tr>
                                    <td><?php echo $nip;?></td>
                                    <td><?php echo $nama;?></td>
                                    <td><?php echo $alamat;?></td>
                                    <td><?php echo $umur;?></td>
                                    <td><?php echo $no_telp;?></td>
                                    <td>
                                        <a href="index.php?aksi=edit&nip=<?php echo $nip;?>&nama=<?php echo $nama;?>&alamat=<?php echo $alamat; ?>&umur=<?php echo $umur; ?>&no_telp=<?php echo $no_telp; ?>" class="btn btn-warning" ><img src="images/edit.png" width="20px" /></a>
                                        <a href="javascript:confirmDelete('application/hapus.php?nip=<?php echo $nip; ?>')" class="btn btn-danger" ><img src="images/delete.png" width="20px" /></a>
                                    </td>
                                </tr>
                                <?php
                               }else if(preg_match('/'.$cari.'/', $nama) && $pencariannya=="Nama"){
                                  $ketemu = true; ?>    
                                <tr>
                                    <td><?php echo $nip;?></td>
                                    <td><?php echo $nama;?></td>
                                    <td><?php echo $alamat;?></td>
                                    <td><?php echo $umur;?></td>
                                    <td><?php echo $no_telp;?></td>
                                    <td>
                                        <a href="index.php?aksi=edit&nip=<?php echo $nip;?>&nama=<?php echo $nama;?>&alamat=<?php echo $alamat; ?>&umur=<?php echo $umur; ?>&no_telp=<?php echo $no_telp; ?>" class="btn btn-warning" ><img src="images/edit.png" width="20px" /></a>
                                        <a href="javascript:confirmDelete('application/hapus.php?nip=<?php echo $nip; ?>')" class="btn btn-danger" ><img src="images/delete.png" width="20px" /></a>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        }
                        ?>
                        </table>
                        <?php 
                        if(!$ketemu){
                          echo '<br/><center>Data tidak ditemukan.</center>';
                        }
                        ?>
                        <?php
                        }else{
                        ?>
                            <table class="zebra" align="center" class="table table-striped">
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Umur</th>
                                    <th>No Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php
                                $data = file("application/file.txt");
                                sort($data);
                                $banyak_baris = count($data);
                                $perpage = 5;
                                $p = isset($_GET['p']) ? $_GET['p'] : 1;
                                for ($i = (($p * $perpage) - $perpage); $i <= (($perpage * $p) - 1); $i++){
                                    if($i >= $banyak_baris){
                                        break;
                                    }else{
                                        if($data[$i] != ''){
                                          list($nip,$nama,$alamat,$umur,$no_telp) = explode("#", $data[$i]);
                                          ?>
                                          <tr>
                                            <td><?php echo $nip;?></td>
                                                    <td><?php echo $nama;?></td>
                                                    <td><?php echo $alamat;?></td>
                                                    <td><?php echo $umur;?></td>
                                                    <td><?php echo $no_telp;?></td>
                                                    <td>
                                                        <a href="index.php?aksi=edit&nip=<?php echo $nip;?>&nama=<?php echo $nama;?>&alamat=<?php echo $alamat; ?>&umur=<?php echo $umur; ?>&no_telp=<?php echo $no_telp; ?>" class="btn btn-warning" ><img src="images/edit.png" width="20px" /></a>
                                                        <a href="javascript:confirmDelete('application/hapus.php?nip=<?php echo $nip; ?>')" class="btn btn-danger" ><img src="images/delete.png" width="20px" /></a>
                                                    </td>
                                                </tr>
                                                <?php
                                        }
                                    }
                                }
                                ?>                                
                              </table>
                              <table cellpadding="10" cellspacing="0"  border="0" style="margin-left:75px;">
                                  <tr>
                                      <?php
                                      $total_halaman = $banyak_baris/$perpage;
                                      if($banyak_baris % $perpage != 0){
                                          $total_halaman = $total_halaman + 1;
                                      }
                                      if($p!=1){
                                        $halaman_kembali=$p-1;
                                          echo "<td><a href='?p=$halaman_kembali'><<</a></td>";
                                      }else{
                                          $halaman_kembali=$p-1;
                                          echo "<td><<</td>";
                                      }
                                      for($j=1;$j<=$total_halaman;$j++){            
                                          if($j==$p){        
                                              echo "<td>$p</td>";
                                          }else{
                                              echo "<td><a href='?p=$j'>$j</a></td>";    
                                          }
                                      }
                                      if($p <= $total_halaman - 1){
                                          $halaman_selanjutnya=$p+1;
                                          echo "<td><a href='?p=$halaman_selanjutnya'>>></a></td>";    
                                      }else{
                                          echo "<td>>></td>";
                                      }
                                      ?>
                                  </tr>
                              </table>                      
                              <?php
                              }
                              ?>
      </div>      
      <div id="col-right">
        <div style="padding: 30px 10px 10px;">
          <?php
          if(isset($_GET["aksi"])=="edit"){
            $nip      = $_GET['nip'];
            $nama     = $_GET['nama'];
            $alamat   = $_GET['alamat'];
            $umur     = $_GET['umur'];
            $no_telp  = $_GET['no_telp'];
          ?>
          <div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
          <div id="result" style="display:none;"></div>
          <h2 class="h-text-2">Form</h2>
          <form id="formPeserta" action="application/edit.php" method="POST" >
                        <table align="center">
                            <tr>
                                <div class="form-group">
                                    <td><label for="exampleInputName2">NIP </label></td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" id="exampleInputName1" name="nip" value="<?php echo $nip; ?>" readonly maxlength="4" /></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><label for="exampleInputName2">Nama </label></td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" id="exampleInputName1"  name="nama" value="<?php echo $nama; ?>" maxlength="25" /></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><label for="exampleInputName2">Alamat </label></td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" id="exampleInputName1" name="alamat" value="<?php echo $alamat; ?>" maxlength="30" /></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><label for="exampleInputName2">Umur </label></td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" id="exampleInputName1" name="umur" value="<?php echo $umur; ?>" maxlength="2" /></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><label for="exampleInputName2">No Telepon </label></td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" id="exampleInputName1" name="no_telp" value="<?php echo $no_telp; ?>" maxlength="12" /></td>
                                </div>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" name="tambah" class="btn btn-primary" value="Submit" /></td>
                            </tr>

                        </table>
                    </form>
          <?php 
          }else{
          ?>
          <div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
          <div id="result" style="display:none;"></div>
          <h2 class="h-text-2">Form</h2>
          <form id="formPeserta" action="application/tambah.php" method="POST">
                        <table align="center">
                            <tr>
                                <div class="form-group">
                                    <td><label for="exampleInputName2">NIP </label></td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" id="exampleInputName1" name="nip" maxlength="4" /></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><label for="exampleInputName2">Nama </label></td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" id="exampleInputName1"  name="nama" maxlength="25" /></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><label for="exampleInputName2">Alamat </label></td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" id="exampleInputName1" name="alamat" maxlength="30" /></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><label for="exampleInputName2">Umur </label></td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" id="exampleInputName1" name="umur" maxlength="2" /></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td><label for="exampleInputName2">No Telepon </label></td>
                                    <td>:</td>
                                    <td><input type="text" class="form-control" id="exampleInputName1" name="no_telp" maxlength="12" /></td>
                                </div>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" name="tambah" value="Submit" /></td>
                            </tr>

                        </table>
                    </form>
          <?php } ?>
        </div>
      </div>
      </div>
    <div id="footer">
      <p>&copy; Copyright 2016. Flat File System by Firdamdam Sasmita.
      </p>
    </div>
</div>
</body>
</html>
