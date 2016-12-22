<!-- header-section-starts -->
	<div class="header">
		<div class="container">
			<div class="logo">
				<a href="<?php echo base_url(); ?>"><h1>Nexos Digital</h1></a>
			</div>
			<!-- <div class="pages">
				<ul>
					<li><a class="active" href="index.html">Articulos</a></li>
					<li><a href="3dprinting.html">Noticias</a></li>
					<li><a href="404.html">Clasificados</a></li>
				</ul>
			</div> -->
			<div class="navigation">
				<ul>
					<li><a href="nosotros">Nosotros</a></li>
					<li><a class="active" href="contacto">Contactanos</a></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="container">
		<div class="header-bottom">
            <div class="type">
				<h5>Categorías</h5>
			</div>
			<span class="menu"> </span>
			<div class="list-nav">
				<ul>   
					<?php
						$cats = '';
						if(!empty($categorias)){							
							foreach ($categorias as $key => $c) {
								$cats .= ' <li><a href="'.base_url().'/categoria/'.$c['id_categoria'].'">'.$c['nombre'].'</a></li> |';
							}						
						}	
						echo  trim($cats,'|');				
					?> 
					<!-- <li><a href="materials.html">Ciencia y tecnología</a></li>|
					<li><a href="printing.html">Deportes</a></li>|
					<li><a href="printing.html">Ecología</a></li>|
					<li><a href="filestoprint.html">Judicial</a></li>|
					<li><a href="404.html">Política</a></li>|
					<li><a href="404.html">Salud</a></li>|
					<li><a href="about.html">Sociedad</a></li> -->
				</ul>
			</div>
			<div class="clearfix"></div>
        </div>
	</div>