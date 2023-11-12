<?php
include '../atividade-2/includes/conexao.php'; // Inclui o arquivo de conexão ao banco de dados
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../atividade-2/css/style.css">
  <link rel="icon" href="../atividade-2/imagens/favicon.ico" type="image/x-icon">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Gráficos Ricardo Milbrath</title>
</head>
<body>
<div class="content">
    <!-- Barra de navegação aqui -->
<?php
include '../atividade-2/includes/nav.php'; // Inclui o arquivo de navegação
?>
  <div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <!-- Gráfico de pizza -->
      <div id="columnchart_values" style="width: 100%; height: 400px;"></div>
    </div>
    <div class="col-md-6">
    <h2 class="mb-4">Tabela de Percentual de População de Acordo com <a href="https://cidades.ibge.gov.br/" target="_blank">IBGE</a></h2>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Cidade</th>
            <th scope="col">População</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = 'SELECT * FROM dados ORDER BY populacao DESC'; // Modificado para ordenar pela população em ordem decrescente
$busca = mysqli_query($conexao, $sql);

while ($dados = mysqli_fetch_array($busca)) {
    $cidade = $dados['cidade'];
    $populacao = number_format($dados['populacao'], 0, '', '.'); // Formata o número com um ponto como divisor de milhares
    ?>
            <tr>
              <td><?php echo $cidade; ?></td>
              <td><?php echo $populacao; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Google Charts JavaScript -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", { packages: ['corechart'] });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    // Monta os dados do gráfico
    var data = google.visualization.arrayToDataTable([
      ["Cidade", "População"],
      <?php
      $sql = 'SELECT * FROM dados';
$busca = mysqli_query($conexao, $sql);

while ($dados = mysqli_fetch_array($busca)) {
    $cidade = $dados['cidade'];
    $populacao = $dados['populacao'];
    ?>
        ["<?php echo $cidade; ?>", <?php echo $populacao; ?>],
      <?php } ?>
    ]);

    // Configurações do gráfico de pizza
    var options = {
      title: "Distribuição da População por Cidade",
      width: "100%",
      height: 400,
      legend: { position: "right" },
      pieSliceText: 'percentage', // Exibe a porcentagem em cada fatia
    };

    // Cria o gráfico de pizza
    var chart = new google.visualization.PieChart(document.getElementById("columnchart_values"));
    chart.draw(data, options);
  }
</script>
</div>
<?php include '../atividade-2/includes/footer.php'; // Inclui o rodapé?>
</body>
</html>
