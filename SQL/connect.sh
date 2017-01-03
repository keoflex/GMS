usage="usage: $0 <env>"
if [ $# -ne 1 ]; then
  echo "error - bad usage"
  echo $usage
  exit 1
fi

env=$1


. $HOME/dbauth.sh





if [ $env == "local" ]; then
  Password='gms_dev!'
  Username='gms_dev'
  Server='localhost'
  Database="gms_dev";
elif [ $env == "prod" ]; then
  Database="cart_prod";
elif [ $env == "test" ]; then
  Database="cart_test";
elif [ $env == "dev" ]; then
  Database="cart_dev";
else
  echo "error - bad db:  $env"
  exit 3
fi

echo "mysql -p$Password -u $Username -h $Server $Database"

mysql -p$Password -u $Username -h $Server $Database
