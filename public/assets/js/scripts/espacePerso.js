$(document).ready(function() {

    // MASK JS - Add (-) while customer is typing ISBN
    // Set the ISBN
	$('#formAddBook_ISBN_book').mask('000-0-0000-0000-0');
    // Google Auto-complete
	function initializeAddBook() {
		var input = document.getElementById('formAddBook_addressStart');
		var autocomplete = new google.maps.places.Autocomplete(input);
		google.maps.event.addListener(autocomplete, 'place_changed', function () {
			var place = autocomplete.getPlace();
			document.getElementById('formAddBook_city_startpoint').value = place.name;
			document.getElementById('formAddBook_lat_startpoint').value = place.geometry.location.lat();
			document.getElementById('formAddBook_lng_startpoint').value = place.geometry.location.lng();
		});
	}
	google.maps.event.addDomListener(window, 'load', initializeAddBook);

	function initializeCapture() {
		var input = document.getElementById('formCapture_address');
		var autocomplete = new google.maps.places.Autocomplete(input);
		google.maps.event.addListener(autocomplete, 'place_changed', function () {
			var place = autocomplete.getPlace();
            //alert(JSON.stringify(place))
			document.getElementById('formCapture_city_pointer').value = place.name;
			document.getElementById('formCapture_lat_pointer').value = place.geometry.location.lat();
			document.getElementById('formCapture_lng_pointer').value = place.geometry.location.lng();
		});
	}
	google.maps.event.addDomListener(window, 'load', initializeCapture);
    // ISBN - Book infos
	document.getElementById('formAddBook_ISBN_book').addEventListener('focus', function() {
        // Hide the error message
		$('#isbnInconnu').hide();
	});
	document.getElementById('formAddBook_ISBN_book').addEventListener('blur', function() {
        // Set the ISBN
        var myIsbn = document.getElementById("formAddBook_ISBN_book");
        // Set the api variable
        var googleAPI = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + myIsbn.value.replace(/-/g, '');
        $("#formAddBook_ISBN_book").val(myIsbn.value.replace(/-/g, ''))
        //alert(googleAPI);
        // Make an ajax call to get the json data as response.
		$.getJSON(googleAPI, function (response) {
            // Display Response objects
            //console.log("JSON Data: " + response.items);
			if( typeof response.items == 'undefined')
            {
				$('#isbnInconnu').show();
			}
			else
            {
                // Loop through all the items one-by-one
				for (var i = 0; i < response.items.length; i++) {
                    // set the item from the response object
					var item = response.items[i];
                    // Set Language
					if(item.volumeInfo.language == 'en')
                    {
						item.volumeInfo.language = 'Anglais';
					}
					else if(item.volumeInfo.language == 'fr')
                    {
						item.volumeInfo.language = 'Français';
					}
                    // Set the book infos in the div
                    document.getElementById("bookImage").setAttribute('src', item.volumeInfo.imageLinks.smallThumbnail);
                    document.getElementById("bookInfos").innerHTML += "<li class='list-group-item'>Titre: " + item.volumeInfo.title + "</li>";
                    document.getElementById("bookInfos").innerHTML += "<li class='list-group-item'>Auteur: " + item.volumeInfo.authors + "</li>";
                    // document.getElementById("bookInfos").innerHTML += "<li class='list-group-item'>Description: " + item.searchInfo.textSnippet + "</li>";
                    document.getElementById("bookInfos").innerHTML += "<li class='list-group-item'>Langue: " + item.volumeInfo.language + "</li>";
                    // Set the book infos in the hidden input
					document.getElementById('formAddBook_photo_book').value    = item.volumeInfo.imageLinks.smallThumbnail;
					document.getElementById('formAddBook_title_book').value    = item.volumeInfo.title;
					document.getElementById('formAddBook_authors').value       = item.volumeInfo.authors;
					document.getElementById('formAddBook_summary_book').value  = item.searchInfo.textSnippet;
					document.getElementById('formAddBook_language_book').value = item.volumeInfo.language;
				}
			}
		});
	});


	$('#formPass_pass_member_first').bind('keyup', function () {
        //TextBox left blank.
		if ($(this).val().length == 0) {
			$('#password_strength').html('');
			return;
		}
        //Regular Expressions.
		var regex = new Array();
		regex.push('[A-Z]'); //Uppercase Alphabet.
		regex.push('[a-z]'); //Lowercase Alphabet.
		regex.push('[0-9]'); //Digit.
        // regex.push("[$@$!%*#?&]"); //Special Character.
		var passed = 0;
        //Validate for each Regular Expression.
		for (var i = 0; i < regex.length; i++) {
			if (new RegExp(regex[i]).test($(this).val())) {
				passed++;
			}
		}
        //Validate for length of Password.
		if (passed > 2 && $(this).val().length >= 6) {
			passed++;
		}
        //Display status.
		var color = '';
		var strength = '';
		switch (passed) {
		case 0:
		case 1:
		case 2:
		case 3:
			$("#password_strength").html(`
			<div class="progress">
				<div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
				<span class="sr-only">40% Complete (danger)</span>
				</div>
			</div>
			`);
			break;
		case 4:
			$("#password_strength").html(`
				<div class="progress">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
					<span class="sr-only">100% Complete (success)</span>
					</div>
				</div>
			`);
			break;
		case 5:
			strength = "Very Strong";
			color = "darkgreen";
			break;
		}
	});

    // Show/Hide Mdp Help-text
	$('#pass-helptext').hide();

	$('#formPass_pass_member_first').focus(function() {
		$('#pass-helptext').show();
	});
	$('#formPass_pass_member_first').blur(function() {
		$('#pass-helptext').hide();
	});


    // Redirect to the right tab on page reload
	var hash = window.location.hash;
	hash && $('ul.nav a[href="' + hash + '"]').tab('show');

	$('.nav-tabs a').click(function (e) {
		$(this).tab('show');
		var scrollmem = $('body').scrollTop();
		window.location.hash = this.hash;
		$('html,body').scrollTop(scrollmem);
	});

    //
    $(`<br>`).prependTo($("#formAddBook_disponibility_book_1"))
}) // document ready
