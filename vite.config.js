
import { defineConfig } from 'vite';

export default defineConfig({
	base: '',
    root: 'Resources/Private/JavaScript',
	build: {
        cssCodeSplit: true,             // required for assetFileNames below
        cssMinify: false,	            // handled by TYPO3
        minify: false,		            // handled by TYPO3
        outDir: '../../Public/Dist',    // output directory is outside of root
        emptyOutDir: true,              // necessary for "external" output directories
        rolldownOptions: {
            input: 'Resources/Private/JavaScript/index.js',
            output: {
                assetFileNames: ({name}) => {
                    // We expect a CSS file as output and want to control its name.
                    if (name?.endsWith('.css')) {
                        return 'Css/[name][extname]';
                    }
                    /**
                     * Every other (unexpected) file should have a hash and
                     * never overwrite a versioned file.
                     */
                    return 'Assets/[name].[hash][extname]';
                },
                entryFileNames: 'JavaScript/[name].js', // same rule as above
                chunkFileNames: 'JavaScript/[name].[hash][extname]', // same rule as above
            }
        },
        target: 'esnext',
    },
	css: {
		preprocessorOptions: {
			scss: {
				// silence Bootstrap's outdated syntax
				silenceDeprecations: [
					'color-functions',
					'global-builtin',
					'if-function',
					'import',
				],
			},
		},
	}
});
