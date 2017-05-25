const ExtractTextPlugin = require("extract-text-webpack-plugin"),
    path = require('path'),
    webpack = require("webpack");

// config
let entry = require("./webpack_configs/js-css-loader.js"),
 isDebug = process.env.NODE_ENV !== "production";

// for module export use
const loaders = {
    css: {
        loader: 'css-loader'
    },
    style_loader: {
        loader: "style-loader"
    },
    sass: {
        loader: 'sass-loader',
        options: {
            indentedSyntax: true,
            includePaths: [path.resolve(__dirname, './application/src/css')]
        }
    },
    babel: {
        loader: 'babel-loader',
        options: {
            presets: ['es2015'],
            plugins: ['transform-runtime']
        }
    }
};

// plugins
const plugins = {
    extractSass: new ExtractTextPlugin({
        filename: "[name]",
        disable: !isDebug
    }),

    // compress js
    uglify: new webpack.optimize.UglifyJsPlugin({
        minimize: true,
        compress: true
    })
};


if(isDebug)
    delete(plugins["uglify"]);


module.exports = {
    entry: entry,

    output: {
        filename: '[name]',
        path: path.join(__dirname, './assets'),
        publicPath: './assets'
    },

    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: [loaders.babel]
            },
            {
                test: /\.(css|sass|scss)$/,
                use: plugins.extractSass.extract({
                    fallback: loaders.style_loader,
                    use: [loaders.css, loaders.sass]
                })
            }
        ]
    },

    plugins: Object.values(plugins),

    resolve: {
        extensions: ['.js', '.css', '.sass', '.scss'],
        modules: [path.join(__dirname, './application/src'), 'node_modules']
    },
    stats: {
        colors: true
    }
}