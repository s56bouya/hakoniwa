module.exports = {
    root: true,
    extends: [ 'plugin:@wordpress/eslint-plugin/recommended' ],
    rules: {
 //       "eqeqeq": "off",
 //       "curly": "warn",
 //       "quotes": ["error", "double"],
        "semi": ["error", "always"],
        'no-console': 'off',
        'no-undef': 'off',
        'no-unused-vars': 'off',
        'no-alert':'warn',
    }
}
