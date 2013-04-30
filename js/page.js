$().ready(function(){

	$('a.removeSidebar').on('click', function(){
		$('#wrapper').toggleClass('noSidebar');
	});

	if($('.searchTable').length){
		$(".searchTable").advancedtable({
			searchField: "#search",
			loadElement: "#loader",
			searchCaseSensitive: false,
			ascImage: "/img/icons/up.png",
			descImage: "/img/icons/down.png"
		});
	}

	$('a.showSearchTools').on('click', function(){
		$('.searchTools').toggle();
	})

})