import React from 'react';
import ReactDOM from 'react-dom/client';
import GestionTickets from '../GestionTickets';
import '../index.css';

function GestionTicketsApp() {
  return (
    <div className="App">
      <GestionTickets />
    </div>
  );
}

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<GestionTicketsApp />);