<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
 
<head>
 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title> Email Design </title>
</head>


<body style="margin: 0; padding: 0;">
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; font-family: 'Arial', sans-serif; border: 1px solid rgba(0,0,0,.4) ">

		<tr>
			<td align="center" bgcolor="#003352" style="padding: 20px 0 20px 0;">
				<a href="http://iuigv.com/tributary/" target="_blank" style="display:inline-block">
					<img src="http://iuigv.com/tributary/wp-content/themes/tributary/assets/images/logo.png" alt="Mail Template" width="186" height="118" style="display: block;" />
				</a> 
			</td>
		</tr>	

		<tr>
			<td bgcolor="#DBDBDD" style="padding: 40px 30px 40px 30px;"> 

				<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
					
					<tr>
						<td>
							<h2> Tributary Bussiness Peru </h2>
						</td>
					</tr>					
					<tr>
						<td style="padding: 20px 0 30px 0;">
							Ha recibido un nuevo mensaje de consulta y/o duda de:

							<div style="height:10px"></div>

							<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
								<tr>
									<td><strong> Nombre:</strong></td>
									<td> <?= $name; ?> </td>
								</tr>															
								<tr>
									<td><strong> Tel&eacute;fono :</strong></td>
									<td> <?= $phone; ?></td>
								</tr>								
								<tr>
									<td><strong> Email:</strong></td>
									<td> <?= $from; ?></td>
								</tr>								
								<tr>
									<td><strong> Mensaje:</strong></td>
								</tr>
								<tr>
									<td> <?= $message; ?> </td>
								</tr>
							</table>

						</td>
					</tr>					

				</table>
			</td>
		</tr>	

		<tr>
			<td bgcolor="#A70032" align="center" style="padding: 10px 0 10px 0;">
				<p style="color: white">
					Gracias Por Revisar Este Mensaje - Tributary <?= date("Y"); ?>
				</p>
			</td>
		</tr>		

		<tr>
			<td bgcolor="#0074BB" align="center">
				<p style="color: white; font-size: 12px;">
					Design by <a style="color: white;" target="_blank" href="http://www.ingenioart.com/"> Ingenioart </a>
				</p>
			</td>
		</tr>
	</table>
 
</body>
 
</html>


