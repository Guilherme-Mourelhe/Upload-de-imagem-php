<?php 

if(isset($_POST['enviar'])){

    //Array que armazena strings contendo quais formatos serão aceitos.
    $formatos_aceitos = ['png', 'jpeg', 'jpg', 'gif'];
    //var_dump($_FILES);
    $qtd_arquivos = count($_FILES['arquivo']['name']);

    for($contador = 0; $contador < $qtd_arquivos; $contador++){
    //Adquirindo formato do arquivo enviado
    $formato_arquivo = pathinfo($_FILES['arquivo']['name'][$contador],PATHINFO_EXTENSION);

    //Verificando se o formato é de imagem.
    if(in_array($formato_arquivo,$formatos_aceitos)){
        
        print("<br>");

        //Guardando local de salvamento em uma variável.
        $pasta = 'fotos_enviadas/';
        
        //Guardando local temporário do arquivo em uma variável (Antes de ser salva).
        $local_temp = $_FILES['arquivo']['tmp_name'][$contador];

        //Atribuindo novo nome único para o arquivo.
        $novo_nome = uniqid() .  ".$formato_arquivo";

        if(move_uploaded_file($local_temp, $pasta. $novo_nome)){

            print("<br> <li> Arquivo" . $_FILES['arquivo']['name'][$contador] . "<b> enviado </b>" . "</li> <br>");

        }else {

            print("Algo deu errado.");
        }
    }else{

        print("Formato" . $formato_arquivo . "inválido");
    }
}
}   



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "POST" enctype="multipart/form-data">
        Envie o arquivo:
        <input type = "file" name = "arquivo[]" multiple>
        <input type = "submit" name = "enviar">
    </form>
</body>
</html>