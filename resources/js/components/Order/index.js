import React from 'react';
import ReactDOM from 'react-dom';

function Order() {
	return (
		<div className="container">
			<center>
				<h1>Ammount: {localStorage.getItem('ammount')}</h1>
			</center>
		</div>
	);
}

export default Order;

if (document.getElementById('order')) {
    ReactDOM.render(<Order />, document.getElementById('order'));
}
