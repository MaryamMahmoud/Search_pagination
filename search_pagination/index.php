<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        table {
            border-spacing: 15px;
        }
    </style>

</head>

<body>
    <div class="search">
        <label>Search</label>
        <input type="text" id="search_box" name="search_box" placeholder="Enter your search query here">
        <br>
        <br>
        <h2 class="searchResult" id="result">

        </h2>
    </div>

    <script>
    //handling AJAX for search
        function load_data(page, search = '') {
            $.ajax({
                url: "search.php",
                method: "POST",
                data: {
                    page: page,
                    search: search
                },
                success: function(data) {
                    $('#result').html(data);
                }
            })
        }
        $('#search_box').keyup(function() {

            var search = $('#search_box').val();
            load_data(1, search);

            load_data(1, search);
        });
        $(document).on('click', '.pagination_linkk', function() {
            var page = $(this).attr("id");
            var search = $('#search_box').val();

            load_data(page, search);
        });


    </script>

    <div class="container">
        <h1>Hello</h1>
        <h2>List of available courses</h2>
        <div class="table_responsive" id="pagination_data">
        </div>
    </div>
    <br>
    <button id="hide" class="btn">Hide courses</button>
    <script type="text/javascript">
    //AJAX HANDLING FOR THE TABLE OF COURSES
        $(document).ready(function() {
            load_data();

            function load_data(page) {
                $.ajax({
                    url: "ajaxhandle.php",
                    method: "POST",
                    data: {
                        page: page
                    },
                    success: function(data) {
                        $('#pagination_data').html(data);
                    }
                })
            }
            $(document).on('click', '.pagination_link', function() {
                var page = $(this).attr("id");
                load_data(page);
            });
        });
        $("#hide").click(function() {
            $("td").hide();
        });
    </script>
</body>

</html>