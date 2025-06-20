<?php

class Login extends Controller {

	public function index() {
		$this->view('login/index');
	}

	public function verify() {
		$username = trim($_POST['username'] ?? '');
		$password = trim($_POST['password'] ?? '');

		$userObj = $this->model('User');

		// Treat it as failed login attempt if either field is empty
		if ($userObj->notEmptyAccount($username, $password) == false) {
			if (isset($_SESSION['failedAttempts'])) {
				$_SESSION['failedAttempts']++;
			} else {
				$_SESSION['failedAttempts'] = 1;
			}
			header('Location: /login');
			exit;
		}

		// Verify username and password
		$user = $userObj->authenticate($username, $password);

		if ($user !== null) {
			// Login successful, perform the following steps:
			$_SESSION['auth'] = true;
			$_SESSION['username'] = $user['username'];

			if (isset($_SESSION['loginSuccess'])) {
				$_SESSION['loginSuccess']++;
			} else {
				$_SESSION['loginSuccess'] = 1;
			}
			header('Location: /home');
			exit;
		} else {
			// Login failed, track failed attempts
			if (isset($_SESSION['failedAttempts'])) {
				$_SESSION['failedAttempts']++;
			} else {
				$_SESSION['failedAttempts'] = 1;
			}
			header('Location: /login');
			exit;
		}
	}
}