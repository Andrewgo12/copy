import React from 'react';
import ReactDOM from 'react-dom/client';
import MyTickets from '../MyTickets';
import '../index.css';

function MyTicketsApp() {
  return (
    <div className="App">
      <MyTickets />
    </div>
  );
}

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<MyTicketsApp />);