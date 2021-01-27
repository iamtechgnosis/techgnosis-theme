const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const  webpack = require('webpack');

module.exports = {
	...defaultConfig,
	module: {
		...defaultConfig.module,
		rules: [
			...defaultConfig.module.rules
		],
	},
	plugins: [
		...defaultConfig.plugins,
		new webpack.ProvidePlugin({
			'window.jQuery': 'jquery'
		})
	]
};