$(document).ready(function() {

    // MASK JS - Add (-) while customer is typing ISBN
    $('#search').mask('000-0-0000-0000-0');
    
    $('#research').click(function(event) {

        // 1- Stop propagation submit
        event.preventDefault();
        // 2- Hide errors
        $("#isbnInconnu").hide();
        // 3- Check if there is a research
        // If the input is empty, change the placeholder
        if ($("#search").val() == '')
        {
            $('#search').attr('placeholder','Que recherchez-vous?');
        } 
        else
        {
            // If the user wrote something
            // Set the ISBN
            var myIsbn = $("#search").val()
            // Set the api variable
            var googleAPI = "https://www.googleapis.com/books/v1/volumes?q=isbn:" + myIsbn.replace(/-/g, '');

            // 4- Check if ISBN exist
            // Make an ajax call to get the json data as response.
            $.getJSON(googleAPI, function (response) {
                // If undefined: show error
                if( typeof response.items == 'undefined')
                {
                    $("#isbnInconnu").show();
                }
                else
                {
                    // If ISBN exist,
                    // Ajax: Check if the book exist in DB
                    $.ajax({
                        url  : "recherche_ISBN",
                        type : "POST",
                        dataType: "json",
                        data : {
                            ISBN_book : myIsbn
                        }
                    }).done(function(data) {
                        console.log(JSON.stringify(data.ok));
                        if(data.ok)
                        {
                            // alert(data.ok)
                            //<input type="hidden" value="`+ JSON.stringify(data.ok.rows[0].c[6]) + `">
                            $('#list').replaceWith($(`
                                <div class="alert alert-success">
                                    Ce livre a été répertorié par `+data.ok+` membres.
                                    <a href="{{ url('livresVoyageurs_inscription') }}">
                                        Inscrivez-vous pour entrer en contact avec eux.
                                    </a>
                                </div>
                            `))

                            // Loop through all the items one-by-one
                            for (var i = 0; i < response.items.length; i++) {
                                // set the item from the response object
                                var item = response.items[i];
                                // Set Language
                                if(item.volumeInfo.language == 'en')
                                {
                                    item.volumeInfo.language = 'Anglais'
                                }
                                else if(item.volumeInfo.language == 'fr')
                                {
                                    item.volumeInfo.language = 'Français'
                                }
                                // Set the book infos in the div
                                document.getElementById("bookImage").setAttribute('src', item.volumeInfo.imageLinks.smallThumbnail);
                                document.getElementById("bookInfos").innerHTML += "<li class='list-group-item'>Titre: " + item.volumeInfo.title + "</li>";
                                document.getElementById("bookInfos").innerHTML += "<li class='list-group-item'>Auteur: " + item.volumeInfo.authors + "</li>";
                                document.getElementById("bookInfos").innerHTML += "<li class='list-group-item'>Description: " + item.searchInfo.textSnippet + "</li>";
                                document.getElementById("bookInfos").innerHTML += "<li class='list-group-item'>Langue: " + item.volumeInfo.language + "</li>";
                            }
                        }
                        else
                        {
                            $(`
                                <div class="alert alert-warning">
                                    <strong>
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        Attention !
                                    </strong><br>Ce livre n'est pas encore répertorié.
                                </div>
                            `).prependTo($('#list')).delay(3000).fadeOut();
                            // -- On Réinitialise le Formulaire
                            // $('#list').get(0).reset();
                        }
                    }) // ajax: done
                } // else: undefined
            }) // google api
        } // else: input not empty
    }) // click research

}) // document ready
