module.exports = {
  apps: [{
    name: 'cross-api',
    script: 'server.js',
    instances: process.env.PM2_INSTANCES || 'max',
    exec_mode: 'cluster',
    watch: false,
    max_memory_restart: '1G',
    env: {
      NODE_ENV: 'development',
      PORT: 3000
    },
    env_production: {
      NODE_ENV: 'production',
      PORT: process.env.PORT || 3000
    },
    error_file: './storage/logs/pm2-error.log',
    out_file: './storage/logs/pm2-out.log',
    log_file: './storage/logs/pm2-combined.log',
    time: true,
    autorestart: true,
    max_restarts: 10,
    min_uptime: '10s',
    kill_timeout: 5000,
    wait_ready: true,
    listen_timeout: 10000
  }],

  deploy: {
    production: {
      user: 'deploy',
      host: ['your-server.com'],
      ref: 'origin/main',
      repo: 'git@github.com:your-repo/cross-nodejs.git',
      path: '/var/www/cross',
      'post-deploy': 'npm install && npm run migrate && pm2 reload ecosystem.config.js --env production',
      env: {
        NODE_ENV: 'production'
      }
    }
  }
};