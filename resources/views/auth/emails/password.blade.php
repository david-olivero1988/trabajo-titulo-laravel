
<!DOCTYPE html>
<html>
<head>


Estimado(a) usuario(a):
<br>
<br>
</head>
<body >
Para crear una nueva contraseña e ingresar al Sistema de <br> Administración de Notificaciones, pincha el siguiente link: <br>
<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
<br>
<br>
Cordialmente,<br>
Comisión Ingresa






