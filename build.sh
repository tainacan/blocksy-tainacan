echo "Compiling necessary stuff..."
cd ./tainacan-blocksy
npm install
npm run build
cd ../

if [ -z "$1" ]
then
    echo "Done!"
else
    echo "Done. Moving files to destination folder: $1"
    rm -rf $1/tainacan-blocksy
    cp -r ./tainacan-blocksy $1
    echo "Cleaning some files not necessary for the plugin to work..."
    rm -f $1/tainacan-blocksy/package.json
    rm -f $1/tainacan-blocksy/package-lock.json
    rm -rf $1/tainacan-blocksy/node_modules
    rm -rf $1/tainacan-blocksy/sass
    echo "Done!"
fi