<!-- header-section-starts -->
	<div class="header" style="    padding: 1.2em 0;">
		<div class="container">
			<div class="logo">
				<a href="<?php echo base_url(); ?>"><h1 style="padding: 10px 0px;">Nexos Digital</h1></a>
			</div>
			<div class="pages">
				<!-- www.TuTiempo.net - Ancho:272px - Alto:50px -->
				
			</div> 
			<div class="navigation" style="margin-top: 0px">
				<ul>
					<li>
						<div id="TT_tWtxbBrxL8z98asUXAxE1k1E19nUTzc1keqWaipHcnV">Pronóstico de Tutiempo.net</div>
						<script type="text/javascript" src="http://www.tutiempo.net/widget/eltiempo_tWtxbBrxL8z98asUXAxE1k1E19nUTzc1keqWaipHcnV"></script>						
					</li>
					<li>
						
						<div class="row" style="text-align: center">
							<div class="col-sm-12" style="padding:0px;color: #FFF;font-family: 'Antonio-Regular'; text-transform: uppercase; font-size: 1.2em;"><?php echo app::dateFormat(date('Y-m-d'),6) ?></div>
							<div class="col-sm-6" style="padding:0px;"><a href="nosotros">Nosotros</a></div>
							<div class="col-sm-6" style="padding:0px;"><a class="active" href="contacto">Contactanos</a></div>
						</div>
					</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="container">
		<div class="header-bottom">          
			<span class="menu"> </span>
			<div class="list-nav">
				<ul>   
					<?php
						$cats = '';
						if(!empty($categorias)){							
							foreach ($categorias as $key => $c) {
								$cats .= ' <li><a href="'.base_url().'categoria/'.$c['id_categoria'].'">'.$c['nombre'].'</a></li> |';
							}						
						}	
						echo  trim($cats,'|');				
					?> 
				</ul>
			</div>
			<div class="clearfix"></div>
        </div>
	</div>