import wordpress from '@wordpress/eslint-plugin';

export default [
	...wordpress.configs.recommended,
	{
		rules: {
			semi: [ 'error', 'always' ],
			'no-console': 'off',
			'no-undef': 'off',
			'no-unused-vars': 'off',
			'no-alert': 'warn',
		},
	},
];
