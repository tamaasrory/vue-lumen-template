**Binding a Node.js App to Port 80 with Apache**

```apacheconf
<VirtualHost *:80>
    ServerName your_host
    ProxyPreserveHost on
    ProxyPass / http://localhost:[YOUR PORT HERE]/
</VirtualHost>
```

**Binding a Node.js App to Port 80 with Nginx**

A more popular approach is to set up Nginx as a reverse proxy by having it bind to the desired port, forwarding all incoming traffic to your Node.js app.

Nginx is a high performance, open source web server (similar to Apache) that is widely-used as a reverse proxy for Node.js apps.

The main benefit of Nginx is the fact that it takes care of transport optimization. It sends cache headers for static resources and compresses them so that your Node.js app doesn't have to deal with that stuff. Focus on building your product, and let Nginx take care of optimizations.

Installing Nginx,
Easy as pie.

```shell
sudo apt install nginx
```

**Configuring Nginx**

Next, we'll need to configure Nginx so that it forwards traffic to our app. Let's start off by removing the default configuration file:

```shell
sudo rm /etc/nginx/sites-enabled/default
```

Next, create a new file in /etc/nginx/sites-available/ called node and open it with nano:

```shell
sudo nano /etc/nginx/sites-available/node
```

Paste the following code in the file and make sure to change example.com to your domain (or IP), and 1337 to your Node.js application port:
```apacheconf
server {
    listen 80;
    server_name example.com;
    location / {
        proxy_set_header   X-Forwarded-For $remote_addr;
        proxy_set_header   Host $http_host;
        proxy_pass         "http://127.0.0.1:[YOUR PORT HERE]";
    }
}
```

The proxy_pass declaration configures Nginx to act as a reverse proxy by forwarding all incoming requests on port 80 to your Node.js app on port 1337, on behalf of the client.

Next, we need to symlink our configuration to sites-enabled for it to be used by Nginx, since it's currently in sites-available:

```shell
sudo ln -s /etc/nginx/sites-available/node /etc/nginx/sites-enabled/node
```

**Applying the Configuration**

Let's restart Nginx so that it loads our configuration:

```shell
sudo service nginx restart
```

All set! Nginx will now forward all incoming requests to your app and even survive a server crash, since it automatically starts up with your machine.
