
module.exports = {
  content: [
    './*.php',
    './**/*.php',
    './parts/**/*.{html,js}',
    './templates/**/*.{html,js}',
    '../../plugins/block-filter-test/src/**/*.{js,scss}',
    '../../plugins/block-filter-test/ssr/*.php',
  ],
  safelist: [
//    {
//      pattern: /.*/,
//      variants: ['sm', 'md', 'lg'],
//    },
    {
      pattern: /^(m|mx|my|mt|mr|mb|ml)-/,
      variants: ['sm', 'md', 'lg'],
    },
    {
      pattern: /^(-m|-mx|-my|-mt|-mr|-mb|-ml)-/,
      variants: ['sm', 'md', 'lg'],
    },
    {
      pattern: /^(p|px|py|pt|pr|pb|pl)-/,
      variants: ['sm', 'md', 'lg'],
    },
    {
      pattern: /^(top|right|bottom|left)-/,
      variants: ['sm', 'md', 'lg'],
    },
    {
      pattern: /^(-top|-right|-bottom|-left)-/,
      variants: ['sm', 'md', 'lg'],
    },
    {
      pattern: /^(w)-/,
      variants: ['sm', 'md', 'lg'],
    },
    {
      pattern: /^(h)-/,
      variants: ['sm', 'md', 'lg'],
    },
    {
//      pattern: /^(border)-(?!.*(spacing|black|white|slate|gray|zinc|neutral)).*$/,
      pattern: /^(border)-(x|y|t|r|b|l)-(0|2|4|8)$/,
    },
    {
      pattern: /^(border)-(0|2|4|8)$/,
    },
    {
      pattern: /^(rounded)-/,
    },
    {
      pattern: /^(shadow|shadow-sm|shadow-md|shadow-lg|shadow-xl|shadow-2xl|shadow-inner|shadow-none)$/,
      variants: ['hover'],
    },
    {
      pattern: /^(backdrop)-/,
      variants: ['hover'],
    },
    {
      pattern: /^(opacity)-/,
    },
    {
      pattern: /^(flex-col|flex-col-reverse|flex-row|flex-row-reverse|flex-1|flex-auto|flex-initial|flex-none)$/,
    },
    {
      pattern: /^(self-baseline)$/,
    },
    {
      pattern: /gap-/,
      variants: ['sm', 'md', 'lg'],
    },
    {
      pattern: /^(text-)/,
    },
    {
      pattern: /^(border-)/,
    },
  ],
  plugins: [],
  corePlugins: {
    preflight: false,    
    container: false
  }
}
