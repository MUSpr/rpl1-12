<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perceptron</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
	
  </head>
  <body>
    <div class="container">
      <h3>Aplikasi Perceptron</h3>
      <hr>
      <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="row">
          <div class="col-md-1">
              <p><b>Nilai P1</b></p>
              <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="0" name="p1[1]" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="0" name="p1[2]" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="1" name="p1[3]" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="1" name="p1[4]" required>
              </div>
              <b>Ŋ</b>
               <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="0.2" name="alfa" required>
              </div>
              <b>w<sub>1</sub></b>
               <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="0.3" name="w1" required>
              </div>
          </div>

          <div class="col-md-1">
              <p><b>Nilai P2</b></p>
              <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="0" name="p2[1]" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="1" name="p2[2]" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="0" name="p2[3]" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="1" name="p2[4]" required>
              </div>
              <b>b</b>
               <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="0.2" name="b" required>
              </div>
              <b>w<sub>2</sub></b>
               <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="0.1" name="w2" required>
              </div>
          </div>

          <div class="col-md-1">
              <p><b>Target</b></p>
              <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="0" name="t[1]" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="0" name="t[2]" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="0" name="t[3]" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" id="lbl_nama" value="1" name="t[4]" required>
              </div>
              <br><br><br><br><br>
              <button type="submit" class="btn btn-primary btn-md form-control tbl" name="hebb" value="Simulasi" /> Hitung!</button>       
          </div>

          <div class="col-md-9">
              <?php
                error_reporting(0);
                if ($_POST["hebb"]) {
                  $p1 = $_POST['p1'];
                  $p2 = $_POST['p2'];
                  $t = $_POST['t'];

                  //inisialisasi semua bobot dan bias
                  $w1[1] = $_POST['w1'];
                  $w2[1] = $_POST['w2'];
                  $b = $_POST['b'];
                  $alfa = $_POST['alfa'];

                  //fungsi f(n), dengan tambahan tipe, tipe = 1 (input biner output biner)
                  function fungsi($n) {
                    if ($n >= 0) {
                      return 1; 
                    } 
                    else {
                      return 0;
                    }
                  }
                  $beda = true;
                  //hitung n
                  while ($beda){
                    echo '
                      <table class="table">
                      <tr>
                        <th colspan="2" class="border">Masukan</th>
                        <th class="border">Target</th>
                        <th colspan="2" class="border">Output</th>
                        <th colspan="3" class="border">Perubahan Bobot</th>
                        <th colspan="3" class="border">Bobot Baru</th>
                      </tr>
                      <tr>
                        <th class="border">P<sub>1</sub></th>
                        <th class="border">P<sub>2</sub></th>
                        <th class="border">t</th>
                        <th class="border">n</th>
                        <th class="border">a</th>
                        <th class="border">DeltaW<sub>1</sub></th>
                        <th class="border">DeltaW<sub>2</sub></th>
                        <th class="border">b</th>
                        <th class="border">W<sub>1</sub></th>
                        <th class="border">W<sub>2</sub></th>
                        <th class="border">e</th>
                      </tr>';
                    
                    for($i=1;$i<=4;$i++) {
                      $n[$i] = $p1[$i] * $w1[$i] + $p2[$i] * $w2[$i] - $b;
                      $a[$i] = fungsi($n[$i]);

                      $e[$i] = $t[$i] - $a[$i];

                      //perbaiki bobot
                      $dw1[$i] = $alfa * $p1[$i] * $e[$i];
                      $w1[$i+1] = $w1[$i] + $dw1[$i];

                      $dw2[$i] = $alfa * $p2[$i] * $e[$i];
                      $w2[$i+1] = $w2[$i] + $dw2[$i];

                      echo "<tr>
                                  <td>{$p1[$i]}</td>
                                  <td>{$p2[$i]}</td>
                                  <td>{$t[$i]}</td>
                                  <td>{$n[$i]}</td>
                                  <td>{$a[$i]}</td>
                                  <td>{$dw1[$i]}</td>
                                  <td>{$dw2[$i]}</td>
                                  <td>{$b}</td>
                                  <td>{$w1[$i]}</td>
                                  <td>{$w2[$i]}</td>
                                  <td>{$e[$i]}</td>
                                </tr>";
                    }
                    echo "</table>";
                    if (($t[1] <> $a[1]) || ($t[2] <> $a[2]) || ($t[3] <> $a[3]) || ($t[4] <> $a[4])) {
                      $beda = true;
                      $w1[1] = $w1[5];
                      $w2[1] = $w2[5];
                    }
                    else {
                      $beda = false;
                    }

                    echo "<p style='float: right;'>W<sub>1</sub> = {$w1[5]}, W<sub>2</sub> = {$w2[5]}</p>";
                  }
                }
              ?>
          </div>

        </div>
      </form>

    </div>
  </body>
</html>