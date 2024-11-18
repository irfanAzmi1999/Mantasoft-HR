<html>
    <head>
           
    </head>
    
    <body>
        <label for="fname">First name:</label>
        <input type="text" id="fname" name="fname" value="">

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="">

        <button class="submit">press me</button><br>

        <p id="test"></p><br>

        <label for="cars">Choose a car:</label>
            <select name="cars" class="cars">
                <option value="volvo">Volvo</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
            </select>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

        <script>
            // $(document).on('click','.submit', function(){
            //     var fname = $('#fname').val();
            //     var email = $('#email').val();
            //     //alert(fname);
                
            //     //$('#test').html('I have type '+fname +' and my email is '+email);
            // })

            // $(document).ready(function(){
            //     $("select.cars").change(function(){
            //         var cars = $(this).children("option:selected").val();
            //         alert("You have selected the cars - " + cars);
            //     });t(cars);
            // })

            $(document).ready(function() {
            $(.cars).click(function() {
                $.ajax({url: "geeks.txt", 
                        success: function(result) {
                    $('#test').html(result);
                }});
            });
        });
        </script>
    </body>
</html>