Installing Stratum Mining Proxy
opkg install python-dev python-distutils
cd /usr/lib/python2.7/
wget http://hg.python.org/cpython/raw-file/4ebe1ede981e/Lib/py_compile.py
cd ~
git clone git://github.com/slush0/stratum-mining-proxy.git
cd stratum-mining-proxy/
python distribute_setup.py
python setup.py develop
./mining_proxy.py  SUCESS!
