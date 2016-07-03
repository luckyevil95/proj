var isModerator;
var currentPage = 1;
var countPostsPage = 5;
var maxPage;
var orderType = "date";
var orderDirection = "DESC";

$(document).ready(function()
{
	loadPosts();
	loadPagination();
});

function loadPosts()
{
	$(".postsTable").empty();
	
	if (isModerator == 1)
		$(".postsTable").append("<tr class='postTableHead'><td order='name'>Ім'я</td><td order='email'>E-Mail</td><td>Сайт</td><td>Повідомлення</td><td>IP</td><td>Браузер</td><td width='100' order='date'>Дата▼</td><td></td></tr>");
	else
		$(".postsTable").append("<tr class='postTableHead'><td order='name'>Ім'я</td><td order='email'>E-Mail</td><td>Сайт</td><td>Повідомлення</td><td width='100' order='date'>Дата▼</td></tr>");
	
	$.ajax({
		url: "/ajax.php",
		type: "POST",
		dataType: "json",
		data: { type: "loadPosts", number: currentPage, orderType: orderType, orderDirection: orderDirection },
		success: function(json)
		{	
			for (var i = 0; i < json.length; i++)
			{
				if (isModerator == 1)
					$(".postsTable").append("<tr class='postTableTr' id='" + json[i]["id"] + "'><td type='name'>" + json[i]["name"] + "</td><td type='email'>" + json[i]["email"] + "</td><td type='url'>" + json[i]["url"] + "</td><td type='text'>" + json[i]["text"] + "</td><td type='ip'>" + json[i]["ip"] + "</td><td type='browser'>" + json[i]["browser"] + "</td><td type='date'>" + json[i]["date"] + "</td><td><img class='editPost' src='/img/pencil.png'><img class='deletePost' src='/img/delete.png'></td></tr>");
				else
					$(".postsTable").append("<tr class='postTableTr'><td>" + json[i]["name"] + "</td><td>" + json[i]["email"] + "</td><td>" + json[i]["url"] + "</td><td>" + json[i]["text"] + "</td><td>" + json[i]["date"] + "</td></tr>");
			}
			
			$(".postTableHead > td").click(sortPosts);
			$(".deletePost").click(deletePost);
			$(".editPost").click(editPost);
		}
	});
}

function loadPagination()
{
	$(".paginPosts").empty();
	
	$.ajax({
		url: "/ajax.php",
		type: "POST",
		dataType: "text",
		data: { type: "loadCountPosts" },
		success: function(text)
		{	
			maxPage = Math.ceil(text / countPostsPage);
		
			$(".paginPosts").append("<div id='backPage'><</div>Сторінка " + currentPage + " із " + maxPage + "<div id='nextPage'>></div>");
			
			$("#backPage").click(backPagePosts);
			$("#nextPage").click(nextPagePosts);
		}
	});
}

function backPagePosts()
{
	if (currentPage > 1)
	{
		currentPage--;
		
		loadPosts();
		loadPagination();
	}
}

function nextPagePosts()
{
	if (currentPage < maxPage)
	{
		currentPage++;
		
		loadPosts();
		loadPagination();
	}
}

function sortPosts()
{
	switch ($(this).attr("order"))
	{
		case "name":
			changeDirection(this)
				
			orderType = "name";
			
			loadPosts();
			
			changeDirectionSymbol();
			
			break;
			
		case "email":
			changeDirection(this);
				
			orderType = "email";
			
			loadPosts();
			
			changeDirectionSymbol();
			
			break;
			
		case "date":
			changeDirection(this)
				
			orderType = "date";
			
			loadPosts();
			
			changeDirectionSymbol();
			
			break;
	}
}

function changeDirectionSymbol()
{
	$(".postTableHead > td").each(function(i,elem) {
		if ($(elem).text().indexOf("▼") != -1 || $(elem).text().indexOf("▲") != -1)
			$(elem).text($(elem).text().substring(0, $(elem).text().length - 1));
	});
	
	if (orderDirection == "DESC")
		$(".postTableHead > td[order='" + orderType + "']").append("▼");
	else
		$(".postTableHead > td[order='" + orderType + "']").append("▲");
}

function changeDirection(obj)
{
	if (orderType == $(obj).attr("order"))
		if (orderDirection == "DESC")
			orderDirection = "ASC";
		else
			orderDirection = "DESC";
	else
		orderDirection = "DESC";
}

function deletePost()
{
	if (confirm("Ви дійсьно бажаєте видалити це повідомлення?"))
		$.ajax({
			url: '/ajax.php',
			type: 'POST',
			dataType: 'text',
			data: { type: "deletePost", id: $(this).parent().parent().attr("id") },
			success: function(text)
			{
				if (text == "success")
				{
					if ($(".postTableTr").length == 1 && currentPage != 1)
						currentPage--;
					
					loadPosts();
					loadPagination();
				}
				else
					alert(text);
			}
		});
}

function editPost()
{
	if ($(this).attr("src") == "/img/pencil.png")
	{
		$(this).attr("src", "/img/ok.png");
		
		$(".postTableTr[id='" + $(this).parent().parent().attr("id") + "'] > td").each(function(i,elem) {
			if ($(elem).attr("type"))
			{
				text = $(elem).text();
				width = $(elem).width();
				
				$(elem).empty();
				$(elem).append("<textarea type='" + $(elem).attr("type") + "' style='width: " + (width - 5) + "px; height: 100px;'>" + text + "</textarea>");
			}
		});
	}
	else
	{
		$(this).attr("src", "/img/pencil.png");
		
		$.ajax({
			url: '/ajax.php',
			type: 'POST',
			dataType: 'text',
			data: { 
				type: "editPost", id: $(this).parent().parent().attr("id"), 
				name: $(this).parent().parent().children("td[type='name']").children("textarea").val(), 
				email: $(this).parent().parent().children("td[type='email']").children("textarea").val(), 
				url: $(this).parent().parent().children("td[type='url']").children("textarea").val(), 
				text: $(this).parent().parent().children("td[type='text']").children("textarea").val(), 
				ip: $(this).parent().parent().children("td[type='ip']").children("textarea").val(), 
				browser: $(this).parent().parent().children("td[type='browser']").children("textarea").val(), 
				date: $(this).parent().parent().children("td[type='date']").children("textarea").val()
			},
			success: function(text)
			{
				if (text == "success")
				{
					loadPosts();
				}
			}
		});
	}
}