<!--	Escrito por Arunakemi Colin Varela        1CV2	-->
<!DOCTYPE html>
<html>
	<head>
		<title>Procesamiento de Imagenes!</title>
		<link rel="stylesheet" type="text/css" href="Colin_Varela.css">
	</head>
	<body>
		<h1 class="nombre">Escrito por: Arunakemi Colin Varela Grupo: 1CV2</h1>
		<h1></h1>
		<h1>Generador de terrenos</h1>
		<div class="sp">
			<h1>Opciones</h1>
			<form method="post" action="Colin_Varela.php">
				<br>
				<center><fieldset class="cool">
					<!-- Escrito por Arunakemi Colin Varela      1CV2 -->
					<!-- Funcion reset -->
					<script type="text/javascript">
						function reset2()
						{
							//Resetea cada valor a default :)
							var inp;
							inp = document.getElementById("1");
							inp.value = 15;
							inp = document.getElementById("2");
							inp.value = 9777;
							inp = document.getElementById("3");
							inp.value = 9700;
							inp = document.getElementById("4");
							inp.value = 9700;
							inp = document.getElementById("5");
							inp.value = 100;
							inp = document.getElementById("6");
							inp.value = 100;
							inp = document.getElementById("7");
							inp.value = 0;
							inp = document.getElementById("8");
							inp.value = 0;
						}

					</script>
					<!-- Menu -->
					<p>Tipo de terreno
					<select name="Tipo">
						<option value="tropical">Tropical</option>
						<option value="tundra"<?php $x=$_POST['Tipo'];if($x=="tundra"){echo ' selected';}?>>Artico</option>
					</select></p><br>
					<p>Tamaño del terreno / Area de trabajo</p>
					<p>Largo<input id="7" type="text" name="largo" value="<?php echo $_POST['largo']?>">tiles / px</p>
					<p>Ancho<input id="8" type="text" name="ancho" value="<?php echo $_POST['ancho']?>">tiles / px</p><br>
					<p>Tamaño total Isla<br>Chica<input id="1" type="range" name="val1" min=0 max=30 value="<?php echo $_POST['val1']?>">Grande</p><br>
					<p>Uniformidad<br>Poca<input id="2" type="range" name="val2" min=9555 max=9999 value="<?php echo $_POST['val2']?>">Mucha</p><br>
					<p>Tamaño Pasto<br>Chico<input id="5" type="range" name="val5" min=1 max=200 value="<?php echo $_POST['val5']?>">Grande</p><br>
					<p>Distribucion Pasto<br>Poco<input id="3" type="range" name="val3" min=9400 max=9999 value="<?php echo $_POST['val3']?>">Mucho</p><br>
					<p>Tamaño de la costa<br>Chica<input id="6" type="range" name="val6" min=1 max=200 value="<?php echo $_POST['val6']?>">Grande</p><br>
					<p>Distribucion costa<br>Poca<input id="4" type="range" name="val4" min=9400 max=9999 value="<?php echo $_POST['val4']?>">Mucha</p><br>
					<p>Generar Imagen Jpg<input type="checkbox" name="jpg_mode" <?php if($_POST['jpg_mode']=="on")echo "checked";?> ></p><br>
					<button type="button" onclick="reset2();">Resetear</button><button type="submit" name="button">Generar</button>
				</fieldset></center>
			</form>
			<br><h1>-	</h1>
		</div><div class="sp2">
			<h1>Mapa del terreno</h1>
			<br><fieldset<?php $x=$_POST['Tipo']; if($x=="tundra"){echo ' style="background-color: rgb(0,100,255);"';}?> class="ter">
			<?php
				//Escrito por Arunakemi Colin Varela      1CV2
				//*
				$tmpini = microtime(true);
				require('.\lib\random.php');
				$val1= $_POST['val1']; //Distribucion Isla
				$val2= $_POST['val2']; //Cantidad de islas
				$val3= $_POST['val3']; //Distribucion pasto
				$val4= $_POST['val4']; //Distribucion costa
				$val5= $_POST['val5']; //Tamaño Pasto
				$val6= $_POST['val6']; //Tamaño costa
				//Invertimos valores min - max
				$val1 = (30-$val1);
				$val2 = (10000-$val2)+9000;
				$val3 = (10000-$val3)+9555;
				$val4 = (10000-$val4)+9400;
				//$val5 = no se modifica pues su min max estan en orden!
				//$val6 = no se modifica pues su min max estan en orden!
				//Recibimos largo y ancho
				$ancho = $_POST['ancho'];
				$largo = $_POST['largo'];
				//jpgmode?
				$jpg_mode = $_POST['jpg_mode'];
				if($jpg_mode=="on") //Si esta el modo jpg, crea terreno
				{
					//Imagen del terreno
					$im = imagecreatetruecolor( $ancho , $largo );
					//Colores para el terreno
					$val=$_POST['Tipo'];
					if($val=="tropical")
					{
						$A = imagecolorallocate($im, 0, 0, 255); //Agua
						$T = imagecolorallocate($im, 136, 136, 10); //Tierra/Arena
						$P = imagecolorallocate($im, 15, 220, 15); //Pasto
					}
					else if($val=="tundra")
					{
						$A = imagecolorallocate($im, 0, 100, 255); //Agua
					    $T = imagecolorallocate($im, 180, 210, 255); //Tierra/Arena
						$P = imagecolorallocate($im, 180, 230, 255); //Pasto
					}
					imagefill($im, 0, 0, $A); //Rellenamos de azul la imagen del terreno
				}
				//Arreglo para manejar tipo de terreno
				$map = array_fill(0, $largo, array_fill(0, $ancho, 1));
				//*/
				//Tiempo limite para realizar todo
				set_time_limit(1200);
				//Ponemos puntos base para islas
				$val1 = ($val1 * $largo) / 100;
				$largo = $_POST['largo'];
				for ($i=$val1; $i < ($largo-$val1); $i++) 
				{ 
					for ($i2=$val1; $i2 < ($ancho-$val1); $i2++) 
					{ 	
						$rand = random_int(0, 10000);
						$rand = ($rand * $i2 * $i) % 10000;
						if($rand > $val2)
						{
							$map[$i][$i2]=3;
						}
					}
				}
				//Expandimos el pasto...
				for ($i=0; $i < $val5; $i++) { 
					for ($y=0; $y < $largo; $y++) 
					{ 
						for ($x=0; $x < $ancho; $x++) 
						{ 
							if(isset($map[$y][$x])&&$map[$y][$x]==3)
							{
								$rand = random_int(0,10000);
								if($rand>$val3)
								{
									$map[$y-1][$x]=3;
									$map[$y+1][$x]=3;
									$map[$y][$x+1]=3;
									$map[$y][$x-1]=3;
								}
							}
						}
					}
				}
				//Agregamos tierra/arena en la costa
				for ($y=0; $y < $largo; $y++) 
				{ 
					for ($x=0; $x < $ancho; $x++) 
					{ 
						if($map[$y][$x]==3)
						{
							if(isset($map[$y-1][$x])&&$map[$y-1][$x]!=3)
							{
								$map[$y-1][$x]=2;
							}
							if(isset($map[$y+1][$x])&&$map[$y+1][$x]!=3)
							{
								$map[$y+1][$x]=2;
							}
							if(isset($map[$y][$x+1])&&$map[$y][$x+1]!=3)
							{
								$map[$y][$x+1]=2;
							}
							if(isset($map[$y][$x-1])&&$map[$y][$x-1]!=3)
							{
								$map[$y][$x-1]=2;
							}
						}
					}
				}
				//Expandimos la tierra/arena costa
				for ($i=0; $i < $val6; $i++) 
				{ 
					for ($y=0; $y < $largo; $y++) 
					{ 
						for ($x=0; $x < $ancho; $x++) 
						{ 
							if($map[$y][$x]==2)
							{
								$rand = random_int(0,10000);
								if($rand > $val4)
								{
									if(isset($map[$y-1][$x])&&$map[$y-1][$x]!=3)
										$map[$y-1][$x]=2;
									if(isset($map[$y+1][$x])&&$map[$y+1][$x]!=3)
										$map[$y+1][$x]=2;
									if(isset($map[$y][$x+1])&&$map[$y][$x+1]!=3)
										$map[$y][$x+1]=2;
									if(isset($map[$y][$x-1])&&$map[$y][$x-1]!=3)
										$map[$y][$x-1]=2;
								}
							}
						}
					}
				}
				//Coloreamos/Imprimimos de acuerdo al arreglo...
				$val=$_POST['Tipo'];
				if($jpg_mode!="on")//Si no va a crear imagen jpg entonces se imprimira por pixeles 
				{
					echo '<br><div class="pix2" ';
					if($val=="tundra"){
						echo ' style="background-color: rgb(0,100,255);"'; //Si activa el modo tundra, se colorea el fondo diferente
					}
					echo '>';
				}
				for ($y=0; $y < $largo; $y++) 
				{ 
					if($jpg_mode!="on")
					{
						echo '<p class="pix2" ';
						if($val=="tundra"){
							echo ' style="background-color: rgb(0,100,255);"';
						}
						echo '>';
					}
					for ($x=0; $x < $ancho; $x++) 
					{ 
						if(isset($map[$y][$x])&&$map[$y][$x]==1)
						{
							if($jpg_mode!="on")
							{
								echo '<img src=".\Terrenos(tile)\Agua';
								if($val=="tundra")
								{
									echo '2';
								}
								echo '.jpg">';
								echo '<img src=".\Terrenos(tile)\Agua';
								if($val=="tundra")
								{
									echo '2';
								}
								echo '.jpg">';
							}
							
						}
						if(isset($map[$y][$x])&&$map[$y][$x]==2)
						{
							//Imprime imagen si no se creara un jpg
							if($jpg_mode!="on")
							{
								echo '<img src=".\Terrenos(tile)\Tierra';
								if($val=="tundra")
								{
									echo '2';
								}
								echo '.jpg">';
								echo '<img src=".\Terrenos(tile)\Tierra';
								if($val=="tundra")
								{
									echo '2';
								}
								echo '.jpg">';
							}
							else
							{
								//Si se crea jpg , modifica el pixel
								imagesetpixel($im, $x, $y, $T);
							}
						}
						else if(isset($map[$y][$x])&&$map[$y][$x]==3)
						{
							if($jpg_mode!="on")
							{
								echo '<img src=".\Terrenos(tile)\Pasto';
								if($val=="tundra")
								{
									echo '2';
								}
								echo '.jpg">';
								echo '<img src=".\Terrenos(tile)\Pasto';
								if($val=="tundra")
								{
									echo '2';
								}
								echo '.jpg">';
							}
							else
							{
								imagesetpixel($im, $x, $y, $P);
							}
						}
					}
					if($jpg_mode!="on")
					echo "</p>";
				}
				if($jpg_mode!="on")
				echo "</div>";
				//Creamos imagen e imprimimos en pantalla ( si no esta activado el modo pix)
				if($jpg_mode=="on")
				{
					date_default_timezone_set('UTC'); //Le ponemos hora a la imagen para no confundirla
					$date = date("h-i-sa");
					imagejpeg($im,".\Terrenos-Creados\prueba".$date.".jpg",100);
					echo '<br><img style="width: '.($ancho * 3).'px; height: '.($largo * 3).'px;" src=".\Terrenos-Creados\prueba'.$date.'.jpg">';	
					imagedestroy($im);
				}
				echo "<br><br></fieldset>";
				$tmpfin = microtime(true);
				$tmptot = $tmpfin - $tmpini;
				echo "<p>Generado en: ".number_format($tmptot,2,'.','')." seg</p>";
				//*/
			?>
		</div>
	</body>
</html>