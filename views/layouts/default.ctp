<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>
		Osmosis 2: e-learning innovation - 
		<?php echo $title_for_layout;?>
	</title>
	<?php echo $html->charset(); ?>
	<?php echo $html->css('style'); ?>
	<?php echo $javascript->codeBlock('var webroot = "' . $this->webroot .'"'); ?>
	<?php echo $scripts_for_layout; ?>
</head>
<body>
	<div id="header">
		<a href="#" title="Osmosis2 - Inicio" id="home">Osmosis2</a>
		<ul>
			<li><a href="#">Ayuda</a></li>
			<li><a href="#">Buscar</a></li>
			<li class="exit">
				<?php echo $html->link(__('Salir', true), '/members/logout'); ?>
			</li>
		</ul>
	</div>
	<div id="main-content">
    	<div id="wrap">
            <div id="leftbar">
                <a href="#" id="dashboard" title="Ir al inicio">Inicio</a>
                <ul>
                    <li><a href="#">Cursos</a></li>
                    <li><a href="#">Casillero</a></li>
                    <li><a href="#">Mensajería</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Perfil</a></li>
                </ul>
            </div>
            <div id="main">
                <div id="bar3">De Prueba, Estudiantres</div>
                <div class="content">
                    	<?php
												if ($session->check('Message.flash')):
														$session->flash();
												endif;
											?>
											<?php echo $content_for_layout;?>
                    <div id="footer">
                        <div class="c">Fin</div>
                    </div>
                </div>
            </div>
            <div id="rightbar">
                <h5>Mientras no estabas</h5>
                <div class="content">
								Contenido
                </div>
            </div>
       </div>
       <br style="clear:both" />
    </div>
		<?php echo $cakeDebug?>
</body>
</html>
