var config = {
//    map: {
//        '*': {
//            'owlcarousel': 'Magento_Theme/js/owl.carousel.min'
//
//        }
//    },
    paths: {
        'owlcarousel': 'js/owl.carousel.min',
        'easyticker': 'js/jquery.easy-ticker.min',
        'stickynavigation': 'js/stickySidebar'
    },
    shim: {
        'owlcarousel': {
            deps: ['jquery']
        },
        'easyticker': {
            deps: ['jquery']
        },
        'stickynavigation':{
             deps: ['jquery']
        }

    }
};
