<html>
    <body id='bod'>
        <div id='div'>
            <select id="partidos-dropdown" name="partidos">
            </select>
        </div>
        <button type="submit" onclick="javascript:enviar()">Pegar dados do Partido</button>
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
    
    const url = 'https://dadosabertos.camara.leg.br/api/v2/partidos?ordem=ASC&ordenarPor=sigla';
    
    const request = new XMLHttpRequest();
    request.open('GET', url, true);
    
    request.onload = function() {
      if (request.status === 200) {
        const data = JSON.parse(request.responseText);
        let option;
        for (let i = 0; i < data.dados.length; i++) {
          option = document.createElement('option');
          option.text = data.dados[i].sigla;
          option.value = data.dados[i].id;
          dropdown.add(option);
        }
        console.log(data)
       } else {
        console.error('Erro ao tentar resgatar os dados de ' + url);
      }   
    }
    
    request.onerror = function() {
      console.error('Erro ao tentar resgatar os dados de ' + url);
};

request.send();
}

function enviar()
{
    
}

function listener() {
  alert(this.responseText);
}

window.onload = pegar_partidos();

</script>
