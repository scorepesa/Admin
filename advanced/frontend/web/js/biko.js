
$.ajax({
    type : "GET",
    url : '/site/bet-stats',
    data: {},
    success  : function(data) {
       console.log(data.data);
         var json = data; // $.parseJSON(data);
        
	new Chartist.Line('#dailySalesChart', {
	  labels:json.dates,
	  series:json.data
	}, 
        {
	  fullWidth: true,
	  chartPadding: {
	    right: 40
	  }
	});
   }
});


$.ajax({
    type : "GET",
    url : '/site/bet-winnings',
    data: {},
    success  : function(data) {
       console.log(data.data);
         var json = data; // $.parseJSON(data);
        
	new Chartist.Line('#winnings', {
	  labels:json.dates,
	  series:json.data
	}, 
        {
	  fullWidth: true,
	  chartPadding: {
	    right: 40
	  }
	});
   }
});
$.ajax({
    type : "GET",
    url : '/site/deposits',
    data: {},
    success  : function(data) {
       console.log(data.data);
         var json = data; // $.parseJSON(data);
        
	new Chartist.Line('#deposits', {
	  labels:json.dates,
	  series:json.data
	}, 
        {
	  fullWidth: true,
	  chartPadding: {
	    right: 40
	  }
	});
   }
});

