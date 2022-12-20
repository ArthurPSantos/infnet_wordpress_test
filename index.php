<html>
    <body id='bod'>
        <div id='div'>
            <select id="partidos-dropdown" name="partidos">
            </select>
        </div>
        <button type="submit" onclick="javascript:pegar_parlamentares()">Pegar Parlamentares do Partido</button>
        <div id='div-table'>
            <table id="excelDataTable" border="1">
            </table>
        </div>
    </body>
</html>

<script type="text/javascript" language="javascript">

function pegar_partidos()
{
    let dropdown = document.getElementById('partidos-dropdown');
    dropdown.length = 0;
    
    let defaultOption = document.createElement('option');
    defaultOption.text = 'Escolha o partido';
    dropdown.add(defaultOption);
    dropdown.selectedIndex = 0;
    
    var url = 'https://dadosabertos.camara.leg.br/api/v2/partidos?ordem=ASC&ordenarPor=sigla';
    var request = new XMLHttpRequest();
    request.open('GET', url, false);
    
    request.onload = function() {
      if (request.status === 200) {
        var data = JSON.parse(request.responseText);
        let option;
        for (let i = 0; i < data.dados.length; i++) {
          option = document.createElement('option');
          option.text = data.dados[i].sigla;
          option.value = data.dados[i].uri;
          dropdown.add(option);
        }
       } else {
        console.error('Erro ao tentar resgatar os dados de ' + url);
      }   
    }
    
    request.onerror = function() {
      console.error('Erro ao tentar resgatar os dados de ' + url);
    };

    request.send();
}

function pegar_parlamentares()
{
    var e = document.getElementById("partidos-dropdown").value;
    var urlt = e + '/membros';
    var requestt = new XMLHttpRequest();
    requestt.open('GET', urlt, true);
    
    requestt.onload = function() {
        if (requestt.status === 200) {
            var datat = JSON.parse(requestt.responseText);
            var keys = [];

            document.write("<table border==\"1\"><tr>");
            for (key in datat.dados[0]) {
            	document.write('<td>' + key + '</td>');
            }
            document.write("</tr>");
            for (var i = 0; i < datat.dados.length; i++) {
            	document.write('<tr>');
            	for (key in datat.dados[i]) {
              	document.write('<td>' + datat.dados[i][key] + '</td>');
              }
            	document.write('</tr>');
            }
            document.write("</table>");

        }
        else {
            console.error(requestt.status);
        }
    }
    requestt.send();
}

function listener() {
  alert(this.responseText);
}

window.onload = pegar_partidos();

</script>
