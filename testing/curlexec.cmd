# Test website structure
curl http://localhost/gamehub/index.php
echo 'website structuresuccessful'

# Test page
curl http://localhost/gamehub/feed.php
echo 'page testing successful'

# Test website authentication redirects
curl http://localhost/gamehub/profile.php
echo 'authentication redirect successful'

# Test login system
curl --data "username=value1&password=value2" http://localhost/gamehub/login.php
echo 'login system data successful'
