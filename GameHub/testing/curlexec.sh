# Test website infastructure
curl http://localhost//index.php
echo ''

# Test page system
curl http://localhost/gamehub/feed.php
echo ''

# Test website authentication redirects
curl http://localhost/gamehub/profile.php
echo ''

# Test login system
curl --data "username=value1&password=value2" http://localhost/gamehub/login.php
echo ''
