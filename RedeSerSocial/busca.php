<?php include('includes/header.php'); ?>        
        <div id="amarra-center-left">
        
            <div class="center">
               
            <?php
				if(''<>$_GET['s']){
					
					$explode = explode(' ',$_GET['s']);
					$numP = count($explode);
					
					for($i=0;$i<$numP;$i++){
						$busca .= " ( `nome` LIKE :busca$i OR `sobrenome` LIKE :busca$i ) ";
						if($i<>$numP-1){ $busca .= ' AND '; }
					}
														
					$buscar = DB::getConn()->prepare("SELECT * FROM `usuarios` WHERE $busca");
					
					for($i=0;$i<$numP;$i++){
						$buscar->bindValue(":busca$i",'%'.$explode[$i].'%',PDO::PARAM_STR);
					}
					
					$buscar->execute();
					
					if($buscar->rowCount()>0){
						echo '<ul style="text-decoration:none; ">';
						while($resbusca=$buscar->fetch(PDO::FETCH_ASSOC)){
							echo '<li style="text-decoration:none;  "><a style=" color:#FF0000; text-decoration:none; href="perfil.php?uid='.$resbusca['id'].'">'.$resbusca['nome'].' '.$resbusca['sobrenome'].'</a></li>';
						}
						echo '</ul>';
					}
					
				}
			?>
                
            </div><!--center-->
            
            <div class="right">
            
                <div class="blocos" id="publicidade">
                    <iframe width="300" height="250" src="http://youtu.be/UhFZiLKrKyQ?hd=1" frameborder="0" allowfullscreen></iframe>
                </div><!--blocos-->
                
     			<?php include('includes/amigos.php'); ?>
                                
            </div><!--right-->

                    
        </div><!--amarra-center-left-->
        
<?php include('includes/footer.php'); ?>