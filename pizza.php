<?php
include 'include.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Gráficos Ricardo Milbrath</title>
</head>
<body>
<div class="content">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="../atividade-2/index.php">Percentual Populacional</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../atividade-2/index.php">Gráfico de colunas</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="../atividade-2/pizza.php">Gráfico pizza</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <div id="columnchart_values" style="width: 100%; height: 400px;"></div>
    </div>
    <div class="col-md-6">
      <h2 class="mb-4">Tabela de Percentual de População</h2>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Cidade</th>
            <th scope="col">População</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM dados ORDER BY populacao DESC"; // Modificado para ordenar pela população em ordem decrescente
          $busca = mysqli_query($conexao,$sql);

          while ($dados = mysqli_fetch_array($busca)) {
            $cidade = $dados['cidade'];
            $populacao = number_format($dados['populacao'], 0, '', '.'); // Formata o número com um ponto como divisor de milhares
          ?>
            <tr>
              <td><?php echo $cidade ?></td>
              <td><?php echo $populacao ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Google Charts JavaScript -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", { packages: ['corechart'] });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ["Cidade", "População"],
      <?php
      $sql = "SELECT * FROM dados";
      $busca = mysqli_query($conexao, $sql);

      while ($dados = mysqli_fetch_array($busca)) {
        $cidade = $dados['cidade'];
        $populacao = $dados['populacao'];
      ?>
        ["<?php echo $cidade ?>", <?php echo $populacao ?>],
      <?php } ?>
    ]);

    var options = {
      title: "Distribuição da População por Cidade",
      width: "100%",
      height: 400,
      legend: { position: "right" },
      pieSliceText: 'percentage', // Exibe a porcentagem em cada fatia
    };

    var chart = new google.visualization.PieChart(document.getElementById("columnchart_values"));
    chart.draw(data, options);
  }
</script>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
