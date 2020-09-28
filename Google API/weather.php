<?php
		$weather = "";
		$error = "";

		if (array_key_exists('city', $_GET)) {
			$urlContents =
			file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=KEY");

			$weatherArray = json_decode($urlContents, true);
 
			if ($weatherArray['cod'] == 200) {
					$weather = "The weather in ".ucwords($_GET['city'])." is currently '".$weatherArray['weather'][0]['description']."'. ";

					$tempInCelsuis = round($weatherArray['main']['temp'] - 273.15);
					$weather .= " The temperature is ".$tempInCelsuis."&#8451 and the wind speed is ".$weatherArray['wind']['speed']." m/s.";
				} else {
					$error = "City you entered could not be found - please try again.";
				}
	  }

?>

<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<title>Weather</title>

		<style type="text/css">
			html {
				background: url(background.jpg) no-repeat center center fixed;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}
			body {
				background:none;
			}
			.container {
				text-align: center;
				margin-top: 200px;
				width: 450px;
			}
			input {
				margin: 20px 0;
			}
			#weather {
				margin-top: 20px;
			}
		</style>
	</head>
	<body>

		<div class="container">
		  <h1>What's the Weather?</h1>
			<form >
				<div class="form-group">
					<label for="city">Enter the name of a city.</label>
					<input type="text" class="form-control" id="city" name="city" placeholder="Eg. London, Tokyo" value="<?php
						if (array_key_exists('city', $_GET)) {
							echo $_GET['city'];
						}	 ?>" >
				</div>

				<button type="submit" id="submit" class="btn btn-primary">Submit</button>
			</form>

			<div id="weather"><?php
					if ($weather) {
						echo '<div class="alert alert-success" role="alert">
									'.$weather.'
								</div>';
					} else if ($error) {
						echo '<div class="alert alert-danger" role="alert">
									'.$error.'
								</div>';
								}
				?>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>
