BASEDIR=`pwd`
PRJPATH="../../vendor_m2"

cd $BASEDIR/app/
mkdir -p code/Omnyfy
cd $BASEDIR/app/code/Omnyfy/
ln -s ../../../$PRJPATH/src Vendor

cd $BASEDIR
