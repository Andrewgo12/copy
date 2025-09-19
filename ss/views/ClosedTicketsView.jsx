import React from 'react';
import ReactDOM from 'react-dom/client';
import ClosedTickets from '../ClosedTickets';
import '../index.css';

function ClosedTicketsApp() {
  return (
    <div className="App">
      <ClosedTickets />
    </div>
  );
}

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<ClosedTicketsApp />);