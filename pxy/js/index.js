	
	var app = new Vue({
	  el: '#app',
	  data: {
	    message: 'Hello Vue!'
	  },

	})


	console.log(app)

	var severUrl = 'http://47.89.20.150/czlycmsCN/';

	 $.ajax({
        url: severUrl+'index.php?m=Web&a=getStock',
        type: 'GET',
        dataType: 'JSONP'
    })
    .done(function(data) {
        console.log("success");
        console.log(data.time);
        app._data.message = data.time
     }) 
    .fail(function() {
        console.log("error");
    });

	