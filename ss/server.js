const express = require('express');
const path = require('path');
const app = express();
const PORT = 3001;

// Servir archivos estáticos
app.use(express.static('.'));
app.use('/views', express.static('views'));

// Rutas para cada vista individual
app.get('/mytickets', (req, res) => {
  res.sendFile(path.join(__dirname, 'views', 'simple-standalone.html'));
});

app.get('/gestiontickets', (req, res) => {
  res.sendFile(path.join(__dirname, 'views', 'simple-standalone.html'));
});

app.get('/closedtickets', (req, res) => {
  res.sendFile(path.join(__dirname, 'views', 'simple-standalone.html'));
});

// Ruta principal (app completa)
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

app.listen(PORT, () => {
  console.log(`\n🚀 Servidor corriendo en http://localhost:${PORT}`);
  console.log(`\n📋 Vistas individuales:`);
  console.log(`   MyTickets: http://localhost:${PORT}/mytickets`);
  console.log(`   GestionTickets: http://localhost:${PORT}/gestiontickets`);
  console.log(`   ClosedTickets: http://localhost:${PORT}/closedtickets`);
  console.log(`\n🏠 App completa: http://localhost:${PORT}/`);
});