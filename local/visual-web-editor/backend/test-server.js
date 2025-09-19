// Simple test server
const express = require('express');
const app = express();
const PORT = 3001;

app.get('/api/health', (req, res) => {
  res.json({ 
    status: 'healthy', 
    message: 'Test server is running',
    timestamp: new Date().toISOString()
  });
});

app.listen(PORT, () => {
  console.log(`Test server running on http://localhost:${PORT}`);
});
