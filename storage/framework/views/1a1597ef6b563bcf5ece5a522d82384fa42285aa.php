
<!DOCTYPE html>
<html>
<head>
	

Estimado(a) usuario(a):
<br>
<br>
</head>
<body >
Para crear una nueva contraseña e ingresar al Sistema de <br> Administración de Notificaciones, pincha el siguiente link: <br>	
<a href="<?php echo e($link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset())); ?>"> <?php echo e($link); ?> </a>
<br>
<br>
Cordialmente,<br>
Comisión Ingresa
	

	



