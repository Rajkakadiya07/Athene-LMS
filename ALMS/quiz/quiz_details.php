
<?php
  session_start();
  ?>
  <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Athene LMS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">


  <link href="../assets/css/style.css" rel="stylesheet">
  <style>
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
      background-color: #f1f1f1;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
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

        /* Media query for small screens (up to 767px) */
        @media (max-width: 767px) {
            .nav-tabs {
                flex-direction: column;
            }

            .nav-link {
                width: 100%;
                text-align: left;
            }

            .tab-pane {
                padding: 10px;
            }

            .box,
            .box-2 {
                width: 100%;
                margin: 0;
            }

            .options label,
            .options input {
                width: 100%;
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
        .modal-dialog {
  position: fixed;
  margin: auto;
  margin-top: 20px;
  width: 90%; /* Adjust the width as needed */
  height: auto;
  right: 0;
  left: 0;
}

/* Media query for smaller screens (e.g., tablets) */
@media (max-width: 768px) {
  .modal-dialog {
    width: 100%; /* Set modal width to 100% for smaller screens */
    margin-top: 0;
    margin-bottom: 0;
    max-height: calc(100% - 30px); /* Set max height for the modal */
  }
}

/* Media query for even smaller screens (e.g., mobile phones) */
@media (max-width: 576px) {
  .modal-dialog {
    width: 100%; /* Set modal width to 100% for even smaller screens */
    margin-top: 0;
    margin-bottom: 0;
    max-height: calc(100% - 15px); /* Set max height for the modal */
  }
}
  </style>
</head>


<body>
  <?php

  require_once("../header.php");
  require_once("../sidebar.php");
  require_once "../connection.php";
  $sqlQ = "SELECT * FROM quiz WHERE qui_id = '{$_GET['quizId']}'";
  $result = mysqli_query($conn, $sqlQ);
  echo $result->num_rows;
  if ($result->num_rows > 0) {
    $_SESSION['quiz'] = $result->fetch_assoc();
  } else {
    die("<h5>Please refresh page</h5>");
  }
  ?>

  <main id="main" class="main">


    <!-- Add/Edit Question Modal -->
    <div class="modal fade bd-example-modal-lg " id="successModal" tabindex="-1" role="dialog"
      aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

    <div class="modal fade bd-example-modal-lg" id="ErrorModal" tabindex="-1" role="dialog"
      aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body p-4">
            <div class="text-center">
              <i class="bi bi-exclamation-triangle text-danger h1"></i>
              <p class="mt-2 h4 text-danger" id="errorModalText"></p>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade bd-example-modal-lg " id="successModal2" tabindex="-1" role="dialog"
      aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./Admin.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="./Admin.php">Dashboard</a></li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="card ms-3 col-11 question ">
        <div class="card-body mt-3">
          <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home"
                type="button" role="tab" aria-controls="home" aria-selected="true">Configure Quiz</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#AddTeacher" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Add Questions</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="p-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">View Questions</button>
            </li>

          </ul>
          <div class="tab-content pt-2" id="borderedTabContent">
            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
              <form id="quizEditForm" method="post">

                <?php
                require_once "../connection.php";
                if (isset($_SESSION['quiz']['qui_id'])) {
                  $quizId = $_SESSION['quiz']['qui_id'];

                  $sql = "SELECT * FROM quiz WHERE qui_id = $quizId";
                  $result = mysqli_query($conn, $sql);

                  if ($result) {
                    if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $quizName = $_SESSION['quiz']['qui_name'];
                      $quizDesc = $_SESSION['quiz']['qui_desc'];
                      $startTime = $_SESSION['quiz']['qui_start_time'];
                      $endTime = $_SESSION['quiz']['qui_end_time'];
                    } else {
                      die("No quiz found for quizId: $quizId");
                    }
                  } else {
                    die("Error: " . mysqli_error($conn));
                  }
                } else {
                  die("No quizId provided in the URL.");
                }
                ?>


                <div class="d-flex justify-content-between align-items-center mb-3">
                  <div class="d-flex align-items-center">
                    <div>
                      <h5 class="card-title" id="quizNameTitle">
                        <i class="bi bi-folder2 h2"></i>
                        <?php echo htmlspecialchars($quizName); ?>
                      </h5>
                    </div>
                  </div>
                  <div>

                    <a href="./delete_quiz.php?deleteQuiz=<?= $quizId ?>"><span class="btn btn-danger">Delete</span></a>


                  </div>
                </div>

                <div class="row justify-content-center">

                  <div class="col-md-3">
                    <label class="ms-2 form-label text-dark">Quiz Name</label>
                    <input type="hidden" id="hiddenQuizId" name="quizId" value="<?php echo $quizId; ?>">
                    <input name="fullName" type="text" class="form-control" id="name"
                      value="<?php echo isset($quizName) ? $quizName : ""; ?>" required>
                  </div>
                  <div class="col-md-3">
                    <label class="ms-2 form-label text-dark">Quiz Description</label>
                    <input name="contact" type="text" class="form-control" id="contact"
                      value="<?php echo isset($quizDesc) ? $quizDesc : ""; ?>" required>
                  </div>
                  <div class="col-md-3">
                    <label class="ms-2 form-label text-dark">Start Time</label>
                    <input name="startTime" type="datetime-local" class="form-control" id="startTime"
                      value="<?php echo isset($startTime) ? $startTime : ""; ?>" required>
                  </div>
                  <div class="col-md-3">
                    <label class="ms-2 form-label text-dark">End Time</label>
                    <input name="endTime" type="datetime-local" class="form-control" id="endTime"
                      value="<?php echo isset($endTime) ? $endTime : ""; ?>" required>
                  </div>
                </div>
                <div class="col-md-2 mt-4">
                  <button type="submit" class="mt-2 btn btn-primary" id="updateBtn">Update</button>
                </div>
              </form>

            </div>
          </div>
          <div class="tab-content pt-2">
            <div class="tab-pane fade" id="AddTeacher" role="tabpanel" aria-labelledby="profile-tab">
              <div class="material for">
                <div class="col-xl-12 ">

                  <form id="quizForm" method="post" autocomplete="off">
                    <div class="ms-3">
                      <div class="row">
                        <div class="col-6">
                          <input type="text" class="form-control mt-2 mb-2" id="quesCategoryField" autocomplete="off"
                            name="ques_category" placeholder="Category" required>
                          <ul id="myUL1" class="UL suggestion-item text-dark card d-none"></ul>
                        </div>
                        <div class="col-6">
                          <input type="text" id="quesTopicField" class="form-control mt-2 mb-2" autocomplete="off"
                            name="ques_topic" placeholder="Topic" required>
                          <ul id="myUL2" class="UL suggestion-item text-dark card d-none"></ul>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6">
                          <input type="text" id="quesSubTopicField" class="form-control mt-2 mb-2" autocomplete="off"
                            name="ques_sub_topic" placeholder="Sub Topic" required>
                          <ul id="myUL3" class="UL suggestion-item text-dark card d-none"></ul>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <input type="Number" class="ms-3 form-control mt-2 mb-2" id="mark" name="ques_mark"
                          placeholder="Enter marks" required>
                      </div>

                      <div class="col-6">
                        <input type="number" class="form-control mt-2 mb-2" name="ques_correct_answer"
                          id="quesCorrectAnswer" placeholder="Enter Right Answer" required>


                      </div>
                    </div>
                    <div class="mt-3 ms-3">
                      <span class="text-dark ms-1">Add Question</span>

                      <textarea type="text" class="form-control mt-2 mb-2" id="addQuestion" name="questionName" rows="5"
                        placeholder="Enter question" required></textarea>
                    </div>

                    <div class="mt-3 ms-3" id="addedAnswers">
                      <span class="text-dark ">Add Options</span>
                      <div class="col-11">
                        <input type="text" class="form-control mt-2 mb-2" id="option" name="ques_answer[]"
                          placeholder="Option 1" required>
                      </div>
                      <div class="col-11">
                        <input type="text" class="form-control mt-2 mb-2" id="option" name="ques_answer[]"
                          placeholder="Option 2" required>
                      </div>
                      <span id="addMoreAnswerBtn" class="btn btn-primary">Add more</span>
                    </div>
                    <div class="col-5 ms-3">

                      <input type="submit" class="mt-2 btn btn-primary" id="submitsBtn">
                    </div>

                  </form>
                </div>

              </div>
            </div>
          </div>
          <div class="tab-content pt-2">
            <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
              <div id="questionsContainer">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- 
    <div class="col-11">
      <div class="d-flex justify-content-between">
        <button class="btn btn-secondary" id="prevButton">Previous</button>
        <button class="btn btn-success" id="nextButton">Next</button>
      </div>
    </div> -->
  </main>
  <?php
  require_once "../js.php";
  ?>
  <script>

    $(document).ready(function () {
      var next = 3;

      function reassignNumber() {
        var div = document.getElementById("addedAnswers");
        var inputs = document.getElementsByName("ques_answer[]");
        totalInputCount = inputs.length;
        init = 1;
        inputs.forEach(function (inputElement) {
          inputElement.setAttribute('placeholder', 'Option ' + init);
          init++;
        });
        // console.log(inputs);
      }

      $("#addMoreAnswerBtn").on("click", function () {
        nextId = "option" + next;
        inputBox = `<div id="` + nextId + `" class="row"><div class="col-11 d-flex justify-content-center align-items-center"><input type="text" class="form-control mb-2" name="ques_answer[]" placeholder=""></div><div class="col-1"><span class="btn btn-primary removeOption" value="` + nextId + `">&#10006;</span></div></div>`;
        $(inputBox).insertBefore("#addMoreAnswerBtn");
        next += 1;
        reassignNumber();

      });

      // #pollOptions is a div where input boxes will be added dynmically, .removeOption is a class for spans that are buttons used to remove input boxes which are in divisions with
      // an id assigned to them, id is taken from span element to find each division

      $("#addedAnswers").on("click", ".removeOption", function (e) {
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
        url: '../question_bank/ajax_get_categories_db.php',
        type: 'POST',
        data: {
          value: this.value
        },
        success: function (data) {
          // Assuming your PHP script returns a JSON array
          suggestionList1.innerHTML = '';
          categorySuggestions.length = 0;
          data = JSON.parse(data);
          // console.log(data[0]);
          if (data[0] != "Empty value") {
            // console.log(data[0] != "Empty value");
            if (Array.isArray(data)) {
              $.each(data, function (index, item) {
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
        error: function () {
          // console.error('Error in AJAX request');
        }
      });
    });

    // Function to update the suggestion list based on user input
    topicInputField.addEventListener("input", function updateSuggestions() {
      $.ajax({
        url: '../question_bank/ajax_get_topic_db.php',
        type: 'POST',
        data: {
          value: this.value,
          category: $("#quesCategoryField").val()
        },
        success: function (data) {
          // Assuming your PHP script returns a JSON array
          suggestionList2.innerHTML = '';
          topicSuggestions.length = 0;
          data = JSON.parse(data);
          // console.log(data[0]);
          if (data[0] != "Empty value") {
            // console.log(data[0] != "Empty value");
            if (Array.isArray(data)) {
              $.each(data, function (index, item) {
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
        error: function () {
          // console.error('Error in AJAX request');
        }
      });
    });


    // Function to update the suggestion list based on user input
    subTopicInputField.addEventListener("input", function updateSuggestions() {
      $.ajax({
        url: '../question_bank/ajax_get_subtopic_db.php',
        type: 'POST',
        data: {
          value: this.value,
          category: $(categoryInputField).val(),
          topic: $(topicInputField).val()
        },
        success: function (data) {
          // Assuming your PHP script returns a JSON array
          suggestionList3.innerHTML = '';
          subTopicSuggestions.length = 0;
          data = JSON.parse(data);
          // console.log(data[0]);
          if (data[0] != "Empty value") {
            // console.log(data[0] != "Empty value");
            if (Array.isArray(data)) {
              $.each(data, function (index, item) {
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
            } else {
            }
          } else {
            closeSuggestions3();
          }
        },
        error: function () {
          // console.error('Error in AJAX request');
        }
      });
    });

    categoryInputField.addEventListener("input", function () {
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

    topicInputField.addEventListener("input", function () {
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

    subTopicInputField.addEventListener("input", function () {
      closeSuggestions1();
      closeSuggestions2();
    });

    suggestionList1.addEventListener("click", function (event) {
      // Check if the clicked element is an <li> within the <ul>
      if (event.target.tagName === "LI") {
        const clickedText = event.target.textContent;
        if (clickedText != "No suggestions found") {
          categoryInputField.value = clickedText;
        }
        closeSuggestions1(); // Close the suggestion list
      }
    });

    suggestionList2.addEventListener("click", function (event) {
      // Check if the clicked element is an <li> within the <ul>
      if (event.target.tagName === "LI") {
        const clickedText = event.target.textContent;
        if (clickedText != "No suggestions found") {
          topicInputField.value = clickedText;
        }
        closeSuggestions2(); // Close the suggestion list
      }
    });

    suggestionList3.addEventListener("click", function (event) {
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
    document.addEventListener("click", function (event) {
      const target = event.target;
      // Check if the click target is outside the suggestionList1
      if (target !== suggestionList1 && !suggestionList1.contains(target)) {
        // Add the "d-none" class to hide the suggestionList1
        closeSuggestions1();
        closeSuggestions2();
        closeSuggestions3();
      }
    });

    $(document).ready(function () {
      var quizId = $('#hiddenQuizId').val();
      loadQuestions(quizId);

      function loadQuestions(quizId) {
        $.ajax({
          type: 'GET',
          url: 'get_questions.php?quizId=' + quizId,
          success: function (response) {
            $('#questionsContainer').html(response);
          },
          error: function (error) {
            // Handle errors (if needed)
            console.error('Error occurred while loading questions:', error);
          }
        });
      }
      $('#quizForm').submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        var numOptions = $('input[name="ques_answer[]"]').length;
        var rightAnswer = $('#quesCorrectAnswer').val();

        if (isNaN(rightAnswer) || rightAnswer < 1 || rightAnswer > numOptions) {
          // Display an error message (you can customize this part)
          displayErrorModal('Invalid right answer. Please enter a number between 1 and ' + numOptions + '.');
          return false; // Prevent form submission
        }

        var numOptions = $('input[name="ques_answer[]"]').length;
        var rightAnswer = parseInt($('#quesCorrectAnswer').val()); // Convert to integer

        // Validate the right answer
        if (isNaN(rightAnswer) || rightAnswer < 1 || rightAnswer > numOptions) {
          // Display an error message
          displayErrorModal('Invalid right answer. Please enter a number between 1 and ' + numOptions + '.');
          return false; // Prevent form submission
        }

        // Serialize form data to be sent to the server
        var formData = $(this).serialize();
        var quizId = $('#hiddenQuizId').val();
        // Perform AJAX POST request
        $.ajax({
          type: 'POST',
          url: './insert_question.php?quizId=' + quizId, // Update the URL to the correct path
          data: formData,
          success: function (response) {
            // Handle the success response here (if needed)
            if (response == "question inserted") {

              $('#successModal2').modal('show');
              loadQuestions(quizId);
              console.log('Data successfully submitted:', response);
            }
          },
          error: function (error) {

            console.error('Error occurred:', error);
          }
        });
      });
      function displayErrorModal(message) {
        $('#errorModalText').text(message); // Set the message inside the modal
        $('#ErrorModal').modal('show'); // Show the ErrorModal
      }
    });
  </script>


  <script>
    $(document).ready(function () {
      var quizId = $('#hiddenQuizId').val();

      // Function to update quiz using AJAX
      function updateQuiz(formData) {
        $.ajax({
          type: 'POST',
          url: 'update_quiz.php',
          data: formData,
          dataType: 'json', // Expect JSON response from the server
          success: function (response) {
            if (response.status === 'success') {
              // Show success modal
              $('#successModal').modal('show');
              // Update input fields with new values
              $('#quizNameTitle').text(response.quizName);
              $('#name').val(response.quizName);
              $('#contact').val(response.quizDesc);
              $('#startTime').val(response.startTime);
              $('#endTime').val(response.endTime);
            } else {
              // Handle error, if any
              console.error('Error occurred:', response.message);
            }
          },
          error: function (error) {
            // Handle errors and display an error message
            console.error('Error occurred:', error);
          }
        });
      }

      // Form submission using AJAX
      $('#quizEditForm').submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize form data to be sent to the server
        var formData = $(this).serialize();

        // Call the updateQuiz function with form data
        updateQuiz(formData);
      });
    });


  </script>





</body>

</html>