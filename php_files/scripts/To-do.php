<?php
session_start();
include("../db/connect.php");
?>


<!DOCTYPE html>
<lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TO DO LIST</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"> -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <!-- Include jQuery from a CDN -->



    <body>
        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row container d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="card px-3">
                            <div class="card-body">

                                <h1 class="card-title">TO-DO LIST</h1>

                                <!-- <button class="log_out_btn" type="submit" method="POST">Log Out</button> -->
                                <button class="Btn" onclick="redirect()">
                                    <div class="sign">
                                        <svg viewBox="0 0 512 512">
                                            <path
                                                d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                                        </svg>
                                    </div>

                                    <div class="text">Logout</div>
                                </button>
                                <!-- <a class="logout_btn" href="log_out.php">logout</a> -->
                                <?php
                                echo "<h2>Welcome, " . $_SESSION["user_name"] . "</h2>";
                                ?>
                                <form class="add-items d-flex" method="post" action="todo-script.php">
                                    <input type="text" id="name" name="tasks" class="form-control todo-list-input" placeholder="What do you need to do today?" required>
                                    <button class="add btn btn-primary font-weight-bold todo-list-add-btn" id="add_btn">Add</button>
                                </form>


                            </div>

                            <div id="load_row" class="list-wrapper">
                                <ul class="d-flex flex-column-reverse todo-list">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="../styles/js_file/index.js" charset="utf-8"></script> -->
    <link rel="stylesheet" href="../styles/to-do.css">


    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: 'load-data.php',
                success: function(data) {
                    data = JSON.parse(data);
                    // console.log(data);

                    data.forEach(element => {
                        // console.log(element);
                        var color = "red";
                        if (element.id % 2 == 0) {
                            color = "green";
                        }

                        var text = `<li>
                                    <div class='form-check'>
                                        <label class='form-check-label' style="color:${color}"><span class="id" style="display:none">${element.id}</span>
                                            <input class='checkbox' type='checkbox' ${element.status} /> <i class='input-helper'></i> ${element.name}
                                        </label>
                                    </div>
                                    <a href="delete_tasks.php?id=${element.id}" class='remove mdi mdi-close-circle-outline'></a>
                                </li>`;

                        $(".todo-list").append(text);
                    });

                    $(".checkbox").click(function() {
                        var checkbox = $(this);
                        var status = "pending";

                        if (checkbox.is(":checked")) {
                            status = "checked"
                        }

                        // console.log(checkbox)
                        var id = checkbox.parent().children()[0].innerText;
                        console.log(id)

                        $.ajax({
                            url: 'checked.php',
                            type: 'POST',
                            data: {
                                id: id,
                                status: status
                            },
                            success: function(response) {}
                        })
                    })
                },
            });

            $("#add_btn").click(function(e) {
                e.preventDefault();
                var taskName = $("#name").val();
                var status = "pending";
                $.ajax({
                    type: 'POST',
                    url: 'todo-script.php',
                    data: {
                        name: taskName,
                        status: status,
                    },
                    success: function(response) {
                        console.log(response)
                        response = JSON.parse(response);
                        var id = response.id;
                        var color = "red";
                        if (response.id % 2 == 0) {
                            color = "green";
                        }
                        var text = `<li>
                                    <div class='form-check'>
                                        <label class='form-check-label' style="color:${color}">
                                            <input id='checkbox' class='checkbox' type='checkbox' ${status}/> <i class='input-helper'></i> ${taskName}
                                        </label>
                                    </div>
                                    <a href="delete_tasks.php?id=${id}" class='remove mdi mdi-close-circle-outline'></a>
                                </li>`;
                        $(".todo-list").append(text);
                    },
                });
            });
        });
    </script>
    <script>
        function redirect() {
            window.location.href = "log_out.php";
        }
    </script>

    </html>