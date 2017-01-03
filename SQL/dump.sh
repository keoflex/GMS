
usage="usage: $0 <env> ";
if [ $# -ne 1 ]; then
  echo "error - bad usage"
  echo $usage
  exit 2
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


# This will dump the SCHEMA only
#mysqldump -p${Password} -u $Username --add-drop-table --no_data $Database

# this will dump only the data.
mysqldump -p${Password} -u $Username --no-create-info $Database

# This will dump the SCHEMA and the data
#mysqldump -p${Password} -u $Username --add-drop-table --skip-extended-insert $Database 


