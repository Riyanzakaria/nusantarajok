export default [
    {
        files: ['resources/**/*.js'],
        languageOptions: {
            ecmaVersion: 'latest',
            sourceType: 'module',
        },
        rules: {
            'no-unused-vars': 'warn',
            'no-undef': 'error',
            'no-console': 'warn',
            'prefer-const': 'error',
            'no-var': 'error',
        },
    },
    {
        ignores: ['node_modules/**', 'public/**', 'vendor/**', 'storage/**'],
    },
];
