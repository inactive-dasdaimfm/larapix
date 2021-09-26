import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import './login.css';
import Button from '../Form/Button';
import Input from '../Form/Input/Index';

function Login() {

	const [email, setEmail] = useState('');
	const [password, setPassword] = useState('');

	const doLogin = async () => {
		var request = await fetch('/users');
	}

	return (
		<div className="container">
			<center>
				<div className="main">
					<h1>Login</h1>

					<Input 
						placeholder="Email"
						onChange={(e) => setEmail(e.target.value)}
					/>
						<br />
					<Input 
						placeholder="Password"
						onChange={(e) => setPassword(e.target.value)}
					/>	
						<br />
					<Button 
						text="Access" 
						onClick={doLogin}
					/>

				</div>
			</center>
		</div>
	);
}

export default Login;

if (document.getElementById('login')) {
    ReactDOM.render(<Login />, document.getElementById('login'));
}
