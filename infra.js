Event.handler('layer.oncheck', function (layer){//external уже проверен
	//subs
	infrajs.subMake(layer);
}, 'subs:div,external');