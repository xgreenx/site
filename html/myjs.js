window.onload = function() {
	var ImageMap = function(map) {
		var n,
		    areas = map.getElementsByTagName('area'),
		    len = areas.length,
		    coords = [],
		    previousWidth = 1211;
		for ( n = 0; n < len; n++) {
			coords[n] = areas[n].coords.split(',');
		}
		this.resize = function() {
			var n,
			    m,
			    clen,
			    x = document.body.clientWidth / previousWidth;
			for ( n = 0; n < len; n++) {
				clen = coords[n].length;
				for ( m = 0; m < clen; m++) {
					coords[n][m] *= x;
				}
				areas[n].coords = coords[n].join(',');
			}
			previousWidth = document.body.clientWidth;
			return true;
		};
		window.onresize = this.resize;
	},
	    imageMap = new ImageMap(document.getElementById('map_id'));
	imageMap.resize();
}
function show(state, e, path) {
	$(".wrap#map").css("display", state);
	document.getElementById('window').style.left = e.clientX;
	document.getElementById('window').style.top = e.clientY;
	document.getElementById('window').style.display = state;
	
	if(path != ""){
		$.post("ajaxValue/" + path, {}, function(data){
			$("#window").html(data);
		});
	}
	
}

function RegShow(state) {
	document.getElementById('signUpWin').style.display = state;
	$(".wrap#sign").css("display", state);
}