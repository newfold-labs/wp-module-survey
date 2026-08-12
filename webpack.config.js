const path = require( 'path' );
const { merge } = require( 'webpack-merge' );
const wpScriptsConfig = require( '@wordpress/scripts/config/webpack.config' );
const version = require( './package.json' ).version; // never require full config!

const nfdSurveyWebpackConfig = {
	output: {
		path: path.resolve( process.cwd(), `build/${ version }` ),
		library: [ 'newfold', 'Survey', '[name]' ],
		libraryTarget: 'window',
	},
};

const config = merge( wpScriptsConfig, nfdSurveyWebpackConfig );

// @wordpress/scripts 26 emits devServer.proxy in the object form that
// webpack-dev-server 4 accepted; v5 requires an array and refuses to start
// otherwise ("options.proxy should be an array"). Reshape it so the dev
// server runs on the patched wds 5.x. The entry also has no target, which
// http-proxy-middleware needs, so point it at the dev server's own origin -
// that is the rewrite wp-scripts was expressing ( /build/x.js -> /x.js ).
if (
	config.devServer &&
	config.devServer.proxy &&
	! Array.isArray( config.devServer.proxy )
) {
	const { host = 'localhost', port = 8887 } = config.devServer;

	config.devServer = {
		...config.devServer,
		proxy: Object.entries( config.devServer.proxy ).map(
			( [ context, options ] ) => ( {
				context: [ context ],
				target: `http://${ host }:${ port }`,
				...options,
			} )
		),
	};
}

module.exports = config;
