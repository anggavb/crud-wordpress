<?php
/**
* Template Name: Login Vendor Form
*/
?>

<?php
global $user_ID;
global $wpdb;

if (!$user_ID) {

	if ( $_POST ) {

		$username = $wpdb->escape($_POST['username']);
		$password = $wpdb->escape($_POST['password']);

		$login = array(
			'user_login' => $username,
			'user_password' => $password
		);

		$verify = wp_signon($login, true);

		$curl = curl_init();
		curl_setopt_array($curl,[
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL =>'https://www.google.com/recaptcha/api/siteverify',
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => [
				'secret' => '6LffvY8UAAAAAAkROcThU0V-6uMGKfTLuVzbxV86',
				'response' => $_POST['g-recaptcha-response'],
			],
		]);

		$response = json_decode(curl_exec($curl));
		// var_dump($response);
		// die();

			if($response->success){

				if ( $verify ) {
					echo "<script>window.location = '".site_url()."'</script>";
				} else {
					echo "<script>alert('Username atau Password Salah');</script>";
				}

			} else {
				echo "<script>alert('reCAPTCHA harus diisi');</script>";
			}

		} else { ?>

			<?php get_header(); ?>

			<form class="" action="" method="post">
				<label for="username">Username
					<input id="username" type="text" name="username" placeholder="Masukkan Username" value="">
				</label>
				<label for="password">Password
					<input id="password" type="text" name="password" placeholder="Masukkan Password" value="">
				</label>

				<div class="g-recaptcha" data-sitekey="6LffvY8UAAAAAFEHw4rUnSuL9tS99Ar6Zf6OUT8U"></div>

				<input type="submit" name="submit" value="login">
			</form>

			<script src="https://www.google.com/recaptcha/api.js"></script>

			<?php get_footer();

		}

	} else {
		echo "<script>window.location = '".site_url()."/vendor'</script>";
	}
	?>
