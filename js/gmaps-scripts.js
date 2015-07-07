var GoogleMaps = function () {

    var mapBasic = function () {
        new GMaps({
            div: '#gmap_basic',
            lat: -12.043333,
            lng: -77.028333
        });
    }

    

    return {
        //main function to initiate map samples
        init: function () {
            mapBasic();
            
        }

    };

}();