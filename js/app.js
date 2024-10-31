/**
 * Add defaults in here
 */
jQuery(function() {
     var config = {
          enter:    'bottom',
          move:     '8px',
          over:     '0.6s',
          wait:     '0s',
          easing:   'ease',
          scale:    { direction: 'up', power: '5%' },
          opacity:  0,
          mobile:   false,
          reset:    false,
          viewport: window.document.documentElement,
          delay:    'once',
          vFactor:  0.60,
          complete: function( el ) {}
     }
     window.sr = new scrollReveal( config );
});