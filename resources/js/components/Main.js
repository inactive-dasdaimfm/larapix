import React, { useState } from 'react';
import ReactDOM from 'react-dom';

import './main.css';

function Main() {

	const [ammount, setAmmount] = useState(0);

	return (
		<div className="container">
			<center>
				<div className="form">
					<h1>Pix Deposit</h1>
						<br />
					<input 
						className="input" 
						placeholder="0,00"
						onChange={(e) => localStorage.setItem('ammount', e.target.value)}
					/>
						<br />
					<button 
						className="btn"
						onClick={() => window.location.href = 'order'}
					>
						Deposit now
					</button>
				</div>
			</center>
		</div>
	);
}

export default Main;

if (document.getElementById('main')) {
    ReactDOM.render(<Main />, document.getElementById('main'));
}
