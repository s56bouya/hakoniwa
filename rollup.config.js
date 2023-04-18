import babel from '@rollup/plugin-babel';
import multi from '@rollup/plugin-multi-entry';
import eslint from '@rollup/plugin-eslint';
import commonjs from '@rollup/plugin-commonjs';
import { uglify } from "rollup-plugin-uglify";


export default [
  //color-picker.js
  {
    input: './src/js/back-end/color-picker.js',
    plugins: [
      eslint(),
      babel({
        'babelHelpers': 'bundled',
        'presets': [
          ['@babel/preset-env',{
            'useBuiltIns': 'usage',
            'corejs': 3,
          }]
        ]
      }),
      multi(),
    ],
    output: {
      file: './dist/assets/js/color-picker.js',
      format: 'iife'
    } 
  },
  //customizer-controls.js
  {
    input: './src/js/back-end/customize-controls.js',
    plugins: [
      eslint(),
      babel({
        'babelHelpers': 'bundled',
        'presets': [
          ['@babel/preset-env',{
            'useBuiltIns': 'usage',
            'corejs': 3,         
          }]
        ]
      }),
      multi(),
    ],
    output: {
      file: './dist/assets/js/customize-controls.js',
      format: 'iife'
    } 
  },
  //media-uploader.js
  {
    input: './src/js/back-end/media-uploader.js',
    plugins: [
      eslint(),
      babel({
        'babelHelpers': 'bundled',
        'presets': [
          ['@babel/preset-env',{
            'useBuiltIns': 'usage',       
            'corejs': 3,     
          }]
        ]
      }),
      multi(),
    ],
    output: {
      file: './dist/assets/js/media-uploader.js',
      format: 'iife'
    } 
  },
  // front-end.js
  {
    input: './src/js/front-end/index.js',
    plugins: [
      eslint(),
      babel({
        'babelHelpers': 'bundled',
        'presets': [
          ['@babel/preset-env',{
            'useBuiltIns': 'usage',            
            'corejs': 3,
          }]
        ]
      }),
      multi(),
    ],
    output: {
      file: './dist/assets/js/front-end.js',
      format: 'iife'
    }
  },
  // front-end.min.js
  {
	input: './src/js/front-end/index.js',
    plugins: [
      eslint(),
      babel({
        'babelHelpers': 'bundled',
        'presets': [
          ['@babel/preset-env',{
            'useBuiltIns': 'usage',            
            'corejs': 3,
          }]
        ]
      }),
      multi(),
      uglify(),
    ],
    output: {
      file: './dist/assets/js/front-end.min.js',
      format: 'iife'
    }
  },
]

