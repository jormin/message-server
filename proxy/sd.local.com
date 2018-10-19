server {
    listen 80;
    server_name sd.local.com;
    location / {
        add_header Access-Control-Allow-Origin *;
        add_header Access-Control-Allow-Headers "Admin-Token, User-Token, Token, Origin, X-Requested-With, Content-Type, Accept";
        add_header Access-Control-Allow-Methods "GET, POST, OPTIONS";
        proxy_pass  http://sd.local.com:8081;
    }
}
