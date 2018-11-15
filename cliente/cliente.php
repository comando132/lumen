<html>
    <head>
        <title>Calculadora</title>
        <link rel='stylesheet' href='https://unpkg.com/spectre.css/dist/spectre.min.css'>
        <link rel='stylesheet' href='https://unpkg.com/spectre.css/dist/spectre-exp.min.css'>
        <link rel='stylesheet' href='https://unpkg.com/spectre.css/dist/spectre-icons.min.css'>
        <script src='https://code.jquery.com/jquery-3.3.1.min.js'
                integrity='sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=' crossorigin='anonymous'>
        </script>
    </head>
    <body>
        <script>
            function serializeObject(selector){
                var form = {};
                $(selector).find(':input[name]:enabled').each(function () {
                    var self = $(this);
                    var name = self.attr('name');
                    if (form[name]) {
                        form[name] = form[name] + ',' + self.val();
                    } else {
                        form[name] = self.val();
                    }
                });
                return form;
            }

            $(document).ready(function () {
                $('#operacion').submit(function (e) {
                    e.preventDefault();
                    data = $('#operacion').serialize();
                    $.ajax({
                        method: "POST",
                        url: 'http://132.248.63.20/sitio2/cliente/cliente_1.php',
                        data: data,
                        success: function(data) {
                            $('#resp').html(data);
                        }
                    });

                });
            });
        </script>
        <div class='container'>
            <div class='columns'>
                <div class='column col-6'>
                    <form id='operacion' method='post' action="cliente_1.php">
                        <div class='form-group'>
                            <label class='form-label' for='operacion'>Operaci&oacute;n: </label>
                            <select class='form-select' id='operacion' name='operacion'>
                                <option value='1'>Suma</option>
                                <option value='2'>Resta</option>
                                <option value='3'>Multiplicacion</option>
                                <option value='4'>Division</option>
                                <option value='5'>Raiz Cuadrada</option>
                                <option value='6'>Exponencial</option>
                            </select>
                        </div>
                        <div class='form-group'>
                            <label class='form-label' for='a'>N&uacute;mero A: </label>
                            <input type='text' class='form-input' id='a' name='a' size='5'/>
                        </div>
                        <div class='form-group'>
                            <label class='form-label' for='b'>N&uacute;mero B: </label>
                            <input type='text' class='form-input' id='b' name='b' size='5' />
                        </div>
                        <div class='input-group'>
                            <button class='btn btn-primary input-group-btn'>Enviar</button>
                        </div>
                    </form>
                </div>
                <div class='column col-6'>
                    <div id='resp'></div>
                </div>
            </div>
        </div>
    </body>
</html>

