const path = require('path');

class Loader{
    constructor(){
        this.entry = {};
    }

    get getEntry(){
        return this.entry;
    }
    
    addEntry(to, file, type){
        this.entry[`${to}/${path.parse(file).name}.${type}`] = `${type}/${file}`;
    }

    load(fileToLoad, type){
        for(const [to, file] of Object.entries(require(fileToLoad))){
            if(!Array.isArray(file)) file = [file];
         
            for(const f of file)
                this.addEntry(to, f, type);
        }
    }

    loads(options){
        for(const [type, file] of Object.entries(options))
            this.load(file, type);
    }
}


(_ => {
    let loader = new Loader;
    loader.loads({
        js: './js-files.json',
        css: './css-files.json'
    })

    module.exports = loader.getEntry;
})();
