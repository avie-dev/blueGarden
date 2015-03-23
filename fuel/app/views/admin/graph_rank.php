<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
	<?php $i = 10;?>
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['性別', 'Hours per Day'],
          ['男',     11],
          ['女',      <?php echo $i;?>],
                  ]);

        var options = {
          title: '性別の割合',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body><center>
    <div id="donutchart" style="width: 550px; height: 300px;"></div></center>

  </body>
</html>