"use strict";

const path = require("path");

module.exports = {
    dev: {
        assetsSubDirectory: "static",
        assetsPublicPath: "/",
        proxyTable: {
            "/api": {
                target: "http://localhost:9500/api/",
                pathRewrite: {
                    "^/api": ""
                }
            }
        },
        host: "localhost",
        port: 8080,
        autoOpenBrowser: true,
        errorOverlay: true,
        notifyOnErrors: true,
        poll: false,
        useEslint: true,
        showEslintErrorsInOverlay: false,
        devtool: "eval-source-map",
        cacheBusting: true,
        cssSourceMap: false
    },

    build: {
        index: path.resolve(__dirname, "../dist/index.html"),
        assetsRoot: path.resolve(__dirname, "../dist"),
        assetsSubDirectory: "static",
        assetsPublicPath: "/",
        productionSourceMap: true,
        devtool: "#source-map",
        productionGzip: false,
        productionGzipExtensions: ["js", "css"],
        bundleAnalyzerReport: process.env.npm_config_report
    }
};
