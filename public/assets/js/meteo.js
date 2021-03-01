 $(function() {

        var apiKey = 'b7863436de8cd154e95c4fc08aaed055';

        var baseUrl = 'https://api.openweathermap.org/data/2.5/weather?APPID=' + apiKey + '&units=metric' + '&lang=fr';



        $('#weather button').click(function(e) {

            e.preventDefault();

            var city = $('#city');

            var cityValue = city.val();



            var params = {

                url: baseUrl + '&q=' + cityValue,

                method: 'GET'

            };



            $.ajax(params).done(function(response) {

                    // show card

                    $('.card').removeClass('d-none');



                    // error



                    city.removeClass('is-invalid');

                    $('.invalid-feedback').slideUp();

                    $('.card').show();





                    // title

                    $('.card-title').text(response.name);



                    // description



                    $('.description-weather').text(response.weather[0].description);



                    // temp

                    var temp = Math.round(response.main.temp) + ' °';

                    var tempMax = Math.round(response.main.temp_max) + ' °';

                    var tempMin = Math.round(response.main.temp_min) + ' °';



                    $('.temp-weather').text(temp);

                    $('.temp-max-weather').text(tempMax);

                    $('.temp-min-weather').text(tempMin);



                    // image

                    var image = response.weather[0].icon;

                    $('.image-weather').attr('src', 'http://openweathermap.org/img/w/' + image + '.png');

                    $('.image-weather').attr('alt', response.name);



                })

                .fail(function() {

                    $('.invalid-feedback').slideDown();

                    city.addClass('is-invalid');

                    $('.card').hide();

                });



        });



    });