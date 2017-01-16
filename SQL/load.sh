
usage="usage: $0 <env> <file>"
if [ $# -ne 2 ]; then
  echo "error - bad usage"
  echo $usage
  exit 1
fi

env=$1
file=$2

if [ ! -f $file ]; then
	echo "error - file not found"
	exit 2
fi

. $HOME/dbauth.sh


if [ $env == "local" ]; then
  Password='gms_dev!'
  Username='gms_dev'
  Server='localhost'
  Database="gms_dev";
elif [ $env == "prod" ]; then
  Database="sgm_prod";
elif [ $env == "dev" ]; then
  Password='44tel3bm12002'
  Username='keoflexn_super'
  Server='localhost'
  Database="keoflexn_GMT"
else
  echo "error - bad db:  $env"
  exit 3
fi


mysql -p$Password -u $Username -h $Server $Database < $file

