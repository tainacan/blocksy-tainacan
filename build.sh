echo "Compiling necessary stuff..."
cd ./blocksy-tainacan
npm install
npm run build
cd ../

if [ -z "$1" ]
then
    echo "Done!"
else
    echo "Done. Moving files to destination folder: $1"
    rm -rf $1/blocksy-tainacan
    cp -r ./blocksy-tainacan $1
    echo "Cleaning some files not necessary for the plugin to work..."
    rm -f $1/blocksy-tainacan/package.json
    rm -f $1/blocksy-tainacan/package-lock.json
    rm -rf $1/blocksy-tainacan/node_modules
    rm -rf $1/blocksy-tainacan/sass
    echo "Done!"
fi