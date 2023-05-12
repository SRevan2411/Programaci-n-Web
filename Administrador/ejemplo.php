<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script>
        function ejecutaAjax(){
            var numero = $('#numero').val();
            if(numero){
                $.ajax({
                    url :'respuesta.php',
                    type: 'post',
                    dataType : 'text',
                    data : 'num='+numero,
                    success : function(res){
                        if (res == 1) {
                            alert('Funciona');
                        }else{
                            alert('no funciona');
                        }
                        setTimeout("$('#mensaje').html('');",8000);
                    },error: function(){
                        alert('Error archivo no encontrado...');
                    }
                });
            }else{
                $('#mensaje').html('Escribe un numero');
                setTimeout("$('#mensaje').html('');",5000);
            }
        }

        function dentroFoco(){
            $('#mensaje').html('Acabas de dar click DENTRO del campo');
            setTimeout("$('#mensaje').html('');",8000);
        }
        function fueraFoco(){
            $('#mensaje').html('Acabas de dar click FUERA del campo');
            setTimeout("$('#mensaje').html('');",8000);
        }

    </script>
</head>
<body>
    <input type="text" name="numero" onfocus="dentroFoco();" onblur="fueraFoco();" id="numero" placeholder="Escribe un numero"><br><br>
    <a href="javascript:void(0);" onclick="ejecutaAjax();">Click para ejecutar Ajax</a><br>
    <div id="mensaje"></div>
</body>
</html>