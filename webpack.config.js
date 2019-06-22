const path = require('path')
const webpack = require('webpack')
const Fiber = require('fibers')

const plugins = {
  progress: require('webpackbar'),
  clean: (() => {
    const { CleanWebpackPlugin } = require('clean-webpack-plugin')
    return CleanWebpackPlugin
  })(),
  extractCSS: require('mini-css-extract-plugin'),
  sync: require('browser-sync-webpack-plugin'),
  sri: require('webpack-subresource-integrity')
}

module.exports = (env = {}, argv) => {
  const isProduction = argv.mode === 'production'

  let config = {
    context: path.resolve(__dirname, 'front-end'),

    entry: {
      vendor: [
        './styles/vendor.scss',
        './scripts/vendor.js'
      ],
      app: [
        './styles/app.scss',
        './scripts/app.js'
      ],
      error:[
        './styles/error.scss'
      ]
    },

    output: {
      path: path.resolve(__dirname, 'webroot/asset'),
      publicPath: '',
      filename: 'js/[name].js',
      crossOriginLoading: 'anonymous'
    },

    module: {
      rules: [
        {
          test: /\.((s[ac]|c)ss)$/,
          use: [
            {
              loader: plugins.extractCSS.loader,
              options: {
                publicPath: '../' // use relative path for everything in CSS
              }
            },
            {
              loader: 'css-loader',
              options: {
                sourceMap: !isProduction
              }
            },
            {
              loader: 'postcss-loader',
              options: {
                ident: 'postcss',
                sourceMap: !isProduction,
                plugins: (() => [
                  require('autoprefixer')(),
                  ...isProduction ? [
                    require('cssnano')({
                      preset: ['default', {
                        minifySelectors: false
                      }]
                    })
                  ] : []
                ])
              }
            },
            {
              loader: 'sass-loader',
              options: {
                implementation: require('sass'),
                fiber: Fiber,
                outputStyle: 'expanded',
                sourceMap: !isProduction
              }
            }
          ]
        },
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: [
                '@babel/preset-env'
              ]
            }
          }
        },
        {
          test: /\.(gif|png|jpe?g|svg)$/i,
          exclude: /fonts/,
          use: [
            {
              loader: 'file-loader',
              options: {
                name: '[path][name].[ext]',
                // publicPath: '..' // use relative path
              }
            },
            {
              loader: 'image-webpack-loader',
              options: {
                bypassOnDebug: !isProduction,
                mozjpeg: {
                  progressive: true,
                  quality: 65
                },
                optipng: {
                  enabled: false
                },
                pngquant: {
                  quality: '65-90',
                  speed: 4
                },
                gifsicle: {
                  interlaced: false
                }
              }
            }
          ]
        },
        {
          test: /.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
          exclude: /img/,
          use: [{
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: 'fonts/',
              // publicPath: '../fonts/' // use relative path
            }
          }]
        }
      ]
    },

    devServer: {
      contentBase: path.join(__dirname, 'front-end'),
      port: 8080,
      overlay: {
        warnings: true,
        errors: true
      },
      quiet: true
    },

    plugins: (() => {
      let common = [
        new plugins.extractCSS({
          filename: 'css/[name].css'
        }),
        new plugins.progress({
          color: '#5C95EE'
        })
      ]

      const production = [
        new plugins.clean(),
        new plugins.sri({
          hashFuncNames: ['sha384'],
          enabled: true
        })
      ]

      const development = [
        new plugins.sync(
          {
            host: 'localhost',
            port: 9090,
            proxy: 'http://localhost:8080/'
          },
          {
            reload: false
          }
        )
      ]

      return isProduction
        ? common.concat(production)
        : common.concat(development)
    })(),

    devtool: (() => {
      return isProduction
        ? '' // 'hidden-source-map'
        : 'source-map'
    })(),

    resolve: {
      modules: [path.resolve(__dirname, 'front-end'), 'node_modules'],
      alias: {
        '~': path.resolve(__dirname, 'front-end/scripts/')
      }
    },

    stats: 'errors-only'
  }

  return config
}
