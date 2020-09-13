<!doctype html>
<html>
<head>
<style>
body{background:#1F4D1D;
	color:#F7F7F7; padding: 1%;
}
</style>
<meta charset="utf-8">
<title>Mail From {{$name}} {{$email}}</title>
</head>

<body>
	<p>Mail From {{$name}} {{$email}}
	<h3>Message</h3>
    <p>{!!nl2br($content)!!}</p>
    <p><small>Send from Contact Page</small>

</body>
</html>