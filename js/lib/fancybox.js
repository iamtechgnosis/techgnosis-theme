// Require jQuery (Fancybox dependency)
window.$ = window.jQuery = require('jquery');

// Fancybox
const fancybox = require('@fancyapps/fancybox');
// Fancybox Stylesheet
import '@fancyapps/fancybox/dist/jquery.fancybox.css';

$(function(){
    const images = '.fancbox, a[href*=".jpg"], a[href*=".png"], a[href*=".mov"]';
    
    if( $('.wp-block-gallery').length ) {
        $('.wp-block-gallery').find( images ).each(function(){
            $(this).attr('data-fancybox','gallery');
        });
    }else {
        $( images ).each(function(){
            $(this).attr('data-fancybox');
        });
    }

});