<?php

session_start();
require_once "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Athene LMS</title>



    <?php include "../css.php"; ?>
    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        .invalid {
            color: red;
            font-size: 80%;
            padding-left: 1%;
            display: none;
        }


        .card-hover:hover {
            transform: scale(1.05);
            /* Scale up on hover */
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            /* Add a subtle downward shadow */
            z-index: 1;
            /* Bring the card above other elements */
            transition: 300ms;
        }

        /* Style for the autocomplete container */
        .autocomplete {
            position: relative;
            display: inline-block;
        }

        /* Style for the suggestion list */
        .UL {
            list-style-type: none;
            padding: 0;
            margin: 0;
            border: 1px solid #ccc;
            border-top: none;
            position: absolute;
            width: 60%;
            max-height: 150px;
            overflow-y: auto;
            z-index: 1;
        }

        /* Style for individual suggestion items */
        .UL li {
            padding: 8px;
            cursor: pointer;
        }

        /* Highlight suggestion on hover */
        .UL li:hover {
            background-color: #0d6efd;
            color: white;
        }

        @media (max-width: 768px) {
            .card {
                margin: 10px 0;
            }
        }

        /* Media query for medium screens (768px to 991px) */
        @media (min-width: 768px) and (max-width: 991px) {
            .nav-tabs {
                flex-direction: row;
            }

            .nav-link {
                flex: 1;
                text-align: center;
            }
        }

        /* Media query for large screens (992px and above) */
        @media (min-width: 992px) {
            .nav-tabs {
                flex-direction: row;
            }

            .nav-link {
                /* Adjust the width based on your preference */
                flex: 1;
                text-align: center;
            }
        }

        @media (max-width: 767px) {
            .card-title {
                font-size: 1rem;
            }

            .place-card__content_header {
                margin-bottom: 0.5rem;
            }

            .card-icon {
                font-size: 40px;
            }

            .dropdown-menu {
                min-width: 150px;
            }
        }

        @media (max-width: 767px) {
            .nav-tabs {
                flex-direction: column;
                text-align: left;
            }

            .nav-link {
                width: 100%;
                margin-bottom: 5px;
            }

            .tab-pane {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <?php

    require("../connection.php");
    require_once "../sidebar.php";
    require_once "../header.php";
    ?>
    <div class="modal fade bd-example-modal-lg " id="sModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="bi bi-check2-circle text-success h1"></i>
                        <p class="mt-2 h2 text-success">Question Updated Successfully</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg " id="sdModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="bi bi-check2-circle text-success h1"></i>
                        <p class="mt-2 h2 text-success">Question Deleted Successfully</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg " id="mod1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="ri-error-warning-line text-primary h2"></i>
                        <p class="mt-2 text-dark">Are You Sure Want To Delete?</p>
                        <p class="mt-2 text-dark" id="modalCourseName"></p>
                        <button type="button" class="btn btn-secondary my-2 close">Close</button>
                        <a class="icon" id="modalDeleteBtn"><button type="button" class="btn btn-danger my-2" data-dismiss="modal">Delete</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add/Edit Question Modal -->
    <div class="modal fade bd-example-modal-lg " id="successModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="bi bi-check2-circle text-success h1"></i>
                        <p class="mt-2 h2 text-success">Updated Successfully</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg " id="successModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="bi bi-check2-circle text-success h1"></i>
                        <p class="mt-2 h2 text-success">Quesiton Added Successfully</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <main id="main" class="main overflow-hidden">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="#">Question Bank</a></li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="card ms-3 col-11 m-1 ">

                <div class="card-body">

                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Add Question</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">View Questions</button>
                        </li>


                    </ul>
                    <div class="tab-content pt-2" id="borderedTabContent">
                        <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                            <!-- Tab content 1 -->
                            <form id="quizForm">
                                <div class="card-body mt-3">
                                    <div class="ms-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" class="form-control mt-2 mb-2" id="quesCategoryField" autocomplete="off" name="ques_category" placeholder="Category">
                                                <ul id="myUL1" class="UL suggestion-item text-dark card d-none"></ul>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" id="quesTopicField" class="form-control mt-2 mb-2" autocomplete="off" name="ques_topic" placeholder="Topic">
                                                <ul id="myUL2" class="UL suggestion-item text-dark card d-none"></ul>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" id="quesSubTopicField" class="form-control mt-2 mb-2" autocomplete="off" name="ques_sub_topic" placeholder="Sub Topic">
                                                <ul id="myUL3" class="UL suggestion-item text-dark card d-none"></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="Number" class="ms-3 form-control mt-2 mb-2" id="mark" name="ques_mark" placeholder="Enter marks">
                                        </div>

                                        <div class="col-6">
                                            <input type="number" class="form-control mt-2 mb-2" name="ques_correct_answer" placeholder="Enter Right Answer">

                                        </div>
                                    </div>
                                    <div class="mt-3 ms-3">
                                        <span class="text-dark ms-1">Add Question</span>

                                        <textarea type="text" class="form-control mt-2 mb-2" id="addQuestion" name="questionName" rows="5" placeholder="Enter question"></textarea>
                                    </div>

                                    <div class="mt-3 ms-3" id="addedAnswers">
                                        <span class="text-dark ">Add Options</span>
                                        <div class="col-11">
                                            <input type="text" class="form-control mt-2 mb-2" id="option" name="ques_answer[]" placeholder="Option 1">
                                        </div>
                                        <div class="col-11">
                                            <input type="text" class="form-control mt-2 mb-2" id="option" name="ques_answer[]" placeholder="Option 2">
                                        </div>
                                        <span id="addMoreAnswerBtn" class="btn btn-primary">Add more</span>
                                    </div>
                                    <div class="col-5 ms-3">
                                        <input type="submit" class="mt-2 btn btn-primary" id="submitBtn">
                                    </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item ms-3">
                                <h1 class="accordion-header" id="flush-headingOne">
                                    <button class="ms-2 accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                        <p class="h5">Search</p>
                                    </button>
                                </h1>
                                <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="ms-2 form-label text-dark">Category</label>
                                            <select id="inputCategory" class="search-input form-select" name="">
                                                <?php
                                                echo "<option value=''>Select Category</option>";
                                                $sql = "select distinct ques_category from question";
                                                if ($result = mysqli_query($conn, $sql)) {
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='{$row['ques_category']}'>{$row['ques_category']}</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=''>No topics found</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="ms-2 form-label text-dark">Topic</label>
                                            <select id="inputTopic" class="search-input form-select" name="">
                                                <?php
                                                echo "<option value=''>Select Topic</option>";
                                                $sql = "select distinct ques_topic from question";
                                                if ($result = mysqli_query($conn, $sql)) {
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='{$row['ques_topic']}'>{$row['ques_topic']}</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=''>No topics found</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="ms-2 form-label text-dark">Sub-Topic</label>
                                            <select id="inputSubTopic" class="search-input form-select" name="">
                                                <?php
                                                echo "<option value=''>Select Sub Topic</option>";
                                                $sql = "select distinct ques_sub_topic from question";
                                                if ($result = mysqli_query($conn, $sql)) {
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='{$row['ques_sub_topic']}'>{$row['ques_sub_topic']}</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=''>No sub topics found</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <hr class="text-dark mt-4">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <label class="ms-2 form-label text-dark">Question</label>
                                            <input type="text" id="inputQuestion" class="search-input form-control" name="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="text-dark mt-3  ms-3">
                        <div class="ms-3 mt-3" id="responseQuestions">
                            <!-- Show questions here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- End  Tab -->

        </div>
    </main>

    <?php include "../js.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>

    <script>
        $(document).ready(function() {
            var next = 3;

            function reassignNumber() {
                var div = document.getElementById("addedAnswers");
                var inputs = document.getElementsByName("ques_answer[]");
                totalInputCount = inputs.length;
                init = 1;
                inputs.forEach(function(inputElement) {
                    inputElement.setAttribute('placeholder', 'Option ' + init);
                    init++;
                });
                // console.log(inputs);

            }


            $("#addMoreAnswerBtn").on("click", function() {
                nextId = "option" + next;
                inputBox = `<div id="` + nextId + `" class="row"><div class="col-11 d-flex justify-content-center align-items-center"><input type="text" class="form-control mb-2" name="ques_answer[]" placeholder=""></div><div class="col-1"><span class="btn btn-primary removeOption" value="` + nextId + `">&#10006;</span></div></div>`;
                $(inputBox).insertBefore("#addMoreAnswerBtn");
                next += 1;
                reassignNumber();

            });

            // #pollOptions is a div where input boxes will be added dynmically, .removeOption is a class for spans that are buttons used to remove input boxes which are in divisions with
            // an id assigned to them, id is taken from span element to find each division

            $("#addedAnswers").on("click", ".removeOption", function(e) {
                const elem = $(e.target).attr("value");
                // console.log(elem);
                $('#' + elem).remove();
                reassignNumber();

            });


        });

        // Sample list of possible categorySuggestions
        const categorySuggestions = [];
        const topicSuggestions = [];
        const subTopicSuggestions = [];

        // Get references to the input field and the suggestion list
        const categoryInputField = document.getElementById("quesCategoryField");
        const topicInputField = document.getElementById("quesTopicField");
        const subTopicInputField = document.getElementById("quesSubTopicField");

        subTopicInputField.disabled = true;
        topicInputField.disabled = true;

        const suggestionList1 = document.getElementById("myUL1");
        const suggestionList2 = document.getElementById("myUL2");
        const suggestionList3 = document.getElementById("myUL3");

        // Function to update the suggestion list based on user input
        categoryInputField.addEventListener("input", function updateSuggestions() {
            $.ajax({
                url: 'ajax_get_categories_db.php',
                type: 'POST',
                data: {
                    value: this.value
                },
                success: function(data) {
                    // Assuming your PHP script returns a JSON array
                    suggestionList1.innerHTML = '';
                    categorySuggestions.length = 0;
                    data = JSON.parse(data);
                    // console.log(data[0]);
                    if (data[0] != "Empty value") {
                        // console.log(data[0] != "Empty value");
                        if (Array.isArray(data)) {
                            $.each(data, function(index, item) {
                                categorySuggestions.push(item);
                            });
                            suggestionList1.innerHTML = ''; // Clear previous categorySuggestions

                            for (let suggestion of categorySuggestions) {
                                let listItem = document.createElement("li");
                                listItem.setAttribute("class", "dropdown-item");
                                listItem.textContent = suggestion;
                                suggestionList1.appendChild(listItem);
                            }

                            if (suggestionList1.classList.contains("d-none")) {
                                suggestionList1.classList.remove("d-none");
                            }
                        } else {

                        }
                    } else {
                        closeSuggestions1();
                    }
                },
                error: function() {
                    // console.error('Error in AJAX request');
                }
            });
        });

        // Function to update the suggestion list based on user input
        topicInputField.addEventListener("input", function updateSuggestions() {
            $.ajax({
                url: 'ajax_get_topic_db.php',
                type: 'POST',
                data: {
                    value: this.value,
                    category: $("#quesCategoryField").val()
                },
                success: function(data) {
                    // Assuming your PHP script returns a JSON array
                    suggestionList2.innerHTML = '';
                    topicSuggestions.length = 0;
                    data = JSON.parse(data);
                    // console.log(data[0]);
                    if (data[0] != "Empty value") {
                        // console.log(data[0] != "Empty value");
                        if (Array.isArray(data)) {
                            $.each(data, function(index, item) {
                                topicSuggestions.push(item);
                            });
                            suggestionList2.innerHTML = ''; // Clear previous topicSuggestions

                            for (let suggestion of topicSuggestions) {
                                let listItem = document.createElement("li");
                                listItem.setAttribute("class", "dropdown-item");
                                listItem.textContent = suggestion;
                                suggestionList2.appendChild(listItem);
                            }

                            if (suggestionList2.classList.contains("d-none")) {
                                suggestionList2.classList.remove("d-none");
                            }
                        } else {

                        }
                    } else {
                        closeSuggestions2();
                    }
                },
                error: function() {
                    // console.error('Error in AJAX request');
                }
            });
        });


        // Function to update the suggestion list based on user input
        subTopicInputField.addEventListener("input", function updateSuggestions() {
            $.ajax({
                url: 'ajax_get_subtopic_db.php',
                type: 'POST',
                data: {
                    value: this.value,
                    category: $(categoryInputField).val(),
                    topic: $(topicInputField).val()
                },
                success: function(data) {
                    // Assuming your PHP script returns a JSON array
                    suggestionList3.innerHTML = '';
                    subTopicSuggestions.length = 0;
                    data = JSON.parse(data);
                    // console.log(data[0]);
                    if (data[0] != "Empty value") {
                        // console.log(data[0] != "Empty value");
                        if (Array.isArray(data)) {
                            $.each(data, function(index, item) {
                                subTopicSuggestions.push(item);
                            });
                            suggestionList3.innerHTML = ''; // Clear previous subTopicSuggestions

                            for (let suggestion of subTopicSuggestions) {
                                let listItem = document.createElement("li");
                                listItem.setAttribute("class", "dropdown-item");
                                listItem.textContent = suggestion;
                                suggestionList3.appendChild(listItem);
                            }

                            if (suggestionList3.classList.contains("d-none")) {
                                suggestionList3.classList.remove("d-none");
                            }
                        } else {}
                    } else {
                        closeSuggestions3();
                    }
                },
                error: function() {
                    // console.error('Error in AJAX request');
                }
            });
        });

        categoryInputField.addEventListener("input", function() {
            closeSuggestions2();
            closeSuggestions3();

            if (categoryInputField.value.trim() === "") {
                // If categoryInputField is empty, disable the other fields
                topicInputField.disabled = true;
                topicInputField.value = "";
                subTopicInputField.disabled = true;
                subTopicInputField.value = "";
            } else {
                // If categoryInputField is not empty, enable the topicInputField
                topicInputField.disabled = false;
            }
        });

        topicInputField.addEventListener("input", function() {
            closeSuggestions1();
            closeSuggestions3();
            if (topicInputField.value.trim() === "") {
                // If topicInputField is empty, disable the subTopicInputField
                subTopicInputField.disabled = true;
                subTopicInputField.value = "";
            } else {
                // If topicInputField is not empty, enable the subTopicInputField
                subTopicInputField.disabled = false;
            }
        });

        subTopicInputField.addEventListener("input", function() {
            closeSuggestions1();
            closeSuggestions2();
        });

        suggestionList1.addEventListener("click", function(event) {
            // Check if the clicked element is an <li> within the <ul>
            if (event.target.tagName === "LI") {
                const clickedText = event.target.textContent;
                if (clickedText != "No suggestions found") {
                    categoryInputField.value = clickedText;
                }
                closeSuggestions1(); // Close the suggestion list
            }
        });

        suggestionList2.addEventListener("click", function(event) {
            // Check if the clicked element is an <li> within the <ul>
            if (event.target.tagName === "LI") {
                const clickedText = event.target.textContent;
                if (clickedText != "No suggestions found") {
                    topicInputField.value = clickedText;
                }
                closeSuggestions2(); // Close the suggestion list
            }
        });

        suggestionList3.addEventListener("click", function(event) {
            // Check if the clicked element is an <li> within the <ul>
            if (event.target.tagName === "LI") {
                const clickedText = event.target.textContent;
                if (clickedText != "No suggestions found") {
                    subTopicInputField.value = clickedText;
                }
                closeSuggestions3(); // Close the suggestion list
            }
        });

        // Function to close the suggestion list
        function closeSuggestions1() {
            suggestionList1.classList.add("d-none");
            suggestionList1.innerHTML = '';
            categorySuggestions.length = [];
        }

        function closeSuggestions2() {
            suggestionList2.classList.add("d-none");
            suggestionList2.innerHTML = '';
            categorySuggestions.length = [];
        }

        function closeSuggestions3() {
            suggestionList3.classList.add("d-none");
            suggestionList3.innerHTML = '';
            categorySuggestions.length = [];
        }
        // Add an event listener to the document
        document.addEventListener("click", function(event) {
            const target = event.target;
            // Check if the click target is outside the suggestionList1
            if (target !== suggestionList1 && !suggestionList1.contains(target)) {
                // Add the "d-none" class to hide the suggestionList1
                closeSuggestions1();
                closeSuggestions2();
                closeSuggestions3();
            }
        });

        document.addEventListener("keydown", function(event) {
            if (event.key === "Tab") {
                closeSuggestions1();
                closeSuggestions2();
                closeSuggestions3();
            }
        });

        $('#quizForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Serialize form data to be sent to the server
            var formData = $(this).serialize();

            // Perform AJAX POST request
            $.ajax({
                type: 'POST',
                url: './insert_question.php', // Update the URL to the correct path
                data: formData,
                success: function(response) {
                    // Handle the success response here (if needed)
                    if (response == 'question inserted') {
                        $('#successModal2').modal('show');
                        console.log('Data successfully submitted:', response);
                    } else {
                        alert("Some error occured:", response);
                    }
                },
                error: function(error) {
                    console.error('Error occurred:', error);
                }
            });
        });
    </script>
    <script>
        var quizId = $('#hiddenQuizId').val();

        function loadQuestions(quizId) {
            $.ajax({
                type: 'GET',
                url: 'load_questions.php?quizId=' + quizId,
                success: function(response) {
                    $('#questionsContainer').html(response);
                },
                error: function(error) {
                    // Handle errors (if needed)
                    console.error('Error occurred while loading questions:', error);
                }
            });
        }


        $(".search-input ").on("select, input", getQuestions);
        getQuestions();

        function getQuestions() {
            // Define the parameters you want to send
            var _category = $("#inputCategory").val();
            var _topic = $("#inputTopic").val()
            var _subtopic = $("#inputSubTopic").val()
            var _question = $("#inputQuestion").val()

            // Make an AJAX request
            $.ajax({
                type: "POST", // Change to "GET" if needed
                url: "get_questions.php", // Replace with your server endpoint
                data: {
                    category: _category,
                    topic: _topic,
                    subtopic: _subtopic,
                    question: _question
                },
                success: function(response) {
                    // Handle the server's response here
                    $("#responseQuestions").html(response);
                    // console.log(response);
                },
                error: function(error) {
                    // Handle errors here
                    console.error(error);
                }
            });
        }

        var quizId = $('#hiddenQuizId').val();

        function loadQuestions(quizId) {
            $.ajax({
                type: 'GET',
                url: 'load_questions.php?quizId=' + quizId,
                success: function(response) {
                    $('#resoponseQuestions').html(response);
                },
                error: function(error) {
                    // Handle errors (if needed)
                    console.error('Error occurred while loading questions:', error);
                }
            });
        }

        function updateQuestion() {
            var formData = new FormData(document.getElementById("questionForm"));
            formData.append("updateQuestion", true);
            // Append the correctAnswer value to the formData
            formData.append("correctAnswer", $("input[name='correctAnswer']:checked").val());

            $.ajax({
                type: "POST",
                url: "update_question.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#sModal').modal('show');
                    console.log(response);
                    // loadQuestions(quizId);
                }
            });
        }


        function deleteQuestion(questionId) {
            console.log("Deleting question with ID: " + questionId);

            var formData = new FormData();
            formData.append("questionId", questionId);
            formData.append("deleteQuestion", true);

            $.ajax({
                type: "POST",
                url: "delete_question.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#sdModal').modal('show');
                    console.log(response);
                    loadQuestions(quizId);
                }
            });
        }

        $('#inputCategory').on('change', function() {
            var _category = $(this).val();

            // Make an AJAX request to fetch topics based on the selected category
            $.ajax({
                url: './ajax_get_topic.php', // Replace with the actual URL that fetches topics
                method: 'POST',
                data: {
                    category: _category
                },
                success: function(data) {
                    $('#inputTopic').html(data);
                }
            });
        });

        // When a topic is selected
        $('#inputTopic').on('change', function() {
            var _topic = $('#inputTopic').val();

            // Make an AJAX request to fetch sub-topics based on the selected topic and topic
            $.ajax({
                url: './ajax_get_subtopic.php', // Replace with the actual URL that fetches sub-topics
                method: 'POST',
                data: {
                    topic: _topic
                },
                success: function(data) {
                    $('#inputSubTopic').html(data);
                }
            });
        });
    </script>

</body>


</html>