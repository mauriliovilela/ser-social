<div id="deixar-recados">

    <script type="text/javascript">
        $(function(){
            $('#recadoinput').click(function(){
                $(this).fadeOut();
                $('#contentformrecado').fadeIn();
            });

            $('#cancelarformrecado').click(function(){
                $('#recadoinput').fadeIn();
                $('#contentformrecado').fadeOut();
            });
        });


    </script>

    <?php
    $txt_for_recado = ($idDaSessao <> $idExtrangeiro) ? 'Deixe um recado para ' . $user_fullname : 'Deixe um recado para seus amigos';

    if (isset($_POST['postarrecado'])) {
        include ('classes/Recados.class.php');
        $para = (!isset($_POST['recadopara'])) ? $idExtrangeiro : $_POST['recadopara'];
        Recados::setRecado($idDaSessao, $_POST['recadopara'], $_POST['txtrecado']);
    }
    ?>

    <div id="recadoinput"><?php echo $txt_for_recado; ?></div>

    <div id="contentformrecado">
        <form name="deixar-recado" action="" method="post" enctype="multipart/form-data">
            <?php if ($idDaSessao == $idExtrangeiro): ?>
                <select name="recadopara">
                    <option value="publico">Público</option>
                    <option value="amigos">Amigos</option>
                </select>
            <?php endif; ?>
            <textarea name="txtrecado" id="txtrecado"></textarea>
            <input type="submit" value="postar" id="postarrecado" name="postarrecado"> <a id="cancelarformrecado" href="javascript:void(0);">Cancelar</a>


        </form>
    </div>

</div><!--blocos-->