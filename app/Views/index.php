<?php
    $session = session(); 
    $user = $session->user;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Welcome to CodeIgniter 4!</title>
		<meta name="description" content="The small framework with powerful features">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<style>
			::-webkit-scrollbar-thumb {
    			border-radius: 4px;
    			background: #0d8abc;
			}

			::-webkit-scrollbar {
    			width: 5px;
			}
		</style>
	</head>
	<body>
		<!-- SCRIPTS -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
		<script src="http://malsup.github.com/jquery.form.js"></script> 

		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="<?= base_url() ?>">SOCKET CI4</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<?= $user ? '<a class="nav-link" href="'.base_url('logout').'">Sair</a>' : ''; ?>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		
		<section class="container">
			<?= view('pages/'.$page); ?>
		</section>

		<script>
			// prepare the form when the DOM is ready 
			$(document).ready(function() { 
				var options = { 
					success:       showResponse
				}; 
		
				$('#<?= $page ?>').ajaxForm(options); 
			}); 
		
			// post-submit callback 
			function showResponse(response)  {
				$('#<?= $page ?>')[0].reset(); 
				if('<?= $page ?>' === 'register'){
					alert('login criado');
				}else if('<?= $page ?>' === 'login'){
					window.location.replace("<?= base_url('conversas') ?>");
				}
			}
		</script>
	</body>
</html>
